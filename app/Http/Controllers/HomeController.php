<?php

namespace App\Http\Controllers;

use App\Models\Lot;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $lots = Lot::where('status', 'sale')
            ->where('end_time', '>', now())
            ->with('user', 'category', 'images', 'bids')
            ->orderByDesc('updated_at')
            ->paginate(6);
        return view('home', compact('lots'));
    }
}
