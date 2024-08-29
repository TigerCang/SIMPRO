<?php

namespace App\Controllers\file\deklarasi;

use Config\App;
use App\Controllers\BaseController;
use App\Models\file\BiayaModel;

class Biayalangsung extends BaseController
{
    protected $biayaModel;
    public function __construct()
    {
        $this->biayaModel = new BiayaModel();
    }

    // ____________________________________________________________________________________________________________________________
    public function index()
    {
        (!preg_match("/116/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $data = [
            't_menu' => lang("app.tt_biayal"), 't_submenu' => '',
            't_icon' => '<i class="fa fa-file ' . lang("app.xlist") . '"></i>',
            't_diricon' => '<i class="fa fa-map-signs"></i>', 't_dir1' => lang("app.deklar"), 't_dir2' => lang("app.biayaproyek"), 't_dirac' => lang("app.biayal"), 't_link' => '/biayal',
            'kategori' => $this->deklarModel->getDivisi('', 'katproyek', 't'),
            'menu' => 'biayal',
            'btnclascr' => lang('app.btncCreate'), 'btntextcr' => lang('app.btnCreate'),
            'actcreate' => ($this->user['act_create'] == '0' ? 'hidden' : ''),
            'tuser' => $this->user, 'tmenu' => $this->menu,
        ];
        return view('file/deklarasi/biaya_view', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function crany()
    {
        do {
            $idu = buatid();
            $db = $this->deklarModel->satuID('m_biaya', $idu);
        } while ($db);
        $this->iduModel->saveID($idu);
        return redirect()->to('/biayal/input/' . $idu);
    }

    // ____________________________________________________________________________________________________________________________
    public function showdata($idunik)
    {
        (!preg_match("/116/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $db1 = $this->deklarModel->satuID('m_biaya', $idunik, 'y');
        $ticon = ($db1 ? lang("app.xdetil") : lang("app.xinput"));
        $data = [
            't_menu' => lang("app.tt_biayal"), 't_submenu' => '',
            't_icon' => '<i class="fa fa-file ' . $ticon . '"></i>',
            't_diricon' => '<i class="fa fa-map-signs"></i>', 't_dir1' => lang("app.deklar"), 't_dir2' => lang("app.biayaproyek"), 't_dirac' => lang("app.biayal"), 't_link' => '/biayal',
            'idu' => $this->iduModel->cekID($idunik), 'idunik' => $idunik,
            'satuan' => $this->deklarModel->getDivisi('', 'satuan', 't'),
            'katproyek' => $this->deklarModel->getDivisi('', 'katproyek', 't'),
            'akun1' => $this->deklarModel->satuID('m_akun', $db1[0]->akun_id ?? '', '', 'id', 't'),
            'menu' => 'biayal', 'ahid' => 'hidden', 'khid' => '', 'lhid' => '', 'shid' => 'hidden', //akun kate blangsung sumberdaya
            'btnhid' => ($db1 ? 'hidden' : ''),
            'btnclas1' => ($db1 ? lang('app.btncUpdate') : lang('app.btncSave')),
            'btntext1' => ($db1 ? lang('app.btnUpdate') : lang('app.btnSave')),
            'btnclas2' => (($db1 && $db1[0]->is_aktif == '0') ? lang('app.btncAktif') : lang('app.btncNoaktif')),
            'btntext2' => (($db1 && $db1[0]->is_aktif == '0') ? lang('app.btnAktif') : lang('app.btnNoaktif')),
            'btnsama' => ($db1 ? ($db1[0]->is_confirm == '1' ? 'disabled' : ($db1[0]->updated_by == $this->user['id'] ? 'disabled' : '')) : ''),
            'actcreate' => ($db1 ? ($this->user['act_edit'] == '0' ? 'disabled' : '') : ($this->user['act_create'] == '0' ? 'disabled' : '')),
            'actconf' => ($db1 ? ($this->user['act_confirm'] == '0' ? 'disabled hidden' : '') : 'disabled hidden'),
            'actaktif' => ($db1 ? ($this->user['act_aktif'] == '0' ? 'disabled hidden' : '') : 'disabled hidden'),
            'biaya' => $db1,
            'tuser' => $this->user, 'tmenu' => $this->menu,
        ];
        (empty($data['biaya']) && empty($data['idu'])) && throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        if ($db1) $this->logModel->saveLog('Read', $idunik, "{$db1[0]->kode} ; {$db1[0]->nama}", '-');
        return view('file/deklarasi/biaya_input', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function savedata()
    {
        if ($this->request->isAJAX()) {
            $db1 = $this->deklarModel->satuID('m_biaya', $this->request->getVar('idunik'));
            $savj = ($db1 ? lang("app.judulubah") : lang("app.judulsimpan"));
            $kode = $this->request->getVar('kode');
            $stconf = (($db1 && $db1[0]->is_confirm != '0') ? '2' : '0');
            $level = (substr($kode, 2) == '000000' ? "1" : (substr($kode, 4) == '0000' ? "2" : "3"));
            if ($level != "1") {
                $levelInduk = ($level == "2" ? "1" : "2");
                $biayaInduk = ($level == "2" ? substr($kode, 0, 2) . "000000" : substr($kode, 0, 4) . "0000");
            }
            $rule_lev3 = ($level == "3" ? 'required' : 'permit_empty');
            $satuan = ($level == "3" ? $this->request->getVar('satuan') : '');
            $cekKode = $this->deklarModel->cekBiaya($this->request->getVar('kode'), $this->request->getVar('katproyek'), $this->request->getVar('idunik'));
            $rule_kode = ($cekKode ? 'required|is_unique[m_biaya.kode]' : 'required|min_length[8]');
            $indukID = "0";
            if (strlen($this->request->getVar('kode')) == "8" && $level != "1") {
                $cekInduk = $this->deklarModel->cekIndukbiaya('blangsung', strtoupper($biayaInduk), $levelInduk, $this->request->getVar('katproyek'));
                ($cekInduk ? $indukID = $cekInduk[0]->id : $rule_kode = 'valid_email');
            }

            $validationRules = [
                'kode' => [
                    'rules' => $rule_kode,
                    'errors' => ['required' => lang("app.errblank"), 'min_length' => lang("app.errlength", [8]), 'is_unique' => lang("app.errunik"), 'valid_email' => lang("app.errunik")]
                ],
                'nama' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errblank")]
                ],
                'katproyek' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errpilih")]
                ],
                'satuan' => [
                    'rules' => $rule_lev3,
                    'errors' => ['required' => lang("app.errpilih")]
                ],
            ];
            if (!$this->validate($validationRules)) {
                $msg = [
                    'error' => [
                        'kode' => $this->validation->getError('kode'),
                        'nama' => $this->validation->getError('nama'),
                        'katproyek' => $this->validation->getError('katproyek'),
                        'satuan' => $this->validation->getError('satuan'),
                    ]
                ];
            } else {
                //Simpan
                if ($this->request->getVar('postaction') == 'save') {
                    $this->biayaModel->save([
                        'id' => $db1[0]->id ?? '',
                        'idunik' => $this->request->getVar('idunik'),
                        'pilihan' => 'blangsung',
                        'induk_id' => $indukID,
                        'tipe_id' => $this->request->getVar('katproyek'),
                        'kode' => strtoupper($this->request->getVar('kode')),
                        'matabayar' => $this->request->getVar('matabayar'),
                        'nama' => $this->request->getVar('nama'),
                        'satuan' => $satuan,
                        'level' => $level,
                        'is_confirm' => $stconf,
                        'updated_by' => $this->user['id'],
                        'confirmed_by' => '0',
                    ]);
                    $db1 = $this->deklarModel->satuID('m_biaya', $this->request->getVar('idunik'));
                    $this->logModel->saveLog('Save', $this->request->getVar('idunik'), "{$db1[0]->kode} ; {$db1[0]->nama}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->kode} ; {$db1[0]->nama} {$savj}", 'tipe' => $db1[0]->tipe_id]);
                }
                //Konfirmasi
                if ($this->request->getVar('postaction') == 'confirm') {
                    $this->biayaModel->save(['id' => $db1[0]->id, 'is_confirm' => '1', 'confirmed_by' => $this->user['id']]);
                    $this->logModel->saveLog('Confirm', $this->request->getVar('idunik'), "{$db1[0]->kode} ; {$db1[0]->nama}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->kode} ; {$db1[0]->nama}" . lang("app.judulkonf"), 'tipe' => $db1[0]->tipe_id]);
                }
                //Aktifasi
                if ($this->request->getVar('postaction') == 'aktif') {
                    $akby = (($this->request->getVar('niaktif') == '0') ? $this->user['id'] : '0');
                    $savj = (($this->request->getVar('niaktif') == '0') ? lang("app.judulnoaktif") : lang("app.judulaktif"));
                    $onoff = (($this->request->getVar('niaktif') == '0') ? 'nonaktif' : 'aktif');
                    $this->biayaModel->save(['id' => $db1[0]->id, 'is_aktif' => $this->request->getVar('niaktif'), 'activated_by' => $akby]);
                    $this->logModel->saveLog('Active', $this->request->getVar('idunik'), "{$db1[0]->kode} ; {$db1[0]->nama} {$onoff}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->kode} ; {$db1[0]->nama} {$savj}", 'tipe' => $db1[0]->tipe_id]);
                }
                $msg = ['redirect' => '/biayal'];
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
            $kate = ($this->request->getVar('kategori') != 'all' ? substr($this->request->getVar('kategori'), '0', '2') : '');
            $data = [
                'biaya' => $this->deklarModel->getBiaya($this->urls[1], 'blangsung', $kate),
                'menu' => 'biayal', 'lts' => '100',
            ];
            $msg = ['data' => view('x-file/biaya_tabel', $data)];
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }
}
