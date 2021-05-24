<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Tanggapan;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function tanggapan()
    {
        $pengaduan = Pengaduan::join('users', 'users.id', '=', 'pengaduan.id_user')->get();
        $tanggapan = Tanggapan::all();
        return view('petugas.tanggapan', compact('pengaduan','tanggapan'));
    }

    public function beri_tanggapan($id)
    {
        $pengaduan = Pengaduan::join('users', 'users.id', '=', 'pengaduan.id_user')->where('id_pengaduan', $id)->get();
        $tanggapan = Tanggapan::pengaduan();
        return view('petugas.beri-tanggapan', compact('pengaduan', 'tanggapan'));
    }

    public function kirim_tanggapan(Request $request)
    {
        $request->validate([
            'tanggapan' => 'required'
        ]);

        Tanggapan::Create([
            'id_pengaduan'  => $request->id_pengaduan,
            'tgl_tanggapan' => $request->tgl_tanggapan,
            'tanggapan'     => $request->tanggapan,
            'id_petugas'    => $request->id_petugas
        ]);

        Pengaduan::where('id_pengaduan', $request->id_pengaduan)
                    ->update([
                        'status'    => $request->status
                    ]);

        return redirect('/beri_tanggapan/' . $request->id_pengaduan)->with('status', 'Tanggapan Anda telah dikirim');
    }
}
