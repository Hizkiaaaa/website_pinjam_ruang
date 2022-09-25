<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pinjaman;

class StatusPinjaman extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class);
    }
}