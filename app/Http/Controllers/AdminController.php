<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function data_masyarakat()
    {
        $masyarakat = DB::table('users' )->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_id', 3)->get();
        return view('admin.data-masyarakat', compact('masyarakat'));
    }

    public function data_petugas()
    {
        $petugas = DB::table('users')->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_id', '!=', 3)->get();
        return view('admin.data-petugas', compact('petugas'));
    }

    public function tanggapan()
    {
        $pengaduan = Pengaduan::join('users', 'users.id', '=', 'pengaduan.id_user')->get();
        $tanggapan = Tanggapan::all();
        return view('admin.tanggapan', compact('pengaduan', 'tanggapan'));
    }

    public function beri_tanggapan($id)
    {
        $pengaduan = Pengaduan::join('users', 'users.id', '=', 'pengaduan.id_user')->where('id_pengaduan', $id)->get();
        $tanggapan = Tanggapan::where('id_pengaduan', $id)->get();
        return view('admin.beri-tanggapan', compact('pengaduan', 'tanggapan'));
    }

    public function kirim_tanggapan(Request $request)
    {
        $request->validate([
            'tanggapan' => 'required'
        ]);

        Tanggapan::create([
            'id_pengaduan'  => $request->id_pengaduan,
            'tgl_tanggapan' => $request->tgl_tanggapan,
            'tanggapan'     => $request->tanggapan,
            'id_petugas'    => $request->id_petugas
        ]);

        Pengaduan::where('id_pengaduan', $request->id_pengaduan)
                    ->update([
                        'status'    => $request->status
                    ]);

        return redirect('/beri_tanggapan/' . $request->id_pengaduan)->with('status', 'Tanggapan berhasil dikirim');
    }
}
