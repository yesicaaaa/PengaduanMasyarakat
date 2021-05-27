<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::user()->hasRole('admin')){
            return redirect('/data_masyarakat')->with('status', 'Anda berhasil login sebagai admin.');
        }elseif(Auth::user()->hasRole('petugas')){
            return redirect('/beri_tanggapan_view_petugas')->with('status', 'Anda berhasil login sebagai petugas.');
        }elseif(Auth::user()->hasRole('masyarakat')){
            return redirect('/pengaduan_saya')->with('status', 'Anda berhasil login sebagai masyarakat.');
        }
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
