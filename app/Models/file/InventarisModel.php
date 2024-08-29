<?php

namespace App\Models\file;

use CodeIgniter\Model;

class InventarisModel extends Model
{
    protected $table      = 'm_inventaris';
    protected $allowedFields = [
        'idunik', 'perusahaan_id', 'wilayah_id', 'divisi_id', 'cabang_id', 'kakun_id', 'kode', 'nama', 'tgl_beli', 'umur', 'sisa', 'bukti',
        'ni_beli', 'ni_residu', 'ni_susut', 'modsusut', 'kategori', 'pegawai_id', 'lokasi', 'gambar', 'catatan', 'nolink', 'is_jual', 'is_confirm',
        'is_aktif', 'updated_by', 'confirmed_by', 'activated_by'
    ];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
