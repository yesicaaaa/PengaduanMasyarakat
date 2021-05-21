<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table = "pengaduan";
    protected $fillable = ['tgl_pengaduan', 'id_user', 'isi_laporan', 'foto', 'status'];
}
