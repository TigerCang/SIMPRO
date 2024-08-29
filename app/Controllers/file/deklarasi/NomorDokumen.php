<?php

namespace App\Controllers\file\deklarasi;

use Config\App;
use App\Controllers\BaseController;
use App\Models\file\DivisiModel;

class NomorDokumen extends BaseController
{
    protected $divisiModel;
    public function __construct()
    {
        $this->divisiModel = new DivisiModel();
    }

    // ____________________________________________________________________________________________________________________________
    public function index()
    {
        (!preg_match("/112/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $data = [
            't_menu' => lang("app.tt_nodokumen"), 't_submenu' => '',
            't_icon' => '<i class="fa fa-braille ' . lang("app.xlist") . '"></i>',
            't_diricon' => '<i class="fa fa-map-signs"></i>', 't_dir1' => lang("app.deklar"), 't_dirac' => lang("app.nodokumen"), 't_link' => '/nodokumen',
            'iso' => $this->deklarModel->getDokumen($this->urls[1]),
            'btnclascr' => lang('app.btncCreate'), 'btntextcr' => lang('app.btnCreate'),
            'actcreate' => ($this->user['act_create'] == '0' ? 'hidden' : ''),
            'tuser' => $this->user, 'tmenu' => $this->menu,
        ];
        return view('file/deklarasi/nodokumen_view', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function crany()
    {
        do {
            $idu = buatid();
            $db = $this->deklarModel->satuID('m_divisi', $idu);
        } while ($db);
        $this->iduModel->saveID($idu);
        return redirect()->to('/nodokumen/input/' . $idu);
    }

    // ____________________________________________________________________________________________________________________________
    public function showdata($idunik)
    {
        (!preg_match("/112/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $db1 = $this->deklarModel->satuID('m_divisi', $idunik, 'y');
        $ticon = ($db1 ? lang("app.xdetil") : lang("app.xinput"));
        $data = [
            't_menu' => lang("app.tt_nodokumen"), 't_submenu' => '',
            't_icon' => '<i class="fa fa-braille ' . $ticon . '"></i>',
            't_diricon' => '<i class="fa fa-map-signs"></i>', 't_dir1' => lang("app.deklar"), 't_dirac' => lang("app.nodokumen"), 't_link' => '/nodokumen',
            'idu' => $this->iduModel->cekID($idunik), 'idunik' => $idunik,
            'selkel' => $this->deklarModel->distSelect('formulir', 't'),
            'selnama' => $this->deklarModel->distSelect('formulir'),
            'btnhid' => ($db1 ? 'hidden' : ''),
            'btnclas1' => ($db1 ? lang('app.btncUpdate') : lang('app.btncSave')),
            'btntext1' => ($db1 ? lang('app.btnUpdate') : lang('app.btnSave')),
            'btnclas2' => (($db1 && $db1[0]->is_aktif == '0') ? lang('app.btncAktif') : lang('app.btncNoaktif')),
            'btntext2' => (($db1 && $db1[0]->is_aktif == '0') ? lang('app.btnAktif') : lang('app.btnNoaktif')),
            'btnsama' => ($db1 ? ($db1[0]->is_confirm == '1' ? 'disabled' : ($db1[0]->updated_by == $this->user['id'] ? 'disabled' : '')) : ''),
            'actcreate' => ($db1 ? ($this->user['act_edit'] == '0' ? 'disabled' : '') : ($this->user['act_create'] == '0' ? 'disabled' : '')),
            'actconf' => ($db1 ? ($this->user['act_confirm'] == '0' ? 'disabled hidden' : '') : 'disabled hidden'),
            'actaktif' => ($db1 ? ($this->user['act_aktif'] == '0' ? 'disabled hidden' : '') : 'disabled hidden'),
            'iso' => $db1,
            'tuser' => $this->user, 'tmenu' => $this->menu,
        ];
        (empty($data['iso']) && empty($data['idu'])) && throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        if ($db1) $this->logModel->saveLog('Read', $idunik, $db1[0]->nama, '-');
        return view('file/deklarasi/nodokumen_input', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function savedata()
    {
        if ($this->request->isAJAX()) {
            $db1 = $this->deklarModel->satuID('m_divisi', $this->request->getVar('idunik'));
            $savj = ($db1 ? lang("app.judulubah") : lang("app.judulsimpan"));
            $cekForm = $this->deklarModel->cekForm($this->request->getVar('pilihan'), $this->request->getVar('formulir'), $this->request->getVar('idunik'));
            $rule_form = ($cekForm ? 'required|is_unique[m_divisi.param]' : 'required');
            $stconf = (($db1 && $db1[0]->is_confirm != '0') ? '2' : '0');

            $validationRules = [
                'formulir' => [
                    'rules' => $rule_form,
                    'errors' => ['required' => lang("app.errpilih"), 'is_unique' => lang("app.errunik")]
                ],
                'nodokumen' => [
                    'rules' => 'required|min_length[3]',
                    'errors' => ['required' => lang("app.errblank"), 'min_length' => lang("app.errlength", [3]), 'is_unique' => lang("app.errunik")]
                ]
            ];
            if (!$this->validate($validationRules)) {
                $msg = [
                    'error' => [
                        'formulir' => $this->validation->getError('formulir'),
                        'nodokumen' => $this->validation->getError('nodokumen'),
                    ]
                ];
            } else {
                //Simpan
                if ($this->request->getVar('postaction') == 'save') {
                    $this->divisiModel->save([
                        'id' => $db1[0]->id ?? '',
                        'idunik' => $this->request->getVar('idunik'),
                        'pilihan' => $this->request->getVar('pilihan'),
                        'param' => $this->request->getVar('formulir'),
                        'nama' => strtoupper($this->request->getVar('nodokumen')),
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
                $msg = ['redirect' => '/nodokumen'];
            }
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }
}
