<?php

namespace App\Models\trkas;

use CodeIgniter\Model;

class KasindukModel extends Model
{
    protected $table      = 'kas_induk';
    protected $allowedFields = [
        'idunik', 'user_id', 'peminta_id', 'last_id', 'pilihan', 'tujuan', 'perusahaan_id', 'wilayah_id', 'divisi_id',  'nodoc', 'tgl_minta', 'tanggal',
        'revisi', 'beban_id', 'penerima_id', 'kbli_id', 'asal', 'jenis', 'level', 'acc_1', 'acc_2', 'periode', 'is_pajak', 'is_sama', 'status', 'lampiran',
    ];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
