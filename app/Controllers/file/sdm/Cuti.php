<?php

namespace App\Controllers\file\sdm;

use Config\App;
use App\Controllers\BaseController;
use App\Models\file\DivisiModel;

class Cuti extends BaseController
{
    protected $divisiModel;
    public function __construct()
    {
        $this->divisiModel = new DivisiModel();
    }

    // ____________________________________________________________________________________________________________________________
    public function index()
    {
        (!preg_match("/146/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $data = [
            't_menu' => lang("app.tt_cuti"), 't_submenu' => '',
            't_icon' => '<i class="fa fa-file ' . lang("app.xlist") . '"></i>',
            't_diricon' => '<i class="icofont icofont-support"></i>', 't_dir1' => lang("app.sdm"), 't_dirac' => lang("app.cuti"), 't_link' => '/cuti',
            'menu' => 'cuti', 'khid' => '',
            'divisi' => $this->deklarModel->getDivisi($this->urls[1], 'cuti'),
            'btnclascr' => lang('app.btncCreate'), 'btntextcr' => lang('app.btnCreate'),
            'actcreate' => ($this->user['act_create'] == '0' ? 'hidden' : ''),
            'tuser' => $this->user, 'tmenu' => $this->menu,
        ];
        return view('file/deklarasi/satuan_view', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function crany()
    {
        do {
            $idu = buatid();
            $db = $this->deklarModel->satuID('m_divisi', $idu);
        } while ($db);
        $this->iduModel->saveID($idu);
        return redirect()->to('/cuti/input/' . $idu);
    }

    // ____________________________________________________________________________________________________________________________
    public function showdata($idunik)
    {
        (!preg_match("/146/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $db1 = $this->deklarModel->satuID('m_divisi', $idunik, 'y');
        $ticon = ($db1 ? lang("app.xdetil") : lang("app.xinput"));
        $data = [
            't_menu' => lang("app.tt_cuti"), 't_submenu' => '',
            't_icon' => '<i class="fa fa-file ' . $ticon . '"></i>',
            't_diricon' => '<i class="icofont icofont-support"></i>', 't_dir1' => lang("app.sdm"), 't_dirac' => lang("app.cuti"), 't_link' => '/cuti',
            'idu' => $this->iduModel->cekID($idunik), 'idunik' => $idunik,
            'menu' => 'cuti', 'khid' => '',
            'btnhid' => ($db1 ? 'hidden' : ''),
            'btnclas1' => ($db1 ? lang('app.btncUpdate') : lang('app.btncSave')),
            'btntext1' => ($db1 ? lang('app.btnUpdate') : lang('app.btnSave')),
            'btnclas2' => (($db1 && $db1[0]->is_aktif == '0') ? lang('app.btncAktif') : lang('app.btncNoaktif')),
            'btntext2' => (($db1 && $db1[0]->is_aktif == '0') ? lang('app.btnAktif') : lang('app.btnNoaktif')),
            'btnsama' => ($db1 ? ($db1[0]->is_confirm == '1' ? 'disabled' : ($db1[0]->updated_by == $this->user['id'] ? 'disabled' : '')) : ''),
            'actcreate' => ($db1 ? ($this->user['act_edit'] == '0' ? 'disabled' : '') : ($this->user['act_create'] == '0' ? 'disabled' : '')),
            'actconf' => ($db1 ? ($this->user['act_confirm'] == '0' ? 'disabled hidden' : '') : 'disabled hidden'),
            'actaktif' => ($db1 ? ($this->user['act_aktif'] == '0' ? 'disabled hidden' : '') : 'disabled hidden'),
            'divisi' => $db1,
            'tuser' => $this->user, 'tmenu' => $this->menu,
        ];
        (empty($data['divisi']) && empty($data['idu'])) && throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        if ($db1) $this->logModel->saveLog('Read', $idunik, $db1[0]->nama, '-');
        return view('file/deklarasi/satuan_input', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function savedata()
    {
        if ($this->request->isAJAX()) {
            $db1 = $this->deklarModel->satuID('m_divisi', $this->request->getVar('idunik'));
            $savj = ($db1 ? lang("app.judulubah") : lang("app.judulsimpan"));
            $nama = $this->deklarModel->cekDivisi('cuti', $this->request->getVar('nama'), $this->request->getVar('idunik'));
            $rule_nama = ($nama ? 'required|is_unique[m_divisi.nama]' : 'required');
            $kode = $this->deklarModel->cekKodeDivisi('cuti', $this->request->getVar('kode'), $this->request->getVar('idunik'));
            $rule_kode = ($kode ? 'required|is_unique[m_divisi.kode]' : 'required');
            $stconf = (($db1 && $db1[0]->is_confirm != '0') ? '2' : '0');

            $validationRules = [
                'kode' => [
                    'rules' => $rule_kode,
                    'errors' => ['required' => lang("app.errblank"), 'is_unique' => lang("app.errunik")]
                ],
                'nama' => [
                    'rules' => $rule_nama,
                    'errors' => ['required' => lang("app.errblank"), 'is_unique' => lang("app.errunik")]
                ],
            ];
            if (!$this->validate($validationRules)) {
                $msg = [
                    'error' => [
                        'kode' => $this->validation->getError('kode'),
                        'nama' => $this->validation->getError('nama'),
                    ]
                ];
            } else {
                //Simpan
                if ($this->request->getVar('postaction') == 'save') {
                    $this->divisiModel->save([
                        'id' => $db1[0]->id ?? '',
                        'idunik' => $this->request->getVar('idunik'),
                        'pilihan' => $this->request->getVar('param'),
                        'kode' => strtoupper($this->request->getVar('kode')),
                        'nama' => $this->request->getVar('nama'),
                        'nilai' => $this->request->getVar('nilai'),
                        'setdef' => ($this->request->getVar('potcuti') == 'on' ? '1' : '0'),
                        'is_confirm' => $stconf,
                        'updated_by' => $this->user['id'],
                        'confirmed_by' => '0',
                    ]);
                    $db1 = $this->deklarModel->satuID('m_divisi', $this->request->getVar('idunik'));
                    $this->logModel->saveLog('Save', $this->request->getVar('idunik'), $db1[0]->nama);
                    $this->session->setFlashdata(['judul' => "{$db1[0]->nama} {$savj}"]);
                }
                //Konfirmasi
                if ($this->request->getVar('postaction') == 'confirm') {
                    $this->divisiModel->save(['id' => $db1[0]->id, 'is_confirm' => '1', 'confirmed_by' => $this->user['id']]);
                    $this->logModel->saveLog('Confirm', $this->request->getVar('idunik'), $db1[0]->nama);
                    $this->session->setFlashdata(['judul' => "{$db1[0]->nama}" . lang("app.judulkonf")]);
                }
                //Aktifasi
                if ($this->request->getVar('postaction') == 'aktif') {
                    $akby = (($this->request->getVar('niaktif') == '0') ? $this->user['id'] : '0');
                    $savj = (($this->request->getVar('niaktif') == '0') ? lang("app.judulnoaktif") : lang("app.judulaktif"));
                    $onoff = (($this->request->getVar('niaktif') == '0') ? 'nonaktif' : 'aktif');
                    $this->divisiModel->save(['id' => $db1[0]->id, 'is_aktif' => $this->request->getVar('niaktif'), 'activated_by' => $akby]);
                    $this->logModel->saveLog('Active', $this->request->getVar('idunik'), "{$db1[0]->nama} {$onoff}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->nama} {$savj}"]);
                }
                $msg = ['redirect' => '/cuti'];
            }
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }
}
