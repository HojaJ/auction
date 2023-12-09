<?php

namespace App\Http\Controllers;

use App\Http\Resources\PurchaseResource;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{

    public function getUserPurchases(){
        return PurchaseResource::collection(Purchase::with('lot:id,user_id,name', 'lot.user:id,name')
            ->where('user_id', auth('sanctum')->id())
            ->orderByDesc('created_at')
            ->paginate(5));
    }
}
