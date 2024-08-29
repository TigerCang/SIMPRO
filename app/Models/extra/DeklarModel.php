<?php

namespace App\Models\extra;

use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Database\MySQLi\Builder;

class DeklarModel
{
    protected $db;
    public function __construct()
    {
        $this->db = \config\Database::connect(); //diganti dengan db_connect();
        // $this->db = db_connect();
    }

    // ____________________________________________________________________________________________________________________________
    public function satuID($table, $data, $uslog = 'n', $field = 'idunik', $aktif = false)
    {
        if ($uslog == 'y') {
            $builder = $this->db->table("$table a");
            $builder->select('a.*, m.kode as upby, n.kode as coby, p.kode as akby');
            $builder->where("a.$field", $data)->where(['a.deleted_at' => null]);
            $builder->join('m_user m', 'm.id = a.updated_by', 'left');
            $builder->join('m_user n', 'n.id = a.confirmed_by', 'left');
            $builder->join('m_user p', 'p.id = a.activated_by', 'left');
        } else {
            $builder = $this->db->table($table);
            $builder->where($field, $data)->where(['deleted_at' => null]);
            if ($aktif == true) $builder->where('is_confirm', '1')->where('is_aktif', '1');
        }
        return $builder->get()->getResult();
    }
    public function lastID($table)
    {
        $builder = $this->db->table($table);
        $builder->orderby('id desc');
        $builder->limit(1);
        return $builder->get()->getResult();
    }
    public function distSelect($param, $kelompok = false)
    {
        $builder = $this->db->table('m_select');
        ($kelompok == false) ? $builder->select('*') : $builder->select('kelompok')->distinct();
        $builder->where('param', $param);
        $builder->orderBy('nomor');
        return $builder->get()->getResult();
    }
    public function distItem($table, $field, $pilihan = false, $fieldfilter = 'pilihan')
    {
        $builder = $this->db->table($table);
        $builder->select('*')->where("$field !=", '');
        if ($pilihan == true) $builder->where($fieldfilter, $pilihan);
        $builder->groupBy($field);
        $builder->orderBy($field);
        return $builder->get()->getResult();
    }

    // ____________________________________________________________________________________________________________________________
    public function updateData($table, $field, $data, $filter, $datafilter)
    {
        $builder = $this->db->table($table);
        $builder->set($field, $data);
        $builder->where($filter, $datafilter);
        $builder->update();
    }
    public function updateDeletedat($table, $id, $hapus = false)
    {
        $builder = $this->db->table($table);
        $builder->where('id', $id);
        $builder->update(['deleted_at' => null]);
    }

    // ____________________________________________________________________________________________________________________________
    public function getRole($menu, $aktif = false)
    {
        $builder = $this->db->table('m_role a');
        $builder->select('a.*, x.id as xlog');
        if ($aktif == true) $builder->where('a.is_confirm', '1')->where('a.is_aktif', '1');
        $strx = ($menu != '' ? ' AND x.menu = "' . $menu . '" AND x.created_by = "' . session()->username . '"' : '');
        $builder->where(['a.deleted_at' => null]);
        $builder->join('log_data x', 'x.idunik = a.idunik' . $strx, 'left');
        $builder->groupby('a.id')->orderby('a.nama');
        return $builder->get()->getResult();
    }
    public function cekRole($nama, $idunik)
    {
        $builder = $this->db->table('m_role');
        $builder->where('nama', $nama)->where('idunik !=', $idunik);
        return $builder->get()->getResult();
    }
    public function getUser($menu, $atasan = false,  $aktif = false)
    {
        $builder = $this->db->table('m_user a');
        $builder->select('a.*, b.nama as role, c.nama as namauser, x.id as xlog');
        if ($atasan == true) $builder->where('a.atasan_id', $atasan);
        if ($aktif == true) $builder->where('a.is_confirm', '1')->where('a.is_aktif', '1');
        $strx = ($menu != '' ? ' AND x.menu = "' . $menu . '" AND x.created_by = "' . session()->username . '"' : '');
        $builder->join('m_role b', 'a.role_id = b.id', 'left');
        $builder->join('m_penerima c', 'a.id = c.user_id', 'left');
        $builder->join('log_data x', 'x.idunik = a.idunik' . $strx, 'left');
        $builder->where(['a.deleted_at' => null]);
        $builder->groupby('a.id')->orderby('a.kode');
        return $builder->get()->getResult();
    }
    public function loadUser($isi, $pegawai)
    {
        $kondisi = ($pegawai == '1' ? 'inner' : 'left');
        $builder = $this->db->table('m_user a');
        $builder->select('a.*, b.nama as role, c.id as idpegawai, c.nama as namapegawai');
        $builder->where("(a.kode like \"%$isi%\" or c.nama like \"%$isi%\")");
        $builder->where('a.is_confirm', '1')->where('a.is_aktif', '1')->where(['a.deleted_at' => null]);
        $builder->join('m_role b', 'a.role_id=b.id', 'left');
        $builder->join('m_penerima c', 'a.id=c.user_id', $kondisi);
        $builder->orderby('a.kode');
        $builder->limit(jllimit);
        return $builder->get()->getResult();
    }
    public function get1User($data, $deklar = false)
    {
        $builder = $this->db->table('m_user a');
        $builder->select('a.*, b.nama as role, c.nama as namapeg');
        $builder->where('a.id', $data)->where('a.is_confirm', '1')->where('a.is_aktif', '1');
        if ($deklar == false) $builder->where('c.is_confirm', '1')->where('c.is_aktif', '1');
        $builder->join('m_role b', 'a.role_id=b.id', 'left');
        $builder->join('m_penerima c', 'a.id=c.user_id', 'left');
        $builder->where(['a.deleted_at' => null]);
        return $builder->get()->getResult();
    }
    public function getLog($username, $isi, $detil)
    {
        $builder = $this->db->table('log_data');
        $builder->where("(menu like \"%$isi%\" or data like \"%$isi%\")");
        if ($username != '') $builder->where('created_by', $username);
        if ($detil == '') $builder->where('is_show', '1');
        $builder->orderby('id desc');
        $builder->limit(10 * jllimit);
        return $builder->get()->getResult();
    }
    public function getSandiuser()
    {
        $builder = $this->db->table('m_user a');
        $builder->select('a.kode, a.id as iduser, b.kode as kodepeg, b.nip, b.nama, c.kode as perusahaan, d.nama as wilayah, e.nama as divisi');
        $builder->join('m_penerima b', 'b.user_id = a.id', 'left');
        $builder->join('m_perusahaan c', 'b.perusahaan_id = c.id', 'left');
        $builder->join('m_divisi d', 'b.wilayah_id = d.id', 'left');
        $builder->join('m_divisi e', 'b.divisi_id = e.id', 'left');
        $builder->where('iz_pass',  '1');
        $builder->orderby('a.kode');
        return $builder->get()->getResult();
    }

