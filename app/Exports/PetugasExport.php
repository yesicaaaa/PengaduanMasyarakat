<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PetugasExport implements FromView
{
    public function view(): View
    {
        return view('admin.export-data-petugas', [
            'petugas'   => User::join('role_user', 'role_user.user_id', '=', 'users.id')
                            ->select('name', 'email', 'telp')
                            ->where('role_user.role_id', '!=', 3)->get()
        ]);
    }
}
