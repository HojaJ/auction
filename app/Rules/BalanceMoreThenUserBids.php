<?php

namespace App\Rules;

use App\Models\Bid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Rule;

class BalanceMoreThenUserBids implements Rule
{
    /**
     * The sum of all the user's bids must be less than the current balance.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $sumAllUserActiveBids = Bid::where('user_id', Auth::id())->where('is_active', true)->sum('price');
        return Auth::user()->balance >= (int)$value + $sumAllUserActiveBids;
    }

    public function message()
    {
        return "You don't have enough money to make this bid";
    }
}