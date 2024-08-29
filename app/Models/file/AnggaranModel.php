<?php

namespace App\Models\file;

use CodeIgniter\Model;

class AnggaranModel extends Model
{
    protected $table      = 'm_anggaran';
    protected $allowedFields = ['idunik', 'pilihan', 'tujuan', 'jenis', 'biaya_id', 'akun_id', 'bulan', 'jumlah', 'harga', 'total', 'catatan', 'levsatu', 'is_confirm', 'is_aktif', 'updated_by', 'confirmed_by', 'activated_by'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
