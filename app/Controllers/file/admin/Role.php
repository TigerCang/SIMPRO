<?php

namespace App\Controllers\file\admin;

use Config\App;
use App\Controllers\BaseController;

class Role extends BaseController
{
    // ____________________________________________________________________________________________________________________________
    public function index()
    {
        (!preg_match("/103/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $data = [
            't_menu' => lang("app.tt_role"), 't_submenu' => '',
            't_icon' => '<i class="icofont icofont-ui-user-group ' . lang("app.xlist") . '"></i>',
            't_diricon' => '<i class="fa fa-user-secret"></i>', 't_dir1' => lang("app.admin"), 't_dirac' => lang("app.role"), 't_link' => '/role',
            'role' => $this->deklarModel->getRole($this->urls[1]),
            'btnclascr' => lang('app.btncCreate'), 'btntextcr' => lang('app.btnCreate'),
            'actcreate' => ($this->user['act_create'] == '0' ? 'hidden' : ''),
            'tuser' => $this->user, 'tmenu' => $this->menu,
        ];
        return view('file/admin/role_view', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function crany()
    {
        do {
            $idu = buatid();
            $db = $this->deklarModel->satuID('m_role', $idu);
        } while ($db);
        $this->iduModel->saveID($idu);
        return redirect()->to('/role/input/' . $idu);
    }

    // ____________________________________________________________________________________________________________________________
    public function showdata($idunik)
    {
        (!preg_match("/103/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $db1 = $this->deklarModel->satuID('m_role', $idunik, 'y');
        $ticon = ($db1 ? lang("app.xdetil") : lang("app.xinput"));
        $data = [
            't_menu' => lang("app.tt_role"), 't_submenu' => '',
            't_icon' => '<i class="icofont icofont-ui-user-group ' . $ticon . '"></i>',
            't_diricon' => '<i class="fa fa-user-secret"></i>', 't_dir1' => lang("app.admin"), 't_dirac' => lang("app.role"), 't_link' => '/role',
            'idu' => $this->iduModel->cekID($idunik), 'idunik' => $idunik,
            'btnhid' => ($db1 ? 'hidden' : ''),
            'btnclas1' => ($db1 ? lang('app.btncUpdate') : lang('app.btncSave')),
            'btntext1' => ($db1 ? lang('app.btnUpdate') : lang('app.btnSave')),
            'btnclas2' => (($db1 && $db1[0]->is_aktif == '0') ? lang('app.btncAktif') : lang('app.btncNoaktif')),
            'btntext2' => (($db1 && $db1[0]->is_aktif == '0') ? lang('app.btnAktif') : lang('app.btnNoaktif')),
            'btnsama' => ($db1 ? ($db1[0]->is_confirm == '1' ? 'disabled' : ($db1[0]->updated_by == $this->user['id'] ? 'disabled' : '')) : ''),
            'actcreate' => ($db1 ? ($this->user['act_edit'] == '0' ? 'disabled' : '') : ($this->user['act_create'] == '0' ? 'disabled' : '')),
            'actconf' => ($db1 ? ($this->user['act_confirm'] == '0' ? 'disabled hidden' : '') : 'disabled hidden'),
            'actaktif' => ($db1 ? ($this->user['act_aktif'] == '0' ? 'disabled hidden' : '') : 'disabled hidden'),
            'role' => $db1,
            'tuser' => $this->user, 'tmenu' => $this->menu,
        ];
        (empty($data['role']) && empty($data['idu'])) && throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        if ($db1) $this->logModel->saveLog('Read', $idunik, $db1[0]->nama, '-');
        return view('file/admin/role_input', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function savedata()
    {
        if ($this->request->isAJAX()) {
            $db1 = $this->deklarModel->satuID('m_role', $this->request->getVar('idunik'));
            $savj = ($db1 ? lang("app.judulubah") : lang("app.judulsimpan"));
            $nama = $this->deklarModel->cekRole($this->request->getVar('nama'), $this->request->getVar('idunik'));
            $rule_nama = ($nama ? 'required|is_unique[m_role.nama]' : 'required');

            $validationRules = [
                'nama' => [
                    'rules' => $rule_nama,
                    'errors' => ['required' => lang("app.errblank"), 'is_unique' => lang("app.errunik")]
                ]
            ];
            if (!$this->validate($validationRules)) {
                $msg = ['error' => ['nama' => $this->validation->getError('nama')]];
            } else {
                //Simpan
                if ($this->request->getVar('postaction') == 'save') {
                    $this->roleModel->save([
                        'id' => $db1[0]->id ?? '',
                        'idunik' => $this->request->getVar('idunik'),
                        'nama' => $this->request->getVar('nama'),
                        'menu_1' => $this->request->getVar('menu1'),
                        'is_confirm' => '0',
                        'updated_by' => $this->user['id'],
                        'confirmed_by' => '0',
                    ]);
                    $db1 = $this->deklarModel->satuID('m_role', $this->request->getVar('idunik'));
                    $this->logModel->saveLog('Save', $this->request->getVar('idunik'), $db1[0]->nama);
                    $this->session->setFlashdata(['judul' => "{$db1[0]->nama} {$savj}"]);
                }
                //Konfirmasi
                if ($this->request->getVar('postaction') == 'confirm') {
                    $this->roleModel->save(['id' => $db1[0]->id, 'is_confirm' => '1', 'confirmed_by' => $this->user['id']]);
                    $this->logModel->saveLog('Confirm', $this->request->getVar('idunik'), $db1[0]->nama);
                    $this->session->setFlashdata(['judul' => "{$db1[0]->nama}" . lang("app.judulkonf")]);
                }
                //Aktifasi
                if ($this->request->getVar('postaction') == 'aktif') {
                    $akby = (($this->request->getVar('niaktif') == '0') ? $this->user['id'] : '0');
                    $savj = (($this->request->getVar('niaktif') == '0') ? lang("app.judulnoaktif") : lang("app.judulaktif"));
                    $onoff = (($this->request->getVar('niaktif') == '0') ? 'nonaktif' : 'aktif');
                    $this->roleModel->save(['id' => $db1[0]->id, 'is_aktif' => $this->request->getVar('niaktif'), 'activated_by' => $akby]);
                    $this->logModel->saveLog('Active', $this->request->getVar('idunik'), "{$db1[0]->nama} {$onoff}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->nama} {$savj}"]);
                }
                $msg = ['redirect' => '/role'];
            }
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }
}
