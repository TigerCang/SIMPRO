<?php

namespace App\Controllers\file\admin;

use Config\App;
use App\Controllers\BaseController;

class Konfigurasi extends BaseController
{
    // ____________________________________________________________________________________________________________________________
    public function index()
    {
        (!preg_match("/102/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $data = [
            't_menu' => lang("app.tt_konfig"), 't_submenu' => '',
            't_icon' => '<i class="fa fa-gear ' . lang("app.xlist") . '"></i>', 't_diricon' => '<i class="fa fa-user-secret"></i>', 't_dir1' => lang("app.admin"), 't_dirac' => lang("app.config"), 't_link' => '/konfigurasi',
            'tuser' => $this->user, 'tmenu' => $this->menu,
        ];
        return view('file/admin/konfigurasi_view', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function modaldata()
    {
        if ($this->request->isAJAX()) {
            $data = ['konfigurasi' => $this->deklarModel->satuID('m_konfigurasi',  $this->request->getvar('idunik'))];
            $msg = ['data' => view('x-modal/input_konfigurasi', $data)];
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }

    // ____________________________________________________________________________________________________________________________
    public function okdata()
    {
        if ($this->request->isAJAX()) {
            $db1 = $this->deklarModel->satuID('m_konfigurasi', $this->request->getVar('idunik'));
            $rule_level = ($db1[0]->mode == "A" ? 'required' : 'permit_empty');
            $rule_nama = ($db1[0]->mode == "B" ? 'required' : 'permit_empty');
            $nilai = ($db1[0]->mode == "A" ? $this->request->getVar('level') : $this->request->getVar('nama'));

            $validationRules = [
                'level' => [
                    'rules' => $rule_level,
                    'errors' => ['required' => lang("app.errblank")]
                ],
                'nama' => [
                    'rules' => $rule_nama,
                    'errors' => ['required' => lang("app.errblank")]
                ],
            ];
            if (!$this->validate($validationRules)) {
                $msg = [
                    'error' => [
                        'level' => $this->validation->getError('level'),
                        'nama' => $this->validation->getError('nama'),
                    ]
                ];
            } else {
                $path = FCPATH . 'assets/' . $db1[0]->subparam . '/' . $this->request->getVar('nama'); // Path absolut pada sistem file
                if (!is_dir($path)) mkdir($path, 0777, true);
                $this->konfigurasiModel->save(['id' => $db1[0]->id, 'nilai' => $nilai, 'updated_by' => $this->user['id']]);
                $this->logModel->saveLog('Save', $this->request->getVar('idunik'), $this->request->getVar('parameter'));
                $msg = ['sukses' => $this->request->getVar('parameter') . lang("app.judulubah")];
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
            $data = ['konfigurasi' => $this->konfigurasiModel->getKonfigurasi()];
            $msg = ['data' => view('x-file/konfigurasi_tabel', $data)];
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }
}
