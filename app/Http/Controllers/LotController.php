<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Lot;
use App\Services\Lot\DeleteService;
use App\Services\Lot\StoreService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lots = Lot::where('user_id', Auth::id())
            ->with('images')
            ->orderByDesc('updated_at')
            ->paginate(6);
        return view('lots.all', compact('lots'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('lots.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreService $service)
    {
        $service->storeLot();
        return redirect()->route('lots.index')->with('success', 'Lot created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lot $lot)
    {
        return view('lots.one', compact('lot'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lot $lot)
    {
        $categories = Category::all();
        return view('lots.edit', compact('lot', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreService $service, int $id)
    {
        $service->updateLot($id);
        return redirect()->route('lots.show', $id)->with('success', 'Lot update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        DeleteService::delete($id);
        return redirect()->route('lots.index')->with('success', 'Lot delete successfully.');
    }

    public function getMaxBid(Request $request)
    {
        $lot_id = $request->lot_id;
        $lot = Lot::find($lot_id);
        $uniqBids = $lot->number_of_unique_bids;
        $currentMaxBid = $lot->bids()->max('price') ?? $lot->start_price;
        return response()->json([
            'maxBid' => $currentMaxBid,
            'uniqueBids' => $uniqBids
        ]);
    }
}
