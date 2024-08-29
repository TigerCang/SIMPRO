<?php

namespace App\Controllers\file\sdm;

use Config\App;
use App\Controllers\BaseController;
use App\Models\file\PenerimaModel;

class Pegawai extends BaseController
{
    protected $penerimaModel;
    public function __construct()
    {
        $this->penerimaModel = new PenerimaModel();
    }

    // ____________________________________________________________________________________________________________________________
    public function index()
    {
        (!preg_match("/150/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $data = [
            't_menu' => lang("app.tt_pegawai"), 't_submenu' => '',
            't_icon' => '<i class="icofont icofont-business-man ' . lang("app.xlist") . '"></i>',
            't_diricon' => '<i class="icofont icofont-support"></i>', 't_dir1' => lang("app.sdm"), 't_dirac' => lang("app.pegawai"), 't_link' => '/pegawai',
            'perusahaan' => $this->deklarModel->getPerusahaan('', 't'),
            'divisi' => $this->deklarModel->getDivisi('', 'divisi', 't'),
            'btnclascr' => lang('app.btncCreate'), 'btntextcr' => lang('app.btnCreate'),
            'actcreate' => ($this->user['act_create'] == '0' ? 'hidden' : ''),
            'tuser' => $this->user, 'tmenu' => $this->menu,
        ];
        return view('file/sdm/pegawai_view', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function crany()
    {
        do {
            $idu = buatid();
            $db = $this->deklarModel->satuID('m_penerima', $idu);
        } while ($db);
        $this->iduModel->saveID($idu);
        return redirect()->to('/pegawai/input/' . $idu);
    }

    // ____________________________________________________________________________________________________________________________
    public function showdata($idunik)
    {
        (!preg_match("/150/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $db1 = $this->deklarModel->satuID('m_penerima', $idunik, 'y');
        $ticon = ($db1 ? lang("app.xdetil") : lang("app.xinput"));
        $data = [
            't_menu' => lang("app.tt_pegawai"), 't_submenu' => '',
            't_icon' => '<i class="icofont icofont-business-man ' . $ticon . '"></i>',
            't_diricon' => '<i class="icofont icofont-support"></i>', 't_dir1' => lang("app.sdm"), 't_dirac' => lang("app.pegawai"), 't_link' => '/pegawai',
            'idu' => $this->iduModel->cekID($idunik), 'idunik' => $idunik,
            'perusahaan' => $this->deklarModel->getPerusahaan('', 't'),
            'wilayah' => $this->deklarModel->getDivisi('', 'wilayah', 't'),
            'divisi' => $this->deklarModel->getDivisi('', 'divisi', 't'),
            'kelakun' => $this->deklarModel->getKelakun('penerima', 'pegawai'),
            'golongan' => $this->deklarModel->getDivisi('', 'golongan', 't'),
            'jabatan' => $this->deklarModel->getDivisi('', 'jabatan', 't'),
            'jurusan' => $this->deklarModel->distItem('m_penerima', 'jurusan'),
            'camp1' => $this->deklarModel->satuID('m_camp', $db1[0]->cabang_id ?? '', '', 'id', 't'),
            'pegawai1' => $this->deklarModel->satuID('m_penerima', $db1[0]->atasan_id ?? '', '', 'id', 't'),
            'user1' => $this->deklarModel->get1User($db1[0]->user_id ?? '', 't'),
            'selgd' => $this->deklarModel->distSelect('goldarah'),
            'selkelsim' => $this->deklarModel->distSelect('sim', 't'),
            'selsim' => $this->deklarModel->distSelect('sim'),
            'selijasah' => $this->deklarModel->distSelect('ijasah'),
            'selstatijasah' => $this->deklarModel->distSelect('statijasah'),
            'selstatpegawai' => $this->deklarModel->distSelect('statpegawai'),
            'selmodkeluar' => $this->deklarModel->distSelect('modkeluar'),
            'selkelptkp' => $this->deklarModel->distSelect('ptkp', 't'),
            'selptkp' => $this->deklarModel->distSelect('ptkp'),
            'btnhid' => ($db1 ? 'hidden' : ''), 'btnlam' => ($db1 ? '' : 'hidden'),
            'btnclas1' => ($db1 ? lang('app.btncUpdate') : lang('app.btncSave')),
            'btntext1' => ($db1 ? lang('app.btnUpdate') : lang('app.btnSave')),
            'btnclas2' => (($db1 && $db1[0]->is_aktif == '0') ? lang('app.btncAktif') : lang('app.btncNoaktif')),
            'btntext2' => (($db1 && $db1[0]->is_aktif == '0') ? lang('app.btnAktif') : lang('app.btnNoaktif')),
            'btnsama' => ($db1 ? ($db1[0]->is_confirm == '1' ? 'disabled' : ($db1[0]->updated_by == $this->user['id'] ? 'disabled' : '')) : ''),
            'actcreate' => ($db1 ? ($this->user['act_edit'] == '0' ? 'disabled' : '') : ($this->user['act_create'] == '0' ? 'disabled' : '')),
            'actconf' => ($db1 ? ($this->user['act_confirm'] == '0' ? 'disabled hidden' : '') : 'disabled hidden'),
            'actaktif' => ($db1 ? ($this->user['act_aktif'] == '0' ? 'disabled hidden' : '') : 'disabled hidden'),
            'pegawai' => $db1,
            'tuser' => $this->user, 'tmenu' => $this->menu,
        ];
        (empty($data['pegawai']) && empty($data['idu'])) && throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        if ($data['pegawai']) {
            if ($this->user['act_perusahaan'] == "0" && !preg_match("/," . $data['pegawai'][0]->perusahaan_id . ",/i", $this->user['perusahaan'])) throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
            if ($this->user['act_wilayah'] == "0" && !preg_match("/," . $data['pegawai'][0]->wilayah_id . ",/i", $this->user['wilayah'])) throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
            if ($this->user['act_divisi'] == "0" && !preg_match("/," . $data['pegawai'][0]->divisi_id . ",/i", $this->user['divisi'])) throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        }
        if ($db1) $this->logModel->saveLog('Read', $idunik, "{$db1[0]->kode} ; {$db1[0]->nama}", '-');
        return view('file/sdm/pegawai_input', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function savedata()
    {
        if ($this->request->isAJAX()) {
            $db1 = $this->deklarModel->satuID('m_penerima', $this->request->getVar('idunik'));
            $savj = ($db1 ? lang("app.judulubah") : lang("app.judulsimpan"));
            $rule_kode = ($db1 ? ($db1[0]->kode != $this->request->getVar('kode') ? 'required|is_unique[m_penerima.kode]|min_length[16]' : 'required|min_length[16]') : 'required|is_unique[m_penerima.kode]|min_length[16]');
            $rule_nip = ($db1 ? ($db1[0]->nip != $this->request->getVar('nip') ? 'required|is_unique[m_penerima.kui]|min_length[10]' : 'required|min_length[10]') : 'required|is_unique[m_penerima.nip]|min_length[10]');
            $rule_user = 'permit_empty';
            $stconf = (($db1 && $db1[0]->is_confirm != '0') ? '2' : '0');

            if ($this->request->getVar('userid') != "") {
                $cekUserpegawai = $this->deklarModel->cekUserpegawai($this->request->getVar('userid'), $this->request->getVar('idunik'));
                $rule_user = ($cekUserpegawai ? 'is_unique[m_penerima.user_id]' : 'permit_empty');
                if ($rule_user == 'permit_empty') {
                    $dbuser = $this->deklarModel->satuID('m_user', $this->request->getVar('userid'), '', 'id');
                    if ($dbuser[0]->act_perusahaan == "0" && !preg_match("/," . $this->request->getVar('idperusahaan') . ",/i", $dbuser[0]->perusahaan)) $rule_user = 'valid_email';
                    if ($dbuser[0]->act_wilayah == "0" && !preg_match("/," . $this->request->getVar('idwilayah') . ",/i", $dbuser[0]->wilayah)) $rule_user = 'valid_email';
                    if ($dbuser[0]->act_divisi == "0" && !preg_match("/," . $this->request->getVar('iddivisi') . ",/i", $dbuser[0]->divisi)) $rule_user = 'valid_email';
                }
            }
            $cekcamp = $this->deklarModel->satuID('m_camp', $this->request->getVar('idcamp'), '', 'id', 't');
            $rule_perusahaan = ($cekcamp ? ($this->request->getVar('idperusahaan') == $cekcamp[0]->perusahaan_id ? 'required' : 'valid_email') : 'required');
            $rule_wilayah = ($cekcamp ? ($this->request->getVar('idwilayah') == $cekcamp[0]->wilayah_id ? 'required' : 'valid_email') : 'required');
            $rule_divisi = ($cekcamp ? ($this->request->getVar('iddivisi') == $cekcamp[0]->divisi_id ? 'required' : 'valid_email') : 'required');

            $validationRules = [
                'kode' => [
                    'rules' => $rule_kode,
                    'errors' => ['required' => lang("app.errblank"), 'is_unique' => lang("app.errunik"), 'min_length' => lang("app.errlength", [16])]
                ],
                'nama' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errblank")]
                ],
                'nip' => [
                    'rules' => $rule_nip,
                    'errors' => ['required' => lang("app.errblank"), 'is_unique' => lang("app.errunik"), 'min_length' => lang("app.errlength", [10])]
                ],
                'idperusahaan' => [
                    'rules' => $rule_perusahaan,
                    'errors' => ['required' => lang("app.errpilih"), 'valid_email' => lang("app.errunik")]
                ],
                'idwilayah' => [
                    'rules' => $rule_wilayah,
                    'errors' => ['required' => lang("app.errpilih"), 'valid_email' => lang("app.errunik")]
                ],
                'iddivisi' => [
                    'rules' => $rule_divisi,
                    'errors' => ['required' => lang("app.errpilih"), 'valid_email' => lang("app.errunik")]
                ],
                'kodecamp' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errblank")]
                ],
                'kelakun' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errpilih")]
                ],
                'golongan' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errpilih")]
                ],
                'idjabatan' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errpilih")]
                ],
                'gambar' => [
                    'rules' => 'max_size[gambar,1024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/bmp,image/png]',
                    'errors' => ['max_size' => lang("app.errfilebesar"), 'is_image' => lang("app.errnotimg"), 'mime_in' => lang("app.errfileext")]
                ],
                'userid' => [
                    'rules' => $rule_user,
                    'errors' => ['is_unique' => lang("app.errunik"), 'valid_email' => lang("app.errunik")]
                ],
                'catatan' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errblank")]
                ],
            ];
            if (!$this->validate($validationRules)) {
                $msg = [
                    'error' => [
                        'kode' => $this->validation->getError('kode'),
                        'nama' => $this->validation->getError('nama'),
                        'nip' => $this->validation->getError('nip'),
                        'perusahaan' => $this->validation->getError('idperusahaan'),
                        'wilayah' => $this->validation->getError('idwilayah'),
                        'divisi' => $this->validation->getError('iddivisi'),
                        'kodecamp' => $this->validation->getError('kodecamp'),
                        'kelakun' => $this->validation->getError('kelakun'),
                        'golongan' => $this->validation->getError('golongan'),
                        'jabatan' => $this->validation->getError('idjabatan'),
                        'gambar' => $this->validation->getError('gambar'),
                        'userid' => $this->validation->getError('userid'),
                        'catatan' => $this->validation->getError('catatan'),
                    ]
                ];
            } else {
                //Simpan
                if ($this->request->getVar('postaction') == 'save') {
                    $file_gambar = $this->request->getFile('gambar');
                    $nama_gambar = ($file_gambar->getError() == 4) ? $this->request->getVar('gambarlama') : $file_gambar->getName();
                    if ($file_gambar->getError() != 4) $file_gambar->move('assets/fileimg/pegawai', $nama_gambar);
                    if ($this->request->getVar('gambarlama') != 'default.png' && $file_gambar->getError() != 4) unlink('assets/fileimg/pegawai' . $this->request->getVar('gambarlama'));
                    $this->penerimaModel->save([
                        'id' => $db1[0]->id ?? '',
                        'idunik' => $this->request->getVar('idunik'),
                        'kode' => strtoupper($this->request->getVar('kode')),
                        'nip' => $this->request->getVar('nip'),
                        'nama' => $this->request->getVar('nama'),
                        'perusahaan_id' => $this->request->getVar('idperusahaan'),
                        'wilayah_id' => $this->request->getVar('idwilayah'),
                        'divisi_id' => $this->request->getVar('iddivisi'),
                        'cabang_id' => $this->request->getVar('idcamp'),
                        'lokasi' => $this->request->getVar('lokasi'),
                        'kategori' => 'Pegawai',
                        'jenkel' => $this->request->getVar('jk'),
                        'goldarah' => $this->request->getVar('goldarah'),
                        't4lahir' => $this->request->getVar('t4lahir'),
                        'tgl_lahir' => $this->request->getVar('tgllahir'),
                        'alamat' => $this->request->getVar('alamat'),
                        'user_id' => $this->request->getVar('userid'),
                        'kontak' => $this->request->getVar('kontak'),
                        'email' => $this->request->getVar('surel'),
                        'golongan_id' => $this->request->getVar('golongan'),
                        'jabatan_id' => $this->request->getVar('idjabatan'),
                        'atasan_id' => $this->request->getVar('atasan'),
                        'ijasah' => $this->request->getVar('ijazah'),
                        'jurusan' => $this->request->getVar('jurusan'),
                        'tgl_ijasah' => $this->request->getVar('tglijazah'),
                        'st_ijasah' => $this->request->getVar('statusijazah'),
                        'asuransi' => $this->request->getVar('asuransi'),
                        'nosim' => $this->request->getVar('nosim'),
                        'jns_sim' => $this->request->getVar('jsim'),
                        'tgl_sim' => $this->request->getVar('tglsim'),
                        'st_ptkp' => $this->request->getVar('statusptkp'),
                        'tgl_join' => $this->request->getVar('tgljoin'),
                        'st_pegawai' => $this->request->getVar('statuspeg'),
                        'tgl_kontrakawal' => $this->request->getVar('tglawal'),
                        'tgl_kontrakakhir' => $this->request->getVar('tglakhir'),
                        'mode_keluar' => $this->request->getVar('modkeluar'),
                        'tgl_keluar' => $this->request->getVar('tglkeluar'),
                        'alasan_keluar' => $this->request->getVar('alasan'),
                        'st_peg' => '1',
                        'kakun_peg' => $this->request->getVar('kelakun'),
                        'osm' => ($this->request->getVar('osm') == 'on' ? '1' : '0'),
                        'catatan' => $this->request->getVar('catatan'),
                        'gambar' => $nama_gambar,
                        'is_confirm' => $stconf,
                        'updated_by' => $this->user['id'],
                        'confirmed_by' => '0',
                    ]);
                    $db1 = $this->deklarModel->satuID('m_penerima', $this->request->getVar('idunik'));
                    $this->logModel->saveLog('Save', $this->request->getVar('idunik'), "{$db1[0]->kode} ; {$db1[0]->nama}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->kode} ; {$db1[0]->nama} {$savj}", 'perush' => $db1[0]->perusahaan_id, 'div' => $db1[0]->divisi_id]);
                }
                //Konfirmasi
                if ($this->request->getVar('postaction') == 'confirm') {
                    $this->penerimaModel->save(['id' => $db1[0]->id, 'is_confirm' => '1', 'confirmed_by' => $this->user['id']]);
                    $this->logModel->saveLog('Confirm', $this->request->getVar('idunik'), "{$db1[0]->kode} ; {$db1[0]->nama}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->kode} ; {$db1[0]->nama}" . lang("app.judulkonf"), 'perush' => $db1[0]->perusahaan_id, 'div' => $db1[0]->divisi_id]);
                }
                //Aktifasi
                if ($this->request->getVar('postaction') == 'aktif') {
                    $akby = (($this->request->getVar('niaktif') == '0') ? $this->user['id'] : '0');
                    $savj = (($this->request->getVar('niaktif') == '0') ? lang("app.judulnoaktif") : lang("app.judulaktif"));
                    $onoff = (($this->request->getVar('niaktif') == '0') ? 'nonaktif' : 'aktif');
                    $this->penerimaModel->save(['id' => $db1[0]->id, 'is_aktif' => $this->request->getVar('niaktif'), 'activated_by' => $akby]);
                    $this->logModel->saveLog('Active', $this->request->getVar('idunik'), "{$db1[0]->kode} ; {$db1[0]->nama} {$onoff}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->kode} ; {$db1[0]->nama} {$savj}", 'perush' => $db1[0]->perusahaan_id, 'div' => $db1[0]->divisi_id]);
                }
                $msg = ['redirect' => '/pegawai'];
            }
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }

    // ____________________________________________________________________________________________________________________________
    public function tabeldata()
    {
        if ($this->request->isAJAX()) {
            $perush = ($this->request->getVar('perusahaan') != 'all' ? $this->request->getVar('perusahaan') : '');
            $div = ($this->request->getVar('divisi') != 'all' ? $this->request->getVar('divisi') : '');
            $data = ['pegawai' => $this->deklarModel->getPenerima($this->urls[1], '1', '', '', '', $perush, $div)];
            $msg = ['data' => view('x-file/pegawai_tabel', $data)];
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }
}
