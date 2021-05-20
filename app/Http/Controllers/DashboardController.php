<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::user()->hasRole('admin')){
            return view('admin.dashboard');
        }elseif(Auth::user()->hasRole('petugas')){
            return view('petugas.dashboard');
        }elseif(Auth::user()->hasRole('masyarakat')){
            return view('masyarakat.dashboard');
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
