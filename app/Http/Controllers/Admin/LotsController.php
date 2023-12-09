<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lot;
use App\Services\Lot\DeleteService;
use Illuminate\Http\Request;

class LotsController extends Controller
{
    public function index()
    {
        $lots = Lot::with('user', 'category')
            ->orderByDesc('updated_at')
            ->paginate(10);
        return view('admin.lots.index', compact('lots'));
    }

    public function destroy(int $id)
    {
        DeleteService::delete($id);
        return redirect()->route('admin.lots.index')->with('success', 'Lot delete successfully.');
    }

}
