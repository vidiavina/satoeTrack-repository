<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Peminjam extends Authenticatable
{
    use HasFactory;
    
    protected $guard = 'peminjam';
    protected $table = 'peminjams';
    protected $fillable = [
        'nama',
        'nis',
        'nip',
        'email',
        'no_telp',
        'password',
        'status',
        'role',
    ];
}