    // ____________________________________________________________________________________________________________________________
    public function getPerusahaan($menu, $aktif = false)
    {
        $builder = $this->db->table('m_perusahaan a');
        $builder->select('a.*, b.kode as kodepenerima, b.nama as namapenerima, x.id as xlog');
        if ($aktif == true) $builder->where('a.is_confirm', '1')->where('a.is_aktif', '1');
        $strx = ($menu != '' ? ' AND x.menu = "' . $menu . '" AND x.created_by = "' . session()->username . '"' : '');
        $builder->join('m_penerima b', 'b.id = a.penerima_id', 'left');
        $builder->join('log_data x', 'x.idunik = a.idunik' . $strx, 'left');
        $builder->where(['a.deleted_at' => null]);
        $builder->groupBy('a.id')->orderby('a.kode');
        return $builder->get()->getResult();
    }
    public function getDivisi($menu, $pilihan, $aktif = false, $sdef = false)
    {
        $builder = $this->db->table('m_divisi a');
        $builder->select('a.*, x.id as xlog');
        if ($aktif == true) $builder->where('a.is_confirm', '1')->where('a.is_aktif', '1');
        if ($sdef == true) $builder->where('a.setdef', '1');
        $strx = ($menu != '' ? ' AND x.menu = "' . $menu . '" AND x.created_by = "' . session()->username . '"' : '');
        $builder->join('log_data x', 'x.idunik = a.idunik' . $strx, 'left');
        $builder->where('a.pilihan',  $pilihan)->where(['a.deleted_at' => null]);
        $builder->groupBy('a.id')->orderby('a.nama');
        return $builder->get()->getResult();
    }
    public function cekDivisi($pilihan, $nama, $idunik)
    {
        $builder = $this->db->table('m_divisi');
        $builder->where('pilihan', $pilihan)->where('nama', $nama);
        $builder->where('idunik !=', $idunik);
        return $builder->get()->getResult();
    }
    public function cekKodeDivisi($pilihan, $kode, $idunik)
    {
        $builder = $this->db->table('m_divisi');
        $builder->where('pilihan', $pilihan)->where('kode', $kode);
        $builder->where('idunik !=', $idunik);
        return $builder->get()->getResult();
    }
    public function getGudang($menu, $pilihan, $aktif = false, $perusahaan = false, $wilayah = false, $divisi = false)
    {
        // $query = $this->db->query("SELECT a.*,b.kode as perusahaan,c.nama as wilayah,d.nama as divisi 
        // FROM m_divisi a,m_perusahaan b,m_divisi c,m_divisi d where a.pilihan='gudang' and a.perusahaan_id=b.id
        // and a.wilayah_id=c.id and a.divisi_id=d.id and a.deleted_at is NULL order by a.nama");
        // return $query->getResult();
        $builder = $this->db->table('m_divisi a');
        $builder->select('a.*, b.kode as perusahaan, c.nama as wilayah, d.nama as divisi, x.id as xlog');
        $builder->where('a.pilihan',  $pilihan)->where(['a.deleted_at' => null]);
        if ($aktif == true) $builder->where('a.is_confirm', '1')->where('a.is_aktif', '1');
        if ($perusahaan == true) $builder->where('a.perusahaan_id', $perusahaan);
        if ($divisi == true) $builder->where('a.divisi_id', $divisi);
        if ($wilayah == true) $builder->where('a.wilayah_id', $wilayah);
        $strx = ($menu != '' ? ' AND x.menu = "' . $menu . '" AND x.created_by = "' . session()->username . '"' : '');
        $builder->join('m_perusahaan b', 'b.id = a.perusahaan_id');
        $builder->join('m_divisi c', 'c.id = a.wilayah_id');
        $builder->join('m_divisi d', 'd.id = a.divisi_id');
        $builder->join('log_data x', 'x.idunik = a.idunik' . $strx, 'left');
        $builder->groupBy('a.id')->orderby('a.nama');
        return $builder->get()->getResult();
    }
    public function getDokumen($menu)
    {
        $builder = $this->db->table('m_divisi a');
        $builder->select('a.*, b.kelompok as kelompok, x.id as xlog');
        $builder->where('a.pilihan',  'dokumen')->where(['a.deleted_at' => null]);
        $builder->where('b.param',  'formulir');
        $strx = ($menu != '' ? ' AND x.menu = "' . $menu . '" AND x.created_by = "' . session()->username . '"' : '');
        $builder->join('m_select b', 'a.param=b.nama', 'left');
        $builder->join('log_data x', 'x.idunik = a.idunik' . $strx, 'left');
        $builder->groupBy('a.id')->orderby('b.nomor');
        return $builder->get()->getResult();
    }
    public function getISO($menu, $pilihan, $perusahaan = false, $divisi = false)
    {
        $builder = $this->db->table('m_divisi a');
        $builder->select('a.*, b.kode as perusahaan, c.nama as wilayah, d.nama as divisi, x.id as xlog');
        $builder->where('a.pilihan',  $pilihan)->where(['a.deleted_at' => null]);
        if ($perusahaan == true) $builder->where('a.perusahaan_id', $perusahaan);
        if ($divisi == true) $builder->where('a.divisi_id', $divisi);
        $strx = ($menu != '' ? ' AND x.menu = "' . $menu . '" AND x.created_by = "' . session()->username . '"' : '');
        $builder->join('m_perusahaan b', 'b.id = a.perusahaan_id', 'left');
        $builder->join('m_divisi c', 'c.id = a.wilayah_id', 'left');
        $builder->join('m_divisi d', 'd.id = a.divisi_id', 'left');
        $builder->join('log_data x', 'x.idunik = a.idunik' . $strx, 'left');
        $builder->groupBy('a.id')->orderby('a.nama');
        return $builder->get()->getResult();
    }
    public function cekForm($pilihan, $form, $idunik = false, $aktif = '',  $perusahaan = '', $wilayah = '', $divisi = '')
    {
        $builder = $this->db->table('m_divisi');
        $builder->where('pilihan', $pilihan)->where('param', $form);
        $builder->where(['deleted_at' => null]);
        if ($perusahaan != '') $builder->where('perusahaan_id', $perusahaan);
        if ($wilayah != '') $builder->where('wilayah_id', $wilayah);
        if ($divisi != '') $builder->where('divisi_id', $divisi);
        if ($aktif == true) $builder->where('is_confirm', '1')->where('is_aktif', '1');
        if ($idunik == true) $builder->where('idunik !=', $idunik);
        return $builder->get()->getResult();
    }
    public function getPropinsi($menu, $aktif = false)
    {
        $builder = $this->db->table('m_propinsi a');
        $builder->select('a.*, x.id as xlog');
        if ($aktif == true) $builder->where('a.is_confirm', '1')->where('a.is_aktif', '1');
        $strx = ($menu != '' ? ' AND x.menu = "' . $menu . '" AND x.created_by = "' . session()->username . '"' : '');
        $builder->where(['a.deleted_at' => null]);
        $builder->join('log_data x', 'x.idunik = a.idunik' . $strx, 'left');
        $builder->groupBy('a.id')->orderBy('a.propinsi,a.kabupaten');
        return $builder->get()->getResult();
    }
    public function cekPropinsi($propinsi, $kabupaten, $idunik)
    {
        $builder = $this->db->table('m_propinsi');
        $builder->where('propinsi', $propinsi)->where('kabupaten', $kabupaten);
        $builder->where('idunik !=', $idunik);
        return $builder->get()->getResult();
    }
    public function getKabupaten($propinsi)
    {
        $builder = $this->db->table('m_propinsi');
        $builder->where('propinsi', $propinsi);
        $builder->where('is_confirm', '1')->where('is_aktif', '1')->where(['deleted_at' => null]);
        $builder->orderby('kabupaten');
        return $builder->get()->getResult();
    }
    public function getBiaya($menu, $pilihan, $kategori)
    {
        $builder = $this->db->table('m_biaya a');
        $builder->select('a.*, b.noakun as noakun, b.nama as namaakun, c.nama as katproyek, x.id as xlog');
        $builder->where('a.pilihan', $pilihan)->where(['a.deleted_at' => null]);
        if ($kategori != '') ($pilihan == 'blangsung') ? $builder->where('a.tipe_id', $kategori) : $builder->like('a.kode', $kategori, 'after');
        $strx = ($menu != '' ? ' AND x.menu = "' . $menu . '" AND x.created_by = "' . session()->username . '"' : '');
        $builder->join('m_akun b', 'b.id=a.akun_id', 'left');
        $builder->join('m_divisi c', 'c.id=a.tipe_id', 'left');
        $builder->join('log_data x', 'x.idunik = a.idunik' . $strx, 'left');
        $builder->groupBy('a.id')->orderby('a.tipe_id,a.kode');
        return $builder->get()->getResult();
    }
    public function loadBiaya($pilihan, $level, $katproyek, $isi, $awal = false)
    {
        $builder = $this->db->table('m_biaya');
        $builder->where('pilihan', $pilihan);
        if ($katproyek != '') $builder->where('tipe_id', $katproyek);
        if ($awal == true) $builder->like('kode', $awal, 'after');
        $builder->where("(kode like \"%$isi%\" or nama like \"%$isi%\")");
        $builder->where('is_confirm', '1')->where('is_aktif', '1')->where('level', $level)->where(['deleted_at' => null]);
        $builder->orderby('kode');
        $builder->limit(jllimit);
        return $builder->get()->getResult();
    }
    public function cekBiaya($kode, $kategori, $idunik)
    {
        $builder = $this->db->table('m_biaya');
        $builder->where('kode', $kode)->where('tipe_id', $kategori);
        $builder->where('idunik !=', $idunik);
        return $builder->get()->getResult();
    }
    public function cekIndukbiaya($pilihan, $induk, $level, $kategori)
    {
        $builder = $this->db->table('m_biaya');
        $builder->where('pilihan', $pilihan)->where('kode', $induk)->where('level', $level);
        $builder->where('tipe_id', $kategori);
        $builder->where('is_confirm', '1')->where('is_aktif', '1')->where(['deleted_at' => null]);
        return $builder->get()->getResult();
    }
    public function getIndukbiaya($pilihan, $biaya)
    {
        if ($pilihan == 'akun') {
            $builder = $this->db->table('m_akun a');
            $builder->select('a.*, b.id as idlev3, c.id as idlev2, d.id as idlev1');
            $builder->join('m_akun b', 'a.induk_id=b.id', 'left');
            $builder->join('m_akun c', 'b.induk_id=c.id', 'left');
            $builder->join('m_akun d', 'c.induk_id=d.id', 'left');
        } else {
            $builder = $this->db->table('m_biaya a');
            if ($pilihan == 'bl') {
                $builder->select('a.*, c.id as idlev2, d.id as idlev1');
                $builder->join('m_biaya c', 'a.induk_id=c.id', 'left');
                $builder->join('m_biaya d', 'c.induk_id=d.id', 'left');
            } else { // biaya
                $builder->select('a.*, b.id as idlev3, c.id as idlev2, d.id as idlev1');
                $builder->join('m_biaya b', 'a.induk_id=b.id', 'left');
                $builder->join('m_biaya c', 'b.induk_id=c.id', 'left');
                $builder->join('m_biaya d', 'c.induk_id=d.id', 'left');
            }
        }
        $builder->where('a.id', $biaya);
        return $builder->get()->getResult();
    }

