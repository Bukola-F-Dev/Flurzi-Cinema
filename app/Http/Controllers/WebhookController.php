<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Webhook;
use App\Models\User;
use App\Models\Subscription;
use App\Models\StripeEvent;
use App\Models\PaymentLog;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        $payload = $request->getContent();
        $sig_header = $request->server('HTTP_STRIPE_SIGNATURE');

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\Exception $e) {
            return response('Invalid signature', 400);
        }

        // ✅ IDPOTENCY (MUST BE FIRST)
        if (StripeEvent::where('event_id', $event->id)->exists()) {
            return response('Already processed', 200);
        }

        StripeEvent::create([
            'event_id' => $event->id,
        ]);

        // 🎯 CHECKOUT COMPLETED
        if ($event->type === 'checkout.session.completed') {

            $session = $event->data->object;

            if ($session->payment_status !== 'paid') {
                return response('Payment not completed', 400);
            }

            $userId = $session->metadata->user_id ?? null;
            $plan = $session->metadata->plan ?? null;

            $user = User::find($userId);

            if (!$user || !$plan) {
                return response('Invalid metadata', 400);
            }

            Subscription::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'plan' => $plan,
                    'stripe_id' => $session->subscription,
                    'status' => 'active',
                    'starts_at' => now(),
                    'expires_at' => now()->addMonth(),
                ]
            );
        }

        // 💰 RENEWAL PAYMENT
        if ($event->type === 'invoice.payment_succeeded') {

            $invoice = $event->data->object;

            $subscription = Subscription::where('stripe_id', $invoice->subscription)->first();

            if ($subscription) {
                $subscription->update([
                    'status' => 'active',
                    'expires_at' => now()->addMonth(),
                ]);
            }
        }

        // ❌ SUBSCRIPTION CANCELLED
        if ($event->type === 'customer.subscription.deleted') {

            $stripeSub = $event->data->object;

            $subscription = Subscription::where('stripe_id', $stripeSub->id)->first();

            if ($subscription) {
                $subscription->update([
                    'status' => 'cancelled',
                ]);
            }
        }

        return response('Webhook handled', 200);
    }
}