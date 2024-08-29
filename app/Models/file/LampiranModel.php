<?php

namespace App\Models\file;

use CodeIgniter\Model;

class LampiranModel extends Model
{
    protected $table      = 'm_lampiran';
    protected $allowedFields = ['idunik', 'pilihan', 'judul', 'deskripsi', 'tanggal', 'lampiran', 'updated_by'];
    protected $useTimestamps = true;

    public function getLampiran($pilihan, $idunik)
    {
        $query = $this->db->table('m_lampiran a');
        $query->select('a.*, b.kode as user');
        $query->join('m_user b', 'a.updated_by = b.id', 'left');
        $query->where('a.pilihan', $pilihan)->where(['a.idunik' => $idunik]);
        $query->orderby('a.judul');
        return $query->get()->getResultArray();
    }
}
