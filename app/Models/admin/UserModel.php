<?php

namespace App\Models\admin;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'm_user';
    protected $allowedFields = [
        'idunik', 'kode', 'peminta', 'password', 'role_id', 'anggota_id', 'acc_setuju', 'batasacc', 'act_create', 'act_edit', 'act_confirm', 'act_delete', 'act_aktif',
        'act_perusahaan', 'perusahaan', 'act_wilayah', 'wilayah', 'act_divisi', 'divisi', 'act_gaji', 'gaji', 'act_camp', 'camp', 'act_proyek', 'proyek', 'act_alat',
        'alat', 'act_tanah', 'tanah', 'jenis_kas', 'act_super', 'act_saring', 'iz_pass', 'bgimg', 'is_confirm', 'is_aktif', 'updated_by', 'confirmed_by', 'activated_by'
    ];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    public function getUser($username)
    {
        return $this->db->table('m_user')
            ->select('m_user.*, m_penerima.id as idpeg, m_penerima.kode as kodepeg, m_penerima.nip as nippeg, m_penerima.nama as namapeng, m_penerima.is_confirm as confpeg, m_penerima.is_aktif as akpeg')
            ->join('m_penerima', 'm_user.id = m_penerima.user_id', 'left')
            ->where('m_user.is_confirm', '1')->where('m_user.is_aktif', '1')->where('m_user.kode', $username)
            ->where('m_user.deleted_at', null)
            ->get()->getRowArray();
    }
}
