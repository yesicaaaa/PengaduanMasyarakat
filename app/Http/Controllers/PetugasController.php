<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function tanggapan()
    {
        $pengaduan = Pengaduan::join('users', 'users.id', '=', 'pengaduan.id_user')->get();
        $tanggapan = Tanggapan::all();
        return view('petugas.tanggapan', compact('pengaduan','tanggapan'));
    }
}
