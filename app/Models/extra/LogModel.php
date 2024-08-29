<?php

namespace App\Models\extra;

use CodeIgniter\Model;

class LogModel extends Model
{
    protected $table      = 'log_data';
    protected $allowedFields = ['menu', 'aksi', 'idunik', 'data', 'ip_address', 'is_show', 'created_by'];
    protected $useTimestamps = true;
    protected $urls;

    public function __construct()
    {
        parent::__construct();
        $this->urls = explode('/', $_SERVER['REQUEST_URI']);
    }

    public function saveLog($aksi, $idunik, $data, $show = '1')
    {
        $this->save([
            'menu' => $this->urls[1],
            'aksi' => $aksi,
            'idunik' => $idunik,
            'is_show' => $show,
            'data' => $data,
            'ip_address' => session()->ipaddress ?? '',
            'created_by' => session()->username ?? '',
        ]);
    }
}
