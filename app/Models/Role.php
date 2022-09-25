<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Role extends Model
{
    use HasFactory, Sortable;

    protected $guarded = [
        'id'
    ];
    public $sortable = ['id', 'nama_role'];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}