    public function distBiayalv1($pilihan)
    {
        $builder = $this->db->table('m_biaya');
        $builder->select('kode,nama')->distinct();
        $builder->where('pilihan', $pilihan)->where('level', '1');
        $builder->orderBy('kode');
        return $builder->get()->getResult();
    }
    public function getAnggaran($menu, $dist = '1', $idunik = false, $tujuan = false, $pilihan = false, $jenis = false)
    {
        $builder = $this->db->table('m_anggaran a');
        $ordby = '';
        if ($dist == '1') {
            $builder->select('a.*, b.nama as jenisbiaya, x.id as xlog')->where('a.levsatu', '1');
            $strx = ($menu != '' ? ' AND x.menu = "' . $menu . '" AND x.created_by = "' . session()->username . '"' : '');
            $builder->join('m_biaya b', 'a.jenis = b.kode',  'left');
            $builder->join('log_data x', 'x.idunik = a.idunik' . $strx, 'left');
        } else {
            if (strlen($idunik) == 32) {
                if ($tujuan == 'proyek')
                    $builder->select('a.*, b.kode as kode, b.nama as deskripsi, b.level as level');
                else
                    $builder->select('a.*, c.noakun as kode, c.nama as deskripsi, c.level as level');
                $builder->where('a.idunik', $idunik);
                $builder->join('m_biaya b', 'a.biaya_id=b.id', 'left');
                $builder->join('m_akun c', 'a.akun_id=c.id', 'left');
                $ordby = ',b.kode, c.noakun, a.id';
            } else {
                $builder->where('a.pilihan', $pilihan)->where('a.tujuan', $tujuan);
            }
        }
        $builder->where(['a.deleted_at' => null]);
        $builder->groupBy('a.id')->orderby("a.pilihan, a.tujuan $ordby");
        return $builder->get()->getResult();
    }
    public function cekAnggaran($idunik, $pilih, $data1, $data2, $data3 = false)
    {
        $builder = $this->db->table('m_anggaran');
        if ($idunik != '') $builder->where('idunik', $idunik);
        ($pilih == 'objek') ? $builder->where('pilihan', $data1)->where('tujuan', $data2) : $builder->where($data1, $data2);
        if ($data3 == true) $builder->where('jenis', $data3);
        $builder->where(['deleted_at' => null]);
        return $builder->get()->getResult();
    }
    public function anggaranTotal($idunik, $induk, $tabel)
    {
        $builder = $this->db->table('m_anggaran a');
        $builder->where('a.idunik', $idunik)->where(['a.deleted_at' => null]);
        $builder->select('sum(a.total) as subtotal');
        $builder->where('b.induk_id', $induk);
        $builder->groupBy('b.induk_id');
        ($tabel == 'akun') ? $builder->join('m_akun b', 'a.akun_id = b.id', 'left') : $builder->join('m_biaya b', 'a.biaya_id = b.id', 'left');
        return $builder->get()->getResult();
    }

