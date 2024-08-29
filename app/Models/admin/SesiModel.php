<?php

namespace App\Models\admin;

use CodeIgniter\Model;

class SesiModel extends Model
{
    protected $table      = 'log_sesi';
    protected $allowedFields = ['kode', 'nosesi', 'ip_address'];
    protected $useTimestamps = true;

    public function saveSesi()
    {
        $this->save([
            'kode' => session()->username,
            'nosesi' => session_id(),
            'ip_address' => get_ip(),
        ]);
    }

    public function delSesi()
    {
        $this->where(['kode' => session()->username])->delete();
    }

    public function getSesi($username, $nosesi)
    {
        return $this->where(['kode' => $username])->where(['nosesi' => $nosesi])->first();
    }

    // public function cekSesi($username)
    // {
    //     $user = $this->where(['kode' => $username])->where(['is_confirm' => 'on'])->where(['is_aktif' => 'on'])->first();
    //     if (!$user) return false;
    //     // return !empty($user['kode']);
    //     dd(session()->has('username'), session('username'), $user['kode']);
    //     return session()->has('username') && session('username') == $user['kode'];
    // }
}
