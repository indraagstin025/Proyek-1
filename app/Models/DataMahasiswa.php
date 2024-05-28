<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataMahasiswa extends Model
{
    use HasFactory;
    public $table = 'datamahasiswa';
    public $fillable = [
        'user_id',
        'name',
        'email',
        'nim',
        'angkatan',
        'jurusan',
        'nama_lengkap',
        'tanggal_lahir',
        'profile_completed',
    ];
}
