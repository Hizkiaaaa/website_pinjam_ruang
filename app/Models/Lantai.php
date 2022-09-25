<?php

namespace App\Models;
use App\Models\Ruang;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lantai extends Model
{
    use HasFactory;
    public function ruang()
    {
        return $this->hasMany(Ruang::class);
    }
}