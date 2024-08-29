<?php

namespace App\Models\extra;

use CodeIgniter\Model;

class LogaksiModel extends Model
{
    protected $table      = 'log_aksi';
    protected $allowedFields = [
        'idunik', 'user_id', 'menu', 'pilihan', 'aksi', 'data', 'level',  'st_seru', 'catatan', 'lama', 'ip_address'
    ];
    protected $useTimestamps = true;
}
