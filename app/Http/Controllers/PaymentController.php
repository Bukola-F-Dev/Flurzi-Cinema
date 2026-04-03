<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PaymentController extends Controller
{
    public function initialize($plan)
    {
        $user = auth()->user();

        $amounts = [
            'basic' => 699,
            'premium' => 1099,
        ];

        if (!isset($amounts[$plan])) {
            abort(404);
        }

        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'gbp',
                    'product_data' => [
                        'name' => ucfirst($plan) . ' Plan',
                    ],
                    'unit_amount' => $amount,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
        
            'metadata' => [
                'user_id' => auth()->id(),
                'plan' => $plan,
            ],
        
            'success_url' => route('payment.success', ['plan' => $plan]) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('subscription'),
        ]);

        return redirect($session->url);
    }

   /* public function success(Request $request, $plan)
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $session = \Stripe\Checkout\Session::retrieve($request->session_id);

        if ($session->payment_status !== 'paid') {
            return redirect('/subscription')->with('error', 'Payment not successful');
        }

        $user = auth()->user();

        Subscription::updateOrCreate(
            ['user_id' => $user->id],
            [
                'plan' => $plan,
                'amount' => $session->amount_total / 100,
                'starts_at' => now(),
                'expires_at' => now()->addMonth(),
                'status' => 'active',
            ]
        );

        return redirect('/')->with('success', 'Subscription activated 🎉');
    } */
    public function success(Request $request, $plan)
{
    return redirect('/')
        ->with('success', 'Payment received! Your subscription will be activated shortly.');
}

    public function webhook(Request $request)
{
    $payload = $request->getContent();
    $sig_header = $request->header('Stripe-Signature');
    $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

    try {
        $event = \Stripe\Webhook::constructEvent(
            $payload, $sig_header, $endpoint_secret
        );
    } catch (\Exception $e) {
        return response('Invalid', 400);
    }

    if ($event->type === 'checkout.session.completed') {
        $session = $event->data->object;

        $userId = $session->metadata->user_id;
        $plan = $session->metadata->plan;

        $user = \App\Models\User::find($userId);

        if ($user) {
            Subscription::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'plan' => $plan,
                    'amount' => $session->amount_total / 100,
                    'starts_at' => now(),
                    'expires_at' => now()->addMonth(),
                    'status' => 'active',
                ]
            );

            \Log::info('Stripe payment success', [
                'user_id' => $userId,
                'plan' => $plan,
                'session_id' => $session->id
            ]);
        }
    }

    return response('Success', 200);
}
}

/* {
    public function initialize($plan)
    {
        $user = auth()->user();

        $amounts = [
            'basic' => 699,    
            'premium' => 1099,
        ];

        if (!isset($amounts[$plan])) {
            abort(404);
        }

        $response = Http::withOptions([
            'verify' => false  
        ])->withToken(env('PAYSTACK_SECRET_KEY'))
        ->post(env('PAYSTACK_PAYMENT_URL') . '/transaction/initialize', [
            'email' => $user->email,
            'amount' => $amounts[$plan] * 100,
            'callback_url' => route('payment.callback', $plan),
        ]);

        $response = Http::withToken(env('PAYSTACK_SECRET_KEY'))
            ->post(env('PAYSTACK_PAYMENT_URL') . '/transaction/initialize', [
                'email' => $user->email,
                'amount' => $amounts[$plan] * 100,
                'callback_url' => route('payment.callback', $plan),
            ]); 

        $data = $response->json();

        if (!$data['status']) {
            return back()->with('error', 'Payment failed to initialize');
        }

        return redirect($data['data']['authorization_url']);
    }

    public function callback(Request $request, $plan)
    {
        if (!$request->has('reference')) {
            return redirect('/subscription')->with('error', 'No payment reference found');
        }
    
        $reference = $request->reference;
    
        $response = Http::withOptions([
            'verify' => false
        ])->withToken(env('PAYSTACK_SECRET_KEY'))
        ->get(env('PAYSTACK_PAYMENT_URL') . "/transaction/verify/$reference");
    
        $data = $response->json();
    
        if (!$data['status'] || $data['data']['status'] !== 'success') {
            return redirect('/subscription')->with('error', 'Payment verification failed');
        }
    
  
        $user = auth()->user();
    
        if (!$user) {
            return redirect('/login')->with('error', 'User session expired');
        }
    
      
        \App\Models\Subscription::updateOrCreate(
            ['user_id' => $user->id],
            [
                'plan' => $plan,
                'amount' => $data['data']['amount'] / 100,
                'starts_at' => now(),
                'expires_at' => now()->addMonth(),
                'status' => 'active',
            ]
        );
    
        return redirect('/')->with('success', 'Subscription activated successfully 🎉');
    }

        return redirect('/subscription')->with('error', 'Payment failed.');
    }

 
} */