<?php

namespace App\Models\file;

use CodeIgniter\Model;

class AlatModel extends Model
{
    protected $table      = 'm_alat';
    protected $allowedFields = [
        'idunik', 'pilihan', 'penerima_id', 'perusahaan_id', 'wilayah_id', 'divisi_id', 'perusahaanin_id', 'kakun_id', 'kode', 'nomor',
        'nama', 'kbli_id', 'merk', 'bentuk', 'kategori_id', 'jenis', 'surat', 'mesin', 'transmisi', 'tgl_beli', 'tgl_produksi',
        'tgl_stnk', 'tgl_keur', 'umur', 'sisa', 'ni_beli', 'ni_residu', 'ni_sewa', 'ni_susut', 'modsusut', 'berat', 'ibbm', 'bukti',
        'supir_id', 'biaya_id', 'gambar', 'catatan', 'nolink', 'is_jual', 'is_confirm', 'is_aktif', 'updated_by', 'confirmed_by', 'activated_by'
    ];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
