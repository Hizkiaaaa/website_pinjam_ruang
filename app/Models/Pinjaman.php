<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\StatusPinjaman;


class Pinjaman extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status_pinjaman()
    {
        return $this->belongsTo(StatusPinjaman::class);
    }
}