<?php

namespace App\Models\file;

use CodeIgniter\Model;

class TanahModel extends Model
{
    protected $table      = 'm_tanah';
    protected $allowedFields = [
        'idunik', 'perusahaan_id', 'wilayah_id', 'divisi_id', 'kakun_id', 'kode', 'nama', 'kbli_id', 'lokasi', 'kategori', 'surat',
        'tgl_beli', 'umur', 'sisa', 'ni_beli', 'ni_residu', 'ni_susut', 'modsusut', 'bukti', 'gambar', 'catatan', 'nolink', 'is_jual',
        'is_confirm', 'is_aktif', 'updated_by', 'confirmed_by', 'activated_by'
    ];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
