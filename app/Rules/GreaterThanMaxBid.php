<?php

namespace App\Rules;

use App\Models\Lot;
use Illuminate\Contracts\Validation\Rule;

class GreaterThanMaxBid implements Rule
{

    private ?Lot $lot;
    private int $currentMaxBid;

    public function __construct(?string $lotId)
    {
        $this->lot = Lot::find($lotId);
    }

    public function passes($attribute, $value)
    {
        $this->currentMaxBid = $this->lot->bids()->max('price') ?? $this->lot->start_price - 1;
        return (int)$value > $this->currentMaxBid;
    }

    public function message()
    {
        return "The bid must be greater than $this->currentMaxBid";
    }
}