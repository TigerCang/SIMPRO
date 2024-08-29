<?php

namespace App\Models\file;

use CodeIgniter\Model;

class PerusahaanModel extends Model
{
    protected $table      = 'm_perusahaan';
    protected $allowedFields = ['idunik', 'kode', 'kui', 'nama', 'alamat', 'telp', 'kota', 'direktur', 'penerima_id', 'logo', 'is_confirm', 'is_aktif', 'updated_by', 'confirmed_by', 'activated_by'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