    // ____________________________________________________________________________________________________________________________    
    public function getCamp($menu, $aktif, $perusahaan = false, $divisi = false)
    {
        $builder = $this->db->table('m_camp a');
        $builder->select('a.*, b.kode as perusahaan, c.nama as wilayah, d.nama as divisi, x.id as xlog');
        if ($aktif != '') $builder->where('a.is_confirm', '1')->where('a.is_aktif', '1');
        if ($perusahaan == true) $builder->where('a.perusahaan_id', $perusahaan);
        if ($divisi == true) $builder->where('a.divisi_id', $divisi);
        $strx = ($menu != '' ? ' AND x.menu = "' . $menu . '" AND x.created_by = "' . session()->username . '"' : '');
        $builder->where(['a.deleted_at' => null]);
        $builder->join('m_perusahaan b', 'a.perusahaan_id=b.id', 'left');
        $builder->join('m_divisi c', 'a.wilayah_id=c.id', 'left');
        $builder->join('m_divisi d', 'a.divisi_id=d.id', 'left');
        $builder->join('log_data x', 'x.idunik = a.idunik' . $strx, 'left');
        $builder->groupBy('a.id')->orderby('kode');
        return $builder->get()->getResult();
    }
    public function loadCamp($isi, $perusahaan, $wilayah, $divisi)
    {
        $builder = $this->db->table('m_camp a');
        $builder->select('a.*, c.kode as perusahaan, d.nama as wilayah, e.nama as divisi');
        $builder->where("(a.kode like \"%$isi%\" or a.nama like \"%$isi%\")");
        $builder->where('a.is_confirm', '1')->where('a.is_aktif', '1')->where(['a.deleted_at' => null]);
        $builder->where('c.is_confirm', '1')->where('c.is_aktif', '1')->where('c.deleted_at', null);
        $builder->where('d.is_confirm', '1')->where('d.is_aktif', '1')->where('d.deleted_at', null);
        $builder->where('e.is_confirm', '1')->where('e.is_aktif', '1')->where('e.deleted_at', null);
        if ($perusahaan != '') $builder->where('a.perusahaan_id', $perusahaan);
        if ($wilayah != '') $builder->where('a.wilayah_id', $wilayah);
        if ($divisi != '') $builder->where('a.divisi_id', $divisi);
        $builder->join('m_perusahaan c', 'a.perusahaan_id=c.id', 'left');
        $builder->join('m_divisi d', 'a.wilayah_id=d.id', 'left');
        $builder->join('m_divisi e', 'a.divisi_id=e.id', 'left');
        $builder->orderby('a.kode');
        $builder->limit(jllimit);
        return $builder->get()->getResult();
    }
    public function getProyek($menu, $aktif, $perusahaan = false, $wilayah = false, $tahun = false)
    {
        $builder = $this->db->table('m_proyek a');
        $builder->select('a.*, b.kode as perusahaan, c.nama as wilayah, d.nama as divisi, x.id as xlog');
        if ($aktif != '') $builder->where('a.is_confirm', '1')->where('a.is_aktif', '1');
        if ($perusahaan == true) $builder->where('a.perusahaan_id', $perusahaan);
        if ($wilayah == true) $builder->where('a.wilayah_id', $wilayah);
        if ($tahun == true) $builder->where('a.periode1', $tahun);
        $strx = ($menu != '' ? ' AND x.menu = "' . $menu . '" AND x.created_by = "' . session()->username . '"' : '');
        $builder->where(['a.deleted_at' => null]);
        $builder->join('m_perusahaan b', 'a.perusahaan_id=b.id', 'left');
        $builder->join('m_divisi c', 'a.wilayah_id=c.id', 'left');
        $builder->join('m_divisi d', 'a.divisi_id=d.id', 'left');
        $builder->join('log_data x', 'x.idunik = a.idunik' . $strx, 'left');
        $builder->groupBy('a.id')->orderby('kode');
        return $builder->get()->getResult();
    }
    public function loadProyek($isi, $perusahaan, $wilayah, $divisi)
    {
        $builder = $this->db->table('m_proyek a');
        $builder->select('a.*, b.kode as kodekbli, b.nama as namakbli, c.kode as perusahaan, c.penerima_id as penerimaid, d.nama as wilayah, e.nama as divisi');
        $builder->where("(a.kode like \"%$isi%\" or a.paket like \"%$isi%\")");
        $builder->where('a.is_confirm', '1')->where('a.is_aktif', '1')->where('a.deleted_at', null);
        $builder->where('b.is_confirm', '1')->where('b.is_aktif', '1')->where('b.deleted_at', null);
        $builder->where('c.is_confirm', '1')->where('c.is_aktif', '1')->where('c.deleted_at', null);
        $builder->where('d.is_confirm', '1')->where('d.is_aktif', '1')->where('d.deleted_at', null);
        $builder->where('e.is_confirm', '1')->where('e.is_aktif', '1')->where('e.deleted_at', null);
        if ($perusahaan != '') $builder->where('a.perusahaan_id', $perusahaan);
        if ($wilayah != '') $builder->where('a.wilayah_id', $wilayah);
        if ($divisi != '') $builder->where('a.divisi_id', $divisi);
        $builder->join('m_kbli b', 'a.kbli_id=b.id', 'left');
        $builder->join('m_perusahaan c', 'a.perusahaan_id=c.id', 'left');
        $builder->join('m_divisi d', 'a.wilayah_id=d.id', 'left');
        $builder->join('m_divisi e', 'a.divisi_id=e.id', 'left');
        $builder->orderby('a.kode');
        $builder->limit(jllimit);
        return $builder->get()->getResult();
    }
    public function getRuas($menu, $pilih, $aktif = false, $proyek = false, $camp = false)
    {
        $builder = $this->db->table('m_ruas a');
        $builder->select('a.*,b.kode as kodeproyek, b.paket as namapaket, c.kode as perusahaan, d.nama as wilayah, g.nama as divisi, e.kode as kodecamp, e.nama as namacamp, f.kode as koderuas, f.nama as namaruas, x.id as xlog');
        $builder->where('a.pilihan', $pilih);
        if ($aktif != '') $builder->where('a.is_confirm', '1')->where('a.is_aktif', '1');
        if ($proyek == true) $builder->where('a.proyek_id', $proyek);
        if ($camp == true) $builder->where('a.camp_id', $camp);
        $strx = ($menu != '' ? ' AND x.menu = "' . $menu . '" AND x.created_by = "' . session()->username . '"' : '');
        $builder->where(['a.deleted_at' => null]);
        $builder->join('m_proyek b', 'a.proyek_id=b.id', 'left');
        $builder->join('m_perusahaan c', 'b.perusahaan_id=c.id', 'left');
        $builder->join('m_divisi d', 'b.wilayah_id=d.id', 'left');
        $builder->join('m_divisi g', 'b.divisi_id=g.id', 'left');
        $builder->join('m_camp e', 'a.camp_id=e.id', 'left');
        $builder->join('m_ruas f', 'a.ruas_id=f.id', 'left');
        $builder->join('log_data x', 'x.idunik = a.idunik' . $strx, 'left');
        $builder->groupBy('a.id')->orderby('b.kode,a.kode');
        return $builder->get()->getResult();
    }
    public function cekRuas($idunik, $pilih, $kode, $proyek = false, $camp = false, $ruas = false)
    {
        $builder = $this->db->table('m_ruas');
        $builder->where('pilihan', $pilih);
        $builder->where('kode', $kode)->where('idunik !=', $idunik);
        if ($camp == true) $builder->where('camp_id', $camp);
        if ($proyek == true) $builder->where('proyek_id', $proyek);
        if ($ruas == true) $builder->where('ruas_id', $ruas);
        return $builder->get()->getResult();
    }
    public function getAlat($menu, $aktif, $pilih = false, $perusahaan = false, $divisi = false, $penerima = false)
    {
        $builder = $this->db->table('m_alat a');
        $builder->select('a.*, b.kode as perusahaan, c.nama as wilayah, d.nama as divisi, e.nama as kategorialat, f.nama as namarekan, x.id as xlog');
        if ($pilih == true) ($pilih == 'multi') ? $builder->whereIn('a.pilihan', ['pribadi', 'tool']) : $builder->where('a.pilihan', $pilih);
        if ($aktif != '') $builder->where('a.is_jual', 'off')->where('a.is_confirm', '1')->where('a.is_aktif', '1');
        if ($perusahaan == true) $builder->where('a.perusahaan_id', $perusahaan);
        if ($divisi == true) $builder->where('a.divisi_id', $divisi);
        if ($penerima == true) $builder->where('a.penerima_id', $penerima);
        $strx = ($menu != '' ? ' AND x.menu = "' . $menu . '" AND x.created_by = "' . session()->username . '"' : '');
        $builder->where(['a.deleted_at' => null]);
        $builder->join('m_perusahaan b', 'a.perusahaan_id=b.id', 'left');
        $builder->join('m_divisi c', 'a.wilayah_id=c.id', 'left');
        $builder->join('m_divisi d', 'a.divisi_id=d.id', 'left');
        $builder->join('m_divisi e', 'a.kategori_id=e.id', 'left');
        $builder->join('m_penerima f', 'a.penerima_id=f.id', 'left');
        $builder->join('log_data x', 'x.idunik = a.idunik' . $strx, 'left');
        $builder->groupBy('a.id')->orderby('a.kode');
        return $builder->get()->getResult();
    }
    public function loadAlat($isi, $pilih = false, $perusahaan, $wilayah, $divisi)
    {
        $builder = $this->db->table('m_alat a');
        $builder->select('a.*, b.kode as kodekbli, b.nama as namakbli, c.kode as perusahaan, d.nama as wilayah, e.nama as divisi, f.nama as kategori');
        $builder->where("(a.kode like \"%$isi%\" or a.nama like \"%$isi%\" or a.nomor like \"%$isi%\")");
        if ($pilih == true) ($pilih == 'multi') ? $builder->whereIn('a.pilihan', ['pribadi', 'tool']) : $builder->where('a.pilihan', $pilih);
        $builder->where('a.is_confirm', '1')->where('a.is_aktif', '1')->where(['a.deleted_at' => null]);
        $builder->where('b.is_confirm', '1')->where('b.is_aktif', '1')->where('b.deleted_at', null);
        $builder->where('c.is_confirm', '1')->where('c.is_aktif', '1')->where('c.deleted_at', null);
        $builder->where('d.is_confirm', '1')->where('d.is_aktif', '1')->where('d.deleted_at', null);
        $builder->where('e.is_confirm', '1')->where('e.is_aktif', '1')->where('e.deleted_at', null);
        $builder->where('f.is_confirm', '1')->where('f.is_aktif', '1')->where('f.deleted_at', null);
        if ($perusahaan != '') $builder->where('a.perusahaan_id', $perusahaan);
        if ($wilayah != '') $builder->where('a.wilayah_id', $wilayah);
        if ($divisi != '') $builder->where('a.divisi_id', $divisi);
        $builder->join('m_kbli b', 'a.kbli_id=b.id', 'left');
        $builder->join('m_perusahaan c', 'a.perusahaan_id=c.id', 'left');
        $builder->join('m_divisi d', 'a.wilayah_id=d.id', 'left');
        $builder->join('m_divisi e', 'a.divisi_id=e.id', 'left');
        $builder->join('m_divisi f', 'a.kategori_id=f.id', 'left');
        $builder->orderby('a.kode');
        $builder->limit(jllimit);
        return $builder->get()->getResult();
    }
    // public function loadAlatincRekanan($isi, $bentuk, $kategori, $pilih = false)
    // {
    //     $builder = $this->db->table('m_alat a');
    //     $builder->select('a.*,b.kode as perusahaan,c.nama as penerima');
    //     $builder->where("(a.kode like \"%$isi%\" or a.nama like \"%$isi%\" or a.nomor like \"%$isi%\")");
    //     $builder->where('a.bentuk', $bentuk)->where('a.kategori_id', $kategori);
    //     $builder->where('a.is_confirm', '1')->where('a.is_aktif', '1')->where(['a.deleted_at' => null]);
    //     $builder->join('m_perusahaan b', 'a.perusahaan_id=b.id', 'left');
    //     $builder->join('m_penerima c', 'a.penerima_id=c.id', 'left');
    //     $builder->orderby('a.kode');
    //     $builder->limit(jllimit);
    //     return $builder->get()->getResult();
    // }
    public function getTanah($menu, $aktif, $perusahaan = false, $divisi = false)
    {
        $builder = $this->db->table('m_tanah a');
        $builder->select('a.*, b.kode as perusahaan, c.nama as wilayah, d.nama as divisi, x.id as xlog');
        if ($aktif != '') $builder->where('a.is_confirm', '1')->where('a.is_aktif', '1');
        if ($perusahaan == true) $builder->where('a.perusahaan_id', $perusahaan);
        if ($divisi == true) $builder->where('a.divisi_id', $divisi);
        $strx = ($menu != '' ? ' AND x.menu = "' . $menu . '" AND x.created_by = "' . session()->username . '"' : '');
        $builder->where(['a.deleted_at' => null]);
        $builder->join('m_perusahaan b', 'b.id=a.perusahaan_id', 'left');
        $builder->join('m_divisi c', 'c.id=a.wilayah_id', 'left');
        $builder->join('m_divisi d', 'd.id=a.divisi_id', 'left');
        $builder->join('log_data x', 'x.idunik = a.idunik' . $strx, 'left');
        $builder->groupBy('a.id')->orderby('a.kode');
        return $builder->get()->getResult();
    }
    public function loadTanah($isi, $perusahaan, $wilayah, $divisi)
    {
        $builder = $this->db->table('m_tanah a');
        $builder->select('a.*, b.kode as kodekbli, b.nama as namakbli, c.kode as perusahaan, d.nama as wilayah, e.nama as divisi');
        $builder->where("(a.kode like \"%$isi%\" or a.nama like \"%$isi%\")");
        $builder->where('a.is_confirm', '1')->where('a.is_aktif', '1')->where(['a.deleted_at' => null]);
        $builder->where('b.is_confirm', '1')->where('b.is_aktif', '1')->where('b.deleted_at', null);
        $builder->where('c.is_confirm', '1')->where('c.is_aktif', '1')->where('c.deleted_at', null);
        $builder->where('d.is_confirm', '1')->where('d.is_aktif', '1')->where('d.deleted_at', null);
        if ($perusahaan != '') $builder->where('a.perusahaan_id', $perusahaan);
        if ($wilayah != '') $builder->where('a.wilayah_id', $wilayah);
        if ($divisi != '') $builder->where('a.divisi_id', $divisi);
        $builder->join('m_kbli b', 'a.kbli_id=b.id', 'left');
        $builder->join('m_perusahaan c', 'a.perusahaan_id=c.id', 'left');
        $builder->join('m_divisi d', 'a.wilayah_id=d.id', 'left');
        $builder->join('m_divisi e', 'a.divisi_id=e.id', 'left');
        $builder->orderby('a.kode');
        $builder->limit(jllimit);
        return $builder->get()->getResult();
    }
    public function getInventaris($menu, $aktif, $perusahaan = false, $divisi = false)
    {
        $builder = $this->db->table('m_inventaris a');
        $builder->select('a.*, b.kode as perusahaan, c.nama as wilayah, d.nama as divisi, e.nama as pegawai, x.id as xlog');
        if ($aktif != '') $builder->where('a.is_confirm', '1')->where('a.is_aktif', '1');
        if ($perusahaan == true) $builder->where('a.perusahaan_id', $perusahaan);
        if ($divisi == true) $builder->where('a.divisi_id', $divisi);
        $strx = ($menu != '' ? ' AND x.menu = "' . $menu . '" AND x.created_by = "' . session()->username . '"' : '');
        $builder->where(['a.deleted_at' => null]);
        $builder->join('m_perusahaan b', 'b.id = a.perusahaan_id', 'left');
        $builder->join('m_divisi c', 'c.id = a.wilayah_id', 'left');
        $builder->join('m_divisi d', 'd.id = a.divisi_id', 'left');
        $builder->join('m_penerima e', 'e.id = a.pegawai_id', 'left');
        $builder->join('log_data x', 'x.idunik = a.idunik' . $strx, 'left');
        $builder->groupBy('a.id')->orderby('a.kode');
        return $builder->get()->getResult();
    }

