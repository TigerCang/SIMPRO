<?php

namespace App\Controllers;

use Config\App;
use App\Controllers\BaseController;
use App\Models\admin\SesiModel;

class Login extends BaseController
{
    protected $sesiModel;
    public function __construct()
    {
        $this->sesiModel = new SesiModel();
    }

    // ____________________________________________________________________________________________________________________________
    public function index()
    {
        // $data = ['validation' => \config\Services::validation()];
        return view('login/login_input');
    }
    public function auth()
    {
        $db = $this->userModel->getUser($this->request->getVar('username'));
        if ($db && password_verify($this->request->getVar('password'), $db['password'])) {
            $dbpeg = $this->deklarModel->satuID('m_penerima', $db['id'], '', 'user_id', 't');
            $session_data = [
                'username' => $this->request->getVar('username'),
                'waktu' => date("d/m/Y g:i a"),
                'avatar' => (empty($dbpeg)) ? 'default.png' : $dbpeg['0']->gambar,
                'ipaddress' => get_ip(),
                'log_in' => TRUE
            ];
            $this->session->set($session_data);
            $this->sesiModel->saveSesi();
            $this->logModel->saveLog('Login', '', $this->request->getVar('username'));
            return redirect()->to('/');
        }
        $this->session->setFlashdata('pesanlogin', lang("app.salahlogin"));
        return redirect()->to('/login');
    }
    public function logout()
    {
        if (!is_null(session()->username)) {
            $this->logModel->saveLog('Logout', '', session()->username);
            session()->destroy();
        }
        return redirect()->to('/login');
    }

    // ____________________________________________________________________________________________________________________________
    public function recover()
    {
        return view('login/recover_input');
    }
    public function reset()
    {
        $db = $this->userModel->getUser($this->request->getVar('username'));
        if ($db) {
            $db1 = $this->deklarModel->cekUserpegawai($db['id']);
            if ($db1) {
                if ($db1['0']->kode == $this->request->getVar('kode')) {
                    $this->userModel->save(['id' => $db['id'], 'iz_pass' => '1']);
                    $this->session->setflashdata('pesanlogin', lang("app.mintaresetsukses"));
                    return redirect()->to('/recover');
                }
            }
        }
        $this->session->setflashdata('pesanlogin', lang("app.datatakcocok"));
        return redirect()->to('/recover');
    }

    // ____________________________________________________________________________________________________________________________
    public function newuser()
    {
        return view('login/newuser_input');
    }
    public function createuser()
    {
        $usernama = $this->request->getVar('usernama');
        $nama = $this->request->getVar('nama');
        if (strlen($usernama) <= 3 || $nama == '' || $this->deklarModel->satuID('m_user', $usernama, '', 'kode')) {
            $this->session->setflashdata('pesanlogin', lang("app.salahuser"));
            return redirect()->to('/newuser');
        }
        $this->userModel->save([
            'idunik' => buatid(),
            'kode' => $usernama,
            'peminta' => $nama,
            'password' => password_hash("A1b2c3d4#", PASSWORD_DEFAULT),
        ]);
        $this->session->setflashdata('pesanlogin', lang("app.buatusersukses"));
        return redirect()->to('/newuser');
    }
}
