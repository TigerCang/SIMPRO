<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Role extends Seeder
{
    public function run()
    {
        $role_data = [
            ['idunik' => 'fd4cec9e6ffb5f175577d39db0cc4818', 'nama' => 'Admin', 'menu_1' => 'A01,101,102,103,104,105', 'is_confirm' => '1', 'is_aktif' => '1',],
        ];

        foreach ($role_data as $data) {
            $this->db->table('m_role')->insert($data);
        }
    }
}