    // ____________________________________________________________________________________________________________________________
    public function getAkun($menu, $kategori)
    {
        $builder = $this->db->table('m_akun a');
        $builder->select('a.*, b.nama as namasub, x.id as xlog');
        if ($kategori != '') $builder->where('a.kategori', $kategori);
        $strx = ($menu != '' ? ' AND x.menu = "' . $menu . '" AND x.created_by = "' . session()->username . '"' : '');
        $builder->where(['a.deleted_at' => null]);
        $builder->join('m_akun b', 'a.induk_id = b.id', 'left');
        $builder->join('log_data x', 'x.idunik = a.idunik' . $strx, 'left');
        $builder->groupBy('a.id')->orderby('a.noakun');
        return $builder->get()->getResult();
    }
    public function loadAkun($isi, $awal)
    {
        $builder = $this->db->table('m_akun');
        $builder->like('noakun', $awal, 'after');
        $builder->where("(noakun like \"%$isi%\" or nama like \"%$isi%\")");
        $builder->where('is_confirm', '1')->where('is_aktif', '1')->where('level', '4')->where(['deleted_at' => null]);
        $builder->orderby('noakun');
        $builder->limit(jllimit);
        return $builder->get()->getResult();
    }
    public function cekAkun($noakun, $level = false)
    {
        $builder = $this->db->table('m_akun');
        if ($level == true) {
            $builder->where('noakun', $noakun)->where('level', $level);
            $builder->where('is_confirm', '1')->where('is_aktif', '1')->where(['deleted_at' => null]);
            return $builder->get()->getResult();
        }
        return $builder->where('noakun', $noakun)->get()->getResult();
    }
    public function getDefakun($menu, $menuf, $aktif = false)
    {
        $builder = $this->db->table('def_akun a');
        $builder->select('a.*, b.kode as perusahaan, c.nama as divisi, d.kode as userid, e.noakun as noakun, e.nama as namaakun, x.id as xlog');
        $builder->where('a.menu', $menuf)->where(['a.deleted_at' => null]);
        if ($aktif == true) $builder->where('a.is_confirm', '1')->where('a.is_aktif', '1');
        $strx = ($menu != '' ? ' AND x.menu = "' . $menu . '" AND x.created_by = "' . session()->username . '"' : '');
        $builder->join('m_perusahaan b', 'a.perusahaan_id = b.id', 'left');
        $builder->join('m_divisi c', 'a.divisi_id = c.id', 'left');
        $builder->join('m_user d', 'a.id = d.id', 'left');
        $builder->join('m_akun e', 'a.akun1_id = e.id', 'left');
        $builder->join('log_data x', 'x.idunik = a.idunik' . $strx, 'left');
        $builder->groupBy('a.id')->orderby('submenu')->orderby('kelompok');
        return $builder->get()->getResult();
    }
    public function cekDefakun($kelompok, $nama, $idunik)
    {
        $builder = $this->db->table('def_akun');
        $builder->where('kelompok', $kelompok)->where('nama', $nama);
        $builder->where('idunik !=', $idunik);
        return $builder->get()->getResult();
    }
    public function getKelakun($submenu, $kelompok, $menu = false)
    {
        $builder = $this->db->table('def_akun');
        $builder->where('submenu', $submenu);
        if ($kelompok != '') $builder->where('kelompok', $kelompok);
        if ($menu == true) $builder->where('menu', $menu);
        $builder->where('is_confirm', '1')->where('is_aktif', '1')->where(['deleted_at' => null]);
        $builder->orderby('nama');
        return $builder->get()->getResult();
    }
    public function getKBLI($menu, $pilihan = false)
    {
        $builder = $this->db->table('m_kbli a');
        $builder->select('a.*, b.nama as pajak, x.id as xlog');
        $strx = ($menu != '' ? ' AND x.menu = "' . $menu . '" AND x.created_by = "' . session()->username . '"' : '');
        if ($pilihan == true) $builder->where('a.pilihan', $pilihan);
        $builder->where(['a.deleted_at' => null]);
        $builder->join('def_akun b', 'b.id = a.pajak_id', 'left');
        $builder->join('log_data x', 'x.idunik = a.idunik' . $strx, 'left');
        $builder->groupBy('a.id')->orderby('a.kode');
        return $builder->get()->getResult();
    }
    public function loadKBLI($isi, $pilihan)
    {
        $builder = $this->db->table('m_kbli');
        $builder->where("(kode like \"%$isi%\" or nama like \"%$isi%\")");
        $builder->where('pilihan', $pilihan);
        $builder->where('is_confirm', '1')->where('is_aktif', '1')->where(['deleted_at' => null]);
        $builder->orderby('kode');
        $builder->limit(jllimit);
        return $builder->get()->getResult();
    }
    public function distKBLI($pilihan)
    {
        $builder = $this->db->table('m_kbli a');
        $builder->select('a.*, b.nilai as nilaipajak');
        $builder->where('a.pilihan', $pilihan);
        $builder->where(['a.deleted_at' => null]);
        $builder->join('def_akun b', 'a.pajak_id = b.id');
        $builder->orderBy('a.kode');
        return $builder->get()->getResult();
    }

