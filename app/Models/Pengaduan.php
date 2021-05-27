<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laratrust\Traits\LaratrustUserTrait;

class Pengaduan extends Model
{
    use LaratrustUserTrait;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = "pengaduan";
    protected $fillable = ['tgl_pengaduan', 'id_user', 'isi_laporan', 'foto', 'status'];

    public function tanggapan()
    {
        return $this->hasOne('App\Models\Tanggapan', 'id_tanggapan');
    }
}
