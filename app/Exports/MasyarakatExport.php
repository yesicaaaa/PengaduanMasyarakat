<?php

namespace App\Exports;

use App\Models\Masyarakat;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class MasyarakatExport implements FromView
{
    use Exportable;
    public function view(): View
    {
        return view('admin.export-data-masyarakat', [
            'masyarakat'    => Masyarakat::join('role_user', 'role_user.user_id', '=', 'users.id')
                                ->select('name', 'email', 'telp')
                                ->where('role_user.role_id', 3)->get()
            // 'masyarakat'    => Masyarakat::all()
        ]);
    }
}
