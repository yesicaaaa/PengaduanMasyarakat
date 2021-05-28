<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\Exports\MasyarakatExport;
use App\Exports\PetugasExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use App\Imports\MasyarakatImport;


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

    public function add_petugas()
    {
        return view('admin.tambah-petugas');
    }

    public function add_petugas_process(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'telp'      => 'required|max:13',
            'password'  => 'required|min:6|same:confirm_password',
            'confirm_password' => 'required|min:6|same:password'
        ]);

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'telp'      => $request->telp,
            'password'  => Hash::make($request->password)
        ])->attachRole('petugas');

        return redirect('/data_petugas')->with('status', 'Petugas baru berhasil ditambahkan.');
    }

    public function soft_delete_petugas($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/data_petugas')->with('status', 'Data petugas berhasil dihapus.');
    }

    public function trash_petugas()
    {
        $user = User::join('role_user', 'role_user.user_id', '=', 'users.id')
            ->where('role_user.role_id', '!=', 3)
            ->onlyTrashed()->get();

        return view('admin.trash-petugas', compact('user'));
    }

    public function restore_petugas($id)
    {
        $user = User::onlyTrashed()->where('id', $id);
        $user->restore();

        return redirect('/trash_petugas')->with('status', 'Data petugas berhasil dipulihkan');
    }

    public function delete_petugas($id)
    {
        $user = User::onlyTrashed()->where('id', $id);
        $user->forceDelete();

        return redirect('/trash_petugas')->with('status', 'Data petugas berhasil dihapus permanen');
    }

    public function delete_permanent_petugas()
    {
        $user = User::onlyTrashed();
        $user->forceDelete();

        return redirect('/trash_petugas')->with('status', 'Semua data petugas berhasil dihapus permanen');
    }

    public function restore_all_petugas()
    {
        $user = User::onlyTrashed();
        $user->forceDelete();

        return redirect('/trash_petugas')->with('status', 'Semua data petugas berhasil dipulihkan');
    }

    public function trash_pengaduan()
    {
        $pengaduan = Pengaduan::join('users', 'users.id', '=', 'pengaduan.id_user')
            ->onlyTrashed()->get();

        return view('admin.trash-pengaduan', compact('pengaduan'));
    }

    public function delete_pengaduan($id)
    {
        $pengaduan = Pengaduan::where('id_pengaduan', $id);
        $pengaduan->delete();

        return redirect('/beri_tanggapan_view_admin')->with('status', 'Data pengaduan berhasil dihapus.');
    }

    public function restore_pengaduan($id)
    {
        $pengaduan = Pengaduan::onlyTrashed()->where('id_pengaduan', $id);
        $pengaduan->restore();

        return redirect('/trash_pengaduan')->with('status', 'Data pengaduan berhasil dipulihkan');
    }

    public function delete_permanent_pengaduan($id)
    {
        $foto = Pengaduan::onlyTrashed()->where('id_pengaduan', $id)->get();
        foreach ($foto as $f) {
            File::delete('img/pengaduan_img/' . $f->foto);
        }

        $pengaduan = Pengaduan::onlyTrashed()->where('id_pengaduan', $id);
        $pengaduan->forceDelete();

        return redirect('/trash_pengaduan')->with('status', 'Data pengaduan berhasil dihapus');
    }

    public function all_delete_permanent_pengaduan()
    {
        $foto = Pengaduan::onlyTrashed()->get();
        foreach ($foto as $f) {
            File::delete('img/pengaduan_img/' . $f->foto);
        }
        
        $pengaduan = Pengaduan::onlyTrashed();
        $pengaduan->forceDelete();

        return redirect('/trash_pengaduan')->with('status', 'Semua data pengaduan berhasil dihapus');
    }

    public function restore_all_pengaduan()
    {
        $pengaduan = Pengaduan::onlyTrashed();
        $pengaduan->restore();

        return redirect('/trash_pengaduan')->with('status', 'Semua data pengaduan berhasil dihapus');
    }

    public function export_excel_masyarakat()
    {
        // return (new MasyarakatExport)->download('data-masyarakat.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        return Excel::download(new MasyarakatExport, 'data-masyarakat.xlsx');
    }

    public function export_excel_petugas()
    {
        return Excel::download(new PetugasExport, 'data-petugas.xlsx');
    }

    public function export_pdf_masyarakat()
    {
        $masyarakat = Masyarakat::join('role_user', 'role_user.user_id', '=', 'users.id')
                    ->where('role_user.role_id', 3)->get();
        $pdf = PDF::loadview('admin.pdf-data-masyarakat', compact('masyarakat'));
        return $pdf->download('data-masyarakat.pdf');
    }

    public function export_pdf_petugas()
    {
        $petugas = User::join('role_user', 'role_user.user_id', '=', 'users.id')
                    ->where('role_user.role_id', '!=', 3)->get();
        $pdf = PDF::loadview('admin.pdf-data-petugas', compact('petugas'));
        return $pdf->download('data-petugas.pdf');
    }

    public function import_excel_masyarakat(Request $request)
    {
        $request->validate([
            'file'  => 'required|mimes:csv,xls,xlsx'
        ]);
        //menangkap file excel
        $file = $request->file('file');
        //membuat nama file unik
        $nama_file = rand().$file->getClientOriginalName();
        //upload ke folder didalam folder public
        $file->move('file_import', $nama_file);

        Excel::import(new MasyarakatImport, public_path('/file_import/'.$nama_file));
        
        return redirect('/data_masyarakat')->with('status', 'Data Masyarakat berhasil diimport.');
    }
}
