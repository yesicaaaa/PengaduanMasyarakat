<?php

namespace App\Imports;

use App\Models\Masyarakat;
use Maatwebsite\Excel\Concerns\ToModel;

class MasyarakatImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Masyarakat([
            'name'      => $row[1],
            'email'     => $row[2],
            'password'  => '$2y$12$GNG.tJOEwoFjO0WlGpg4CuweY2mDzKdyzYdoSq/XlrZBOWyfrHV2S ',
            'telp'      => $row[3]
        ]);
    }
}
