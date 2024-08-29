<?php

namespace App\Models\admin;

use CodeIgniter\Model;

class KonfigurasiModel extends Model
{
    protected $table      = 'm_konfigurasi';
    protected $allowedFields = ['idunik', 'parameter', 'subparam', 'nilai', 'updated_by'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    public function getKonfigurasi($parameter = false)
    {
        $query = $this->db->table('m_konfigurasi');
        $query->select('m_konfigurasi.*, m_user.kode as user');
        $query->join('m_user', 'm_konfigurasi.updated_by = m_user.id', 'left');
        if ($parameter !== false) $query->where('m_konfigurasi.parameter', $parameter);
        return $query->get()->getResultArray();
    }
}
