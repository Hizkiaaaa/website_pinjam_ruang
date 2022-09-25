<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gedung;
use App\Models\Lantai;
use App\Models\User;
use App\Models\FasilitasDetail;
use Kyslik\ColumnSortable\Sortable;

class Ruang extends Model
{
    use HasFactory, Sortable;

    protected $guarded = [
        'id'
    ];
    public $sortable = ['id', 'nama_ruang' , 'gedung_id'];

    public function scopeFilter($query,array $filters){
        $query->when($filters['search'] ?? false, function($query,$search){
            return $query->where('name', 'like', '%' . $search . '%');
        });
    }
    public function gedung()
    {
        return $this->belongsTo(Gedung::class);
    }
    public function lantai()
    {
        return $this->belongsTo(Lantai::class);
    }
    public function fasilitas_detail()
    {
        return $this->hasMany(FasilitasDetail::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}