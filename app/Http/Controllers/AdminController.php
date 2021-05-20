<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function data_masyarakat()
    {
        $masyarakat = DB::table('users')->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_id', 3)->get();
        return view('admin.data-masyarakat', compact('masyarakat'));
    }

    public function data_petugas()
    {
        $petugas = DB::table('users')->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_id', '!=', 3)->get();
        return view('admin.data-petugas', compact('petugas'));
    }
}
