<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Fasilitas;

class FasilitasDetail extends Model
{
    use HasFactory;
    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class);
    }
}