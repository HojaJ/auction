<?php

namespace App\Http\Controllers;

use App\Models\LotImage;
use Illuminate\Support\Facades\Storage;

class LotImageController extends Controller
{

    public function destroy(int $id)
    {
        $lotImage = LotImage::findOrFail($id);
        Storage::disk('local')->delete('public/' . $lotImage->path);
        $lotImage->delete();
        return back()->with('success', 'Image delete successfully.');
    }
}
