<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemporaryPeminjam extends Model
{
    protected $table = 'temporary_peminjams';
    protected $fillable = [
        'nama',
        'nis',
        'nip',
        'email',
        'no_telp',
        'password',
        'status',
        'role',
        'kode_import'
    ];
}
