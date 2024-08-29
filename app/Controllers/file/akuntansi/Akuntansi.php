<?php

namespace App\Controllers\file\akuntansi;

use Config\App;
use App\Controllers\BaseController;
use App\Models\file\AkunModel;

class Akuntansi extends BaseController
{
    protected $akunModel;
    public function __construct()
    {
        $this->akunModel = new AkunModel();
    }

    // ____________________________________________________________________________________________________________________________
    public function index()
    {
        (!preg_match("/129/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $data = [
            't_menu' => lang("app.tt_coa"), 't_submenu' => '',
            't_icon' => '<i class="fa fa-balance-scale ' . lang("app.xlist") . '"></i>',
            't_diricon' => '<i class="fa fa-balance-scale"></i>', 't_dir1' => lang("app.akuntansi"), 't_dirac' => lang("app.coa"), 't_link' => '/akuntansi',
            'selnama' => $this->deklarModel->distSelect('katakun'),
            'btnclascr' => lang('app.btncCreate'), 'btntextcr' => lang('app.btnCreate'),
            'actcreate' => ($this->user['act_create'] == '0' ? 'hidden' : ''),
            'tuser' => $this->user, 'tmenu' => $this->menu,
        ];
        return view('file/akuntansi/akun_view', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function crany()
    {
        do {
            $idu = buatid();
            $db = $this->deklarModel->satuID('m_akun', $idu);
        } while ($db);
        $this->iduModel->saveID($idu);
        return redirect()->to('/akuntansi/input/' . $idu);
    }

    // ____________________________________________________________________________________________________________________________
    public function showdata($idunik)
    {
        (!preg_match("/129/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $db1 = $this->deklarModel->satuID('m_akun', $idunik, 'y');
        $ticon = ($db1 ? lang("app.xdetil") : lang("app.xinput"));
        $data = [
            't_menu' => lang("app.tt_coa"), 't_submenu' => '',
            't_icon' => '<i class="fa fa-balance-scale ' . $ticon . '"></i>',
            't_diricon' => '<i class="fa fa-balance-scale"></i>', 't_dir1' => lang("app.akuntansi"), 't_dirac' => lang("app.coa"), 't_link' => '/akuntansi',
            'idu' => $this->iduModel->cekID($idunik), 'idunik' => $idunik,
            'selnama' => $this->deklarModel->distSelect('katakun'),
            'btnhid' => ($db1 ? 'hidden' : ''),
            'btnclas1' => ($db1 ? lang('app.btncUpdate') : lang('app.btncSave')),
            'btntext1' => ($db1 ? lang('app.btnUpdate') : lang('app.btnSave')),
            'btnclas2' => (($db1 && $db1[0]->is_aktif == '0') ? lang('app.btncAktif') : lang('app.btncNoaktif')),
            'btntext2' => (($db1 && $db1[0]->is_aktif == '0') ? lang('app.btnAktif') : lang('app.btnNoaktif')),
            'btnsama' => ($db1 ? ($db1[0]->is_confirm == '1' ? 'disabled' : ($db1[0]->updated_by == $this->user['id'] ? 'disabled' : '')) : ''),
            'actcreate' => ($db1 ? ($this->user['act_edit'] == '0' ? 'disabled' : '') : ($this->user['act_create'] == '0' ? 'disabled' : '')),
            'actconf' => ($db1 ? ($this->user['act_confirm'] == '0' ? 'disabled hidden' : '') : 'disabled hidden'),
            'actaktif' => ($db1 ? ($this->user['act_aktif'] == '0' ? 'disabled hidden' : '') : 'disabled hidden'),
            'akun' => $db1,
            'tuser' => $this->user, 'tmenu' => $this->menu,
        ];
        (empty($data['akun']) && empty($data['idu'])) && throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        if ($db1) $this->logModel->saveLog('Read', $idunik, "{$db1[0]->noakun} {$db1[0]->nama}", '-');
        return view('file/akuntansi/akun_input', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function savedata()
    {
        if ($this->request->isAJAX()) {
            $db1 = $this->deklarModel->satuID('m_akun', $this->request->getVar('idunik'));
            $savj = ($db1 ? lang("app.judulubah") : lang("app.judulsimpan"));
            $noakun = substr($this->request->getVar('xkategori'), 0, 1) . $this->request->getVar('kode'); //noakun = kategori + code
            $cekAkun = $this->deklarModel->cekAkun($noakun);
            $rule_kode = ($noakun != $this->request->getVar('noakun') ? ($cekAkun ? 'required|is_unique[m_akun.kode]' : 'required|min_length[7]|greater_than_equal_to[100]') : 'required|greater_than_equal_to[100]');
            $stconf = (($db1 && $db1[0]->is_confirm != '0') ? '2' : '0');
            if (substr($this->request->getVar('kode'), 1) == '00.000') {
                $level = "1";
                $akunInduk = '';
            } elseif (substr($this->request->getVar('kode'), 2) == '0.000') {
                $level = "2";
                $levelInduk = "1";
                $akunInduk = substr($noakun, 0, 2) . "00.000";
            } elseif (substr($this->request->getVar('kode'), 3) == '.000') {
                $level = "3";
                $levelInduk = "2";
                $akunInduk = substr($noakun, 0, 3) . "0.000";
            } else {
                $level = "4";
                $levelInduk = "3";
                $akunInduk = substr($noakun, 0, 4) . ".000";
            }
            if (strlen($this->request->getVar('kode')) == "7") {
                if ($level != "1") {
                    $cekInduk = $this->deklarModel->cekAkun($akunInduk, $levelInduk);
                    ($cekInduk ? $indukid = $cekInduk[0]->id : $rule_kode = 'valid_email');
                } else {
                    $indukid = "0";
                }
            }

            $validationRules = [
                'kode' => [
                    'rules' => $rule_kode,
                    'errors' => ['required' => lang("app.errblank"), 'min_length' => lang("app.errlength", [7]), 'greater_than_equal_to' => lang("app.err100"), 'is_unique' => lang("app.errunik"), 'valid_email' => lang("app.errunik")]
                ],
                'nama' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errblank")]
                ],
                'xkategori' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errpilih")]
                ],
            ];
            if (!$this->validate($validationRules)) {
                $msg = [
                    'error' => [
                        'kode' => $this->validation->getError('kode'),
                        'nama' => $this->validation->getError('nama'),
                        'kategori' => $this->validation->getError('xkategori'),
                    ]
                ];
            } else {
                //Simpan
                if ($this->request->getVar('postaction') == 'save') {
                    $this->akunModel->save([
                        'id' => $db1[0]->id ?? '',
                        'idunik' => $this->request->getVar('idunik'),
                        'kode' => $this->request->getVar('kode'),
                        'noakun' => $noakun,
                        'nama' => $this->request->getVar('nama'),
                        'level' => $level,
                        'kategori' => $this->request->getVar('xkategori'),
                        'induk_id' => $indukid,
                        'posisi' => ($this->request->getVar('posisi') == 'on' ? '1' : '0'),
                        'is_confirm' => $stconf,
                        'updated_by' => $this->user['id'],
                        'confirmed_by' => '0',
                    ]);
                    $db1 = $this->deklarModel->satuID('m_akun', $this->request->getVar('idunik'));
                    $this->logModel->saveLog('Save', $this->request->getVar('idunik'), "{$db1[0]->noakun} ; {$db1[0]->nama}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->noakun} ; {$db1[0]->nama} {$savj}", 'kate' => $db1[0]->kategori]);
                }
                //Konfirmasi
                if ($this->request->getVar('postaction') == 'confirm') {
                    $this->akunModel->save(['id' => $db1[0]->id, 'is_confirm' => '1', 'confirmed_by' => $this->user['id']]);
                    $this->logModel->saveLog('Confirm', $this->request->getVar('idunik'), "{$db1[0]->noakun} ; {$db1[0]->nama}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->noakun} ; {$db1[0]->nama}" . lang("app.judulkonf"), 'kate' => $db1[0]->kategori]);
                }
                //Aktifasi
                if ($this->request->getVar('postaction') == 'aktif') {
                    $akby = (($this->request->getVar('niaktif') == '0') ? $this->user['id'] : '0');
                    $savj = (($this->request->getVar('niaktif') == '0') ? lang("app.judulnoaktif") : lang("app.judulaktif"));
                    $onoff = (($this->request->getVar('niaktif') == '0') ? 'nonaktif' : 'aktif');
                    $this->akunModel->save(['id' => $db1[0]->id, 'is_aktif' => $this->request->getVar('niaktif'), 'activated_by' => $akby]);
                    $this->logModel->saveLog('Active', $this->request->getVar('idunik'), "{$db1[0]->noakun} ; {$db1[0]->nama} {$onoff}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->noakun} ; {$db1[0]->nama} {$savj}"]);
                }
                $msg = ['redirect' => '/akuntansi'];
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
            $kate = ($this->request->getVar('kategori') != 'all' ? $this->request->getVar('kategori') : '');
            $data = ['akun' => $this->deklarModel->getAkun($this->urls[1], $kate)];
            $msg = ['data' => view('x-file/akun_tabel', $data)];
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }
}
