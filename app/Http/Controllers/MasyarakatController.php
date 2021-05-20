<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasyarakatController extends Controller
{
    public function index()
    {
        return view('masyarakat.form-pengaduan');
    }
}
