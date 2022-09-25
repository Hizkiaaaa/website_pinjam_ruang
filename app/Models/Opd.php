<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Opd extends Model
{
    use HasFactory, Sortable;

    protected $guarded = [
        'id'
    ];
    public $sortable = ['id', 'nama_opd' , 'akronim'];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}