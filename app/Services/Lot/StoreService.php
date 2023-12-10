<?php

namespace App\Services\Lot;

use App\Models\Lot;
use App\Models\LotImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mews\Purifier\Facades\Purifier;

class StoreService
{

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Store a new lot.
     */
    public function storeLot()
    {
        $lot = new Lot;
        $lot->user_id = Auth::id();
        $this->saveLot($lot);
        $this->saveImages($lot->id);
    }

    /**
     * Update an existing lot.
     * @param int $id
     */
    public function updateLot(int $id)
    {
        $lot = Lot::findOrFail($id);


        $this->saveLot($lot);
        $this->saveImages($lot->id);
    }

    /**
     * Save lot in the storage.
     * @param Lot $lot
     */
    private function saveLot(Lot $lot)
    {
        $lot->name = $this->request->title;
        $lot->description = Purifier::clean($this->request->description);
        $lot->category_id = $this->request->category;
        $lot->start_price = $this->request->price;
        $lot->status = $this->request->for_sale ? 'sale' : 'draft';
        $lot->end_time = \Carbon\Carbon::now()->addDay();
        $lot->save();
    }

    /**
     * Save images for the lot.
     * @param int $lotId
     */
    private function saveImages(int $lotId)
    {
        if (!empty($this->request->image)) {
            foreach ($this->request->image as $image) {
                $lotImage = new LotImage;
                $lotImage->path = $image->store('lots/' . $lotId, 'public');
                $lotImage->lot_id = $lotId;
                $lotImage->save();
            }
        }
    }

}