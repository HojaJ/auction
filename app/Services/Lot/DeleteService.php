<?php

namespace App\Services\Lot;

use App\Models\Lot;

class DeleteService
{
    /**
     * Delete a lot from storage.
     *
     * @param int $id
     */
    public static function delete(int $id): void
    {
        $lot = Lot::findOrFail($id);


        $lot->delete();
    }

}