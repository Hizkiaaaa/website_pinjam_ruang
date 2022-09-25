<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use App\Models\Opd;
use App\Models\Ruang;
use App\Models\Pinjaman;
use Kyslik\ColumnSortable\Sortable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    protected $guarded = [
        'id'
    ];

    public $sortable = ['id', 'nip' , 'namaa', 'email', 'role_id','telegram_id', 'opd_id', 'no_hp','ruang_id', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }

    public function ruang()
    {
        return $this->hasMany(Ruang::class);
    }

    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class);
    }
}