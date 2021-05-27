<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class MasyarakatController extends Controller
{
    public function index()
    {
        return view('masyarakat.form-pengaduan');
    }

    public function proses_pengaduan(Request $request)
    {
        $request->validate([
            'tgl_pengaduan' => 'required',
            'nama'          => 'required',
            'isi_laporan'   => 'required',
            'foto'          => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        //proses upload foto
        $file = $request->file('foto');
        $file_name = $file->getClientOriginalName();
        $upload_to = 'img/pengaduan_img';
        $file->move($upload_to, $file_name);

        $user_id = Masyarakat::select('id')->where('name', $request->nama)->first();
        $user = json_decode($user_id);

        Pengaduan::create([
            'tgl_pengaduan' => $request->tgl_pengaduan,
            'id_user'       => $user->id,
            'isi_laporan'   => $request->isi_laporan,
            'foto'          => $file_name,
            'status'        => $request->status
        ]);

        return redirect('/pengaduan_saya')->with('status', 'Pengaduan Anda telah direkam.');
    }

    public function pengaduan_saya()
    {
        $id_user = Auth::user()->id;
        $pengaduan = Pengaduan::where('id_user', $id_user)->get();
        return view('masyarakat.pengaduan-saya', compact('pengaduan'));
    }

    public function tanggapan_pengaduan($id)
    {
        $pengaduan = Pengaduan::where('id_pengaduan', $id)->get();
        $tanggapan = Tanggapan::where('id_pengaduan', $id)->get();
        return view('masyarakat.tanggapan-pengaduan', compact('pengaduan', 'tanggapan'));
    }

    public function trash_pengaduan()
    {
        $pengaduan = Pengaduan::onlyTrashed()->get();

        return view('masyarakat.trash-pengaduan', compact('pengaduan'));
    }

    public function soft_delete($id)
    {
        Pengaduan::where('id_pengaduan', $id)->delete();

        return redirect('pengaduan_saya')->with('status', 'Pengaduan Anda telah dihapus.');
    }

    public function restore_pengaduan($id)
    {
        Pengaduan::onlyTrashed()->where('id_pengaduan', $id)->restore();

        return redirect('/trash_pengaduan_masyarakat')->with('status', 'Pengaduan Anda telah dipulihkan');
    }

    public function restore_all()
    {
        Pengaduan::onlyTrashed()->restore();

        return redirect('/trash_pengaduan_masyarakat')->with('status', 'Semua pengaduan Anda berhasil dipulihkan.');
    }

    public function delete_pengaduan($id)
    {
        $foto = Pengaduan::onlyTrashed()->where('id_pengaduan', $id)->get();
        foreach($foto as $f){
            File::delete('img/pengaduan_img/' . $f->foto);
        }

        Pengaduan::onlyTrashed()->where('id_pengaduan', $id)->forceDelete();
        return redirect('trash_pengaduan_masyarakat')->with('status', 'Pengaduan Anda berhasil dihapus permanen.');
    }

    public function all_delete_pengaduan()
    {
        $foto = Pengaduan::onlyTrashed()->get();
        foreach($foto as $f){
            File::delete('img/pengaduan_img/' . $f->foto);
        }

        Pengaduan::onlyTrashed()->forceDelete();
        return redirect('trash_pengaduan_masyarakat')->with('status', 'Semua pengaduan Anda berhasil dihapus');
    }
}
