<?php

namespace App\Models\file;

use CodeIgniter\Model;

class ToolModel extends Model
{
    protected $table      = 'm_tool';
    protected $allowedFields = [
        'idunik', 'perusahaan_id', 'wilayah_id', 'divisi_id', 'kode', 'nama', 'merk', 'mesin', 'tgl_beli', 'ni_beli', 'ni_sewa',
        'biaya_id', 'gambar', 'catatan', 'nolink', 'is_jual', 'is_confirm', 'is_aktif'
    ];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
