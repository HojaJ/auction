<?php

namespace App\Http\Controllers;

use App\Events\BidEvent;
use App\Models\Bid;
use App\Services\MakeBidService;
use Illuminate\Http\Request;

class BidController extends Controller
{

    public function store(MakeBidService $service)
    {
//        event(new BidEvent($service->bid));
        return back()->with('success', 'Your bid is accepted.');
    }
}
