<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function data_masyarakat()
    {
        $masyarakat = User::join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_id', 3)->get();
        return view('admin.data-masyarakat', compact('masyarakat'));
    }

    public function data_petugas()
    {
        $petugas = User::join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_id', '!=', 3)->get();
        return view('admin.data-petugas', compact('petugas'));
    }

    public function tanggapan()
    {
        $pengaduan = Pengaduan::join('users', 'users.id', '=', 'pengaduan.id_user')
            ->leftJoin('tanggapan', 'tanggapan.id_pengaduan', '=', 'pengaduan.id_pengaduan')
            ->select('pengaduan.*', 'users.name', 'tanggapan.tgl_tanggapan')->get();
        return view('admin.tanggapan', compact('pengaduan'));
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

        return redirect('/beri_tanggapan_admin/' . $request->id_pengaduan)->with('status', 'Tanggapan berhasil dikirim');
    }

    public function generate_laporan()
    {
        $laporan = array();
        $tanggapan = Tanggapan::rightJoin('users', 'users.id', '=', 'tanggapan.id_petugas')
            ->rightJoin('pengaduan', 'pengaduan.id_pengaduan', '=', 'tanggapan.id_pengaduan')
            ->select('tanggapan.*', 'users.name', 'pengaduan.*')
            ->get();
        foreach ($tanggapan as $t) {
            $laporan[] = array(
                'tgl_pengaduan' => $t->tgl_pengaduan,
                'id_pengadu'    => $t->id_pengaduan,
                'pengaduan'     => $t->isi_laporan,
                'status'        => $t->status,
                'tgl_tanggapan' => $t->tgl_tanggapan,
                'isi_tanggapan' => $t->tanggapan,
                'nama_petugas'  => $t->name
            );
        }
        $isiLaporan = $laporan;
        return view('admin.generate-laporan', compact('isiLaporan'));
    }

    public function soft_delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/data_masyarakat')->with('status', 'Data user berhasil dihapus.');
    }

    public function trash()
    {
        $user = User::join('role_user', 'role_user.user_id', '=', 'users.id')
                ->where('role_user.role_id', 3)->onlyTrashed()->get();
        return view('admin.trash-masyarakat', compact('user'));
    }

    public function restore($id)
    {
        $restore = User::onlyTrashed()->where('id', $id);
        $restore->restore();

        return redirect('/trash')->with('status', 'Data user berhasil dipulihkan.');
    }

    public function restore_all()
    {
        $restore = User::onlyTrashed();
        $restore->restore();

        return redirect('/trash')->with('status', 'Semua data masyarakat berhasil dipulihkan');
    }

    public function delete($id)
    {
        $user_delete = User::onlyTrashed()->where('id', $id);
        $user_delete->forceDelete();

        return redirect('/trash')->with('status', 'Data masyarakat berhasil dihapus permanen.');
    }

    public function delete_all()
    {
        $delete_all = User::onlyTrashed();
        $delete_all->forceDelete();

        return redirect('/trash')->with('status', 'Semua data masyarakat berhasil dihapus permanen.');
    }
}
