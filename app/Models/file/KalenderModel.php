<?php

namespace App\Models\file;

use CodeIgniter\Model;

class KalenderModel extends Model
{
    protected $table      = 'm_kalender';
    protected $allowedFields = ['tanggal', 'nama', 'potong_cuti', 'updated_by'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
