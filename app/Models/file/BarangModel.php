<?php

namespace App\Models\file;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table      = 'm_barang';
    protected $allowedFields = [
        'idunik', 'pilihan', 'kakun_id', 'kode', 'partnumber', 'nama', 'kategori', 'merk', 'satuan', 'stokmin', 'harga', 'biaya_id',
        'use_serial', 'gambar', 'catatan', 'is_confirm', 'is_aktif', 'updated_by', 'confirmed_by', 'activated_by'
    ];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
