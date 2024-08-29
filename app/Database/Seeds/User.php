<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    public function run()
    {
        $user_data = [
            [
                'idunik' => 'f1ecdd3919b03fc568a47c5fdbdc82d5',
                'kode' => 'Administrator',
                'password' => '$2y$10$tPzJ1EnbMDtmscyLwCJ.kOCsL3J460jwg4gvZhB8.6xswwBmf4wDq', 'role_id' => '1',
                'act_create' => '1', 'act_edit' => '1', 'act_confirm' => '1', 'act_delete' => '1', 'act_aktif' => '1',
                'act_perusahaan' => '1', 'act_wilayah' => '1', 'act_divisi' => '1', 'act_gaji' => '1',
                'act_camp' => '1', 'act_proyek' => '1', 'act_alat' => '1', 'act_tanah' => '1',
                'act_super' => '1', 'act_saring' => '1', 'is_confirm' => '1', 'is_aktif' => '1',
                'updated_by' => '0', 'confirmed_by' => '0', 'activated_by' => '0',
            ],
        ];

        foreach ($user_data as $data) {
            $this->db->table('m_user')->insert($data);
        }
    }
}
