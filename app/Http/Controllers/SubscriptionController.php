<?php

namespace App\Http\Controllers;

 use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        return view('subscription.plans');
    }

    public function subscribe($plan)
    {
        $user = auth()->user();

        $amounts = [
            'basic' => 6.99,
            'premium' => 10.99,
        ];

        if (!isset($amounts[$plan])) {
            abort(404);
        }

        Subscription::updateOrCreate(
            ['user_id' => $user->id],
            [
                'plan' => $plan,
                'amount' => $amounts[$plan],
                'starts_at' => now(),
                'expires_at' => now()->addMonth(),
                'status' => 'active',
            ]
        );

        return redirect()->back()->with('success', 'Subscription activated!');
    }
}
