<?php

namespace App\Models\file;

use CodeIgniter\Model;

class PenerimaModel extends Model
{
    protected $table      = 'm_penerima';
    protected $allowedFields = [
        'idunik', 'kode', 'nip', 'nama', 'perusahaan_id', 'wilayah_id', 'divisi_id', 'cabang_id', 'lokasi', 'kategori', 'rating', 'jenkel',
        'goldarah', 't4lahir', 'tgl_lahir', 'alamat', 'user_id', 'kontak', 'email', 'golongan_id', 'jabatan_id', 'atasan_id', 'ijasah', 'jurusan',
        'tgl_ijasah', 'st_ijasah', 'asuransi', 'nosim', 'jns_sim', 'tgl_sim', 'st_ptkp', 'tgl_join', 'st_pegawai', 'tgl_kontrakawal',
        'tgl_kontrakakhir', 'mode_keluar', 'tgl_keluar', 'alasan_keluar', 'st_pel', 'kakun_pel', 'st_sup', 'kakun_sup', 'st_lain', 'kakun_lain',
        'st_peg', 'kakun_peg', 'osm', 'catatan', 'gambar', 'is_confirm', 'is_aktif', 'updated_by', 'confirmed_by', 'activated_by'
    ];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
