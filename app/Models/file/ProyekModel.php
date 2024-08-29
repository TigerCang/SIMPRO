<?php

namespace App\Models\file;

use CodeIgniter\Model;

class ProyekModel extends Model
{
    protected $table      = 'm_proyek';
    protected $allowedFields = [
        'idunik', 'perusahaan_id', 'wilayah_id', 'divisi_id', 'kode', 'nama', 'paket', 'atasnama', 'lokasi', 'kbli_id', 'propinsi_id',
        'pemilik', 'scope', 'konsultan', 'asuransi', 'keuangan', 'pelaksanaan',  'tipe_id', 'carabayar', 'tgl_kontrak', 'tgl_pho',
        'tgl_fho', 'ppn', 'pph', 'ni_kontrak', 'ni_tambah', 'ni_lain', 'ni_bruto', 'ni_ppn', 'ni_pph', 'ni_netto', 'periode1', 'periode2',
        'modeyear', 'catatan', 'is_pajak', 'is_confirm', 'is_aktif', 'updated_by', 'confirmed_by', 'activated_by'
    ];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
