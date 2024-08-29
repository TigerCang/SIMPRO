<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Konfigurasi extends Seeder
{
    public function run()
    {
        $konfig_data = [
            ['idunik' => 'b71bd216175ceb15820c9af693f85527', 'mode' => 'A', 'parameter' => 'konf_jlsetuju', 'nilai' => '1',], //jumlah persetujuan
            ['idunik' => '829dfd993ccc36896428e468b1ad4ec5', 'mode' => 'A', 'parameter' => 'acc_budget', 'nilai' => '1',], //acc anggaran
            ['idunik' => 'a517f40e43b1911261e4a394063aae66', 'mode' => 'A', 'parameter' => 'acc_mintaitem', 'nilai' => '1',], //acc permintaan item
            ['idunik' => 'a4f4dc87d8486c0ebaae1692abb6eacd', 'mode' => 'A', 'parameter' => 'konf_pilihsuplier', 'nilai' => '1',], //mulai pilih suplier
            ['idunik' => '2bd66f52de3e015c39667feb673afe53', 'mode' => 'A', 'parameter' => 'acc_salesorder', 'nilai' => '1',], //acc sales order
            ['idunik' => '63edf9c8e4c6484826bec4f978881dd6', 'mode' => 'A', 'parameter' => 'acc_tiketts', 'nilai' => '1',], //acc tiket ts
            ['idunik' => '2d9de6e17cb52052c54848da3e8d50fb', 'mode' => 'A', 'parameter' => 'acc_invoice', 'nilai' => '1',], //acc invoice
            ['idunik' => '3e49be6cc0b87027ec581e3034ccb63b', 'mode' => 'B', 'parameter' => 'folder_kas', 'subparam' => '/lampiran-kas', 'nilai' => '2025',], //bukti transaksi kas
            ['idunik' => '2569c7e0dc46355814329c2459fdeb98', 'mode' => 'B', 'parameter' => 'folder_hrd', 'subparam' => '/lampiran-hrd', 'nilai' => '2025',], //bukti transaksi hrd
        ];

        foreach ($konfig_data as $data) {
            $this->db->table('m_konfigurasi')->insert($data);
        }
    }
}
