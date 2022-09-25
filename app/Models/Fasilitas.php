<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\FasilitasDetail;
use App\Models\Ruang;

class Fasilitas extends Model
{
    use HasFactory;
    public function fasilitas_detail()
    {
        return $this->hasMany(FasilitasDetail::class);
    }
    public function ruang()
    {
        return $this->hasMany(Ruang::class);
    }
}