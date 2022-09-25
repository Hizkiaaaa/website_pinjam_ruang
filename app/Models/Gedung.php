<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ruang;
use Kyslik\ColumnSortable\Sortable;


class Gedung extends Model
{
    use HasFactory, Sortable;

    protected $guarded = [
        'id'
    ];
    public $sortable = ['id', 'nama_gedung' , 'alamat_gedung'];

    public function ruang()
    {
        return $this->hasMany(Ruang::class);
    }
    
}