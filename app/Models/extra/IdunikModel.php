<?php

namespace App\Models\extra;

use CodeIgniter\Model;

class IdunikModel extends Model
{
    protected $table      = 'm_idunik';
    protected $allowedFields = ['kode', 'idunik'];

    public function saveID($data)
    {
        $this->save([
            'kode' => session()->username,
            'idunik' => $data,
        ]);
    }

    public function cekID($data)
    {
        return $this->where(['idunik' => $data])->first();
    }
}