    // ____________________________________________________________________________________________________________________________
    public function getBarang($menu, $pilihan, $kategori = false, $serial = false)
    {
        $builder = $this->db->table('m_barang a');
        $builder->select('a.*, x.id as xlog');
        $builder->where('a.pilihan', $pilihan);
        if ($kategori == true) $builder->where('kategori', $kategori);
        $strx = ($menu != '' ? ' AND x.menu = "' . $menu . '" AND x.created_by = "' . session()->username . '"' : '');
        $builder->where(['a.deleted_at' => null]);
        $builder->join('log_data x', 'x.idunik = a.idunik' . $strx, 'left');
        $builder->groupBy('a.id')->orderby('a.kategori,a.kode');
        return $builder->get()->getResult();
    }
    public function getSatuan($barang)
    {
        $builder = $this->db->table('m_barang');
        return $builder->where('id', $barang)->get()->getResult();
    }
    public function getSerial($menu, $barang)
    {
        $builder = $this->db->table('m_serial a');
        $builder->select('a.*, b.kode as kodebrg, b.nama as barang, c.kode as kodealat, c.nomor as nomoralat, c.nama as namaalat, x.id as xlog');
        if ($barang != '') $builder->where('a.barang_id', $barang);
        $strx = ($menu != '' ? ' AND x.menu = "' . $menu . '" AND x.created_by = "' . session()->username . '"' : '');
        $builder->where(['a.deleted_at' => null]);
        $builder->join('m_barang b', 'a.barang_id=b.id', 'left');
        $builder->join('m_alat c', 'a.alat_id=c.id', 'left');
        $builder->join('log_data x', 'x.idunik = a.idunik' . $strx, 'left');
        $builder->groupBy('a.id')->orderby('b.kode,a.noseri');
        return $builder->get()->getResult();
    }
    public function loadBarang($isi, $pilihan, $sn)
    {
        $builder = $this->db->table('m_barang');
        $builder->where("(kode like \"%$isi%\" or nama like \"%$isi%\")");
        if ($pilihan != '') $builder->like('pilihan', $pilihan);
        if ($sn == '1') $builder->where('use_serial', '1');
        $builder->where('is_confirm', '1')->where('is_aktif', '1')->where(['deleted_at' => null]);
        $builder->orderby('kode');
        $builder->limit(jllimit);
        return $builder->get()->getResult();
    }
    public function loadAtk($isi)
    {
        $builder = $this->db->table('m_atk');
        $builder->where("(nama like \"%$isi%\")");
        $builder->where(['deleted_at' => null]);
        $builder->orderby('nama');
        $builder->limit(jllimit);
        return $builder->get()->getResult();
    }
    // ____________________________________________________________________________________________________________________________
    public function getPenerima($menu, $pegawai, $aktif = false, $osm = false, $kategori = false,  $perusahaan = false, $divisi = false)
    {
        $builder = $this->db->table('m_penerima a');
        $builder->select('a.*, b.kode as perusahaan, c.nama as wilayah, d.nama as divisi, e.nama as jabatan, f.nama as golongan, x.id as xlog');
        if ($aktif == true) $builder->where('a.is_confirm', '1')->where('a.is_aktif', '1');
        $strx = ($menu != '' ? ' AND x.menu = "' . $menu . '" AND x.created_by = "' . session()->username . '"' : '');
        if ($perusahaan == true) $builder->where('a.perusahaan_id', $perusahaan);
        if ($divisi == true) $builder->where('a.divisi_id', $divisi);
        if ($kategori == true) $builder->where('kategori', $kategori);
        if ($pegawai == '1') $builder->where('a.st_peg', '1');
        $builder->where(['a.deleted_at' => null]);
        $builder->join('m_perusahaan b', 'a.perusahaan_id=b.id', 'left');
        $builder->join('m_divisi c', 'a.wilayah_id=c.id', 'left');
        $builder->join('m_divisi d', 'a.divisi_id=d.id', 'left');
        $builder->join('m_divisi e', 'a.jabatan_id=e.id', 'left');
        $builder->join('m_divisi f', 'a.golongan_id=f.id', 'left');
        $builder->join('log_data x', 'x.idunik = a.idunik' . $strx, 'left');
        $builder->groupBy('a.id')->orderby('a.kategori,a.kode');
        return $builder->get()->getResult();
    }
    public function loadPenerima($isi, $pelanggan, $suplier, $lain, $pegawai, $osm)
    {
        $builder = $this->db->table('m_penerima');
        $builder->where("(kode like \"%$isi%\" or nip like \"%$isi%\" or nama like \"%$isi%\")");
        $builder->where('is_confirm', '1')->where('is_aktif', '1')->where(['deleted_at' => null]);
        if ($osm == '1') $builder->Where('osm', '1');
        $builder->groupStart();
        if ($pelanggan === '1') $builder->orWhere('st_pel', '1');
        if ($suplier === '1') $builder->orWhere('st_sup', '1');
        if ($lain === '1') $builder->orWhere('st_lain', '1');
        if ($pegawai === '1') $builder->orWhere('st_peg', '1');
        $builder->groupEnd();
        $builder->orderby('kode');
        $builder->limit(jllimit);
        return $builder->get()->getResult();
    }
    public function cekUserpegawai($userid, $idunik = false)
    {
        $builder = $this->db->table('m_penerima');
        $builder->where('user_id', $userid);
        if ($idunik == true) $builder->where('idunik !=', $idunik);
        return $builder->get()->getResult();
    }
    public function getBiodata($userid, $atasan = false)
    {
        $builder = $this->db->table('m_penerima a');
        $builder->select('a.*, b.kode as perusahaan, c.nama as wilayah, d.nama as divisi, e.nama as cabang, f.nama as atasan, g.nama as jabatan, h.nama as golongan, j.acc_setuju as level');
        ($atasan == true) ? $builder->where('a.atasan_id', $userid) : $builder->where('a.user_id', $userid);
        $builder->join('m_perusahaan b', 'a.perusahaan_id=b.id', 'left');
        $builder->join('m_divisi c', 'a.wilayah_id=c.id', 'left');
        $builder->join('m_divisi d', 'a.divisi_id=d.id', 'left');
        $builder->join('m_camp e', 'a.cabang_id=e.id', 'left');
        $builder->join('m_penerima f', 'a.atasan_id=f.id', 'left');
        $builder->join('m_divisi g', 'a.jabatan_id=g.id', 'left');
        $builder->join('m_divisi h', 'a.golongan_id=h.id', 'left');
        $builder->join('m_user j', 'a.user_id=j.id', 'left');
        return $builder->get()->getResult();
    }
    public function distPenerima()
    {
        $builder = $this->db->table('m_select');
        $builder->select('nama')->distinct();
        $builder->where('param', 'kelakun')->where('kelompok', 'penerima');
        $builder->orderBy('nomor');
        return $builder->get()->getResult();
    }

    // ____________________________________________________________________________________________________________________________
    public function getTanggal($tanggal)
    {
        $builder = $this->db->table('m_kalender');
        $builder->where('tanggal', $tanggal)->where(['deleted_at' => null]);
        return $builder->get()->getResult();
    }
    public function getKalender($tahun)
    {
        $builder = $this->db->table('m_kalender a');
        $builder->select('a.*, b.kode as user');
        $builder->where(['a.deleted_at' => null]);
        $builder->join('m_user b', 'b.id = a.updated_by', 'left');
        if ($tahun != '') $builder->where('left(a.tanggal, 4)', $tahun);
        $builder->orderby('a.tanggal');
        return $builder->get()->getResult();
    }
}
