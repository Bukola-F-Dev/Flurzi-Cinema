<?php
use App\Models\Subscription;


function userSubscription()
{
    return Subscription::where('user_id', auth()->id())
        ->where('status', 'active')
        ->where('expires_at', '>', now())
        ->first();
}

if (!function_exists('isPremium')) {
    function isPremium()
    {
        if (!auth()->check()) {
            return false;
        }

        $subscription = Subscription::where('user_id', auth()->id())
            ->where('status', 'active')
            ->where('expires_at', '>', now())
            ->first();

        return $subscription ? true : false;
    }
}

function currentPlan()
{
    if (!auth()->check()) return 'free';

    return optional(auth()->user()->subscription)->plan ?? 'free';
}

function isPremium()
{
    $sub = userSubscription();

    return $sub && in_array($sub->plan, ['basic', 'premium']);
}

function hasTournamentAccess()
{
    return in_array(currentPlan(), ['basic', 'premium']);
}





