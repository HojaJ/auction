<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LotImage extends Model
{
    use HasFactory;

    public function lot()
    {
        return $this->belongsTo(Lot::class);
    }
}
