<?php

namespace App\Models\trkas;

use CodeIgniter\Model;

class KaspajakModel extends Model
{
    protected $table      = 'kas_pajak';
    protected $allowedFields = ['kasanak_id', 'nomor', 'masapajak', 'objekpajak_id', 'nilai_dpp', 'tarif', 'nilai_potong', 'dokref_id'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
