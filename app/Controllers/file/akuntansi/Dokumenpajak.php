<?php

namespace App\Controllers\file\akuntansi;

use Config\App;
use App\Controllers\BaseController;
use App\Models\file\KBLIModel;

class Dokumenpajak extends BaseController
{
    protected $kbliModel;
    public function __construct()
    {
        $this->kbliModel = new KBLIModel();
    }

    // ____________________________________________________________________________________________________________________________
    public function index()
    {
        (!preg_match("/134/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $data = [
            't_menu' => lang("app.tt_dokpajak"), 't_submenu' => '',
            't_icon' => '<i class="fa fa-balance-scale ' . lang("app.xlist") . '"></i>',
            't_diricon' => '<i class="fa fa-balance-scale"></i>', 't_dir1' => lang("app.akuntansi"), 't_dirac' => lang("app.dokumenpajak"), 't_link' => '/dokumenpajak',
            'selnama' => $this->deklarModel->distSelect('kbli'),
            'baku' => $this->deklarModel->getKBLI($this->urls[1], 'dokumenpajak'),
            'btnclascr' => lang('app.btncCreate'), 'btntextcr' => lang('app.btnCreate'),
            'actcreate' => ($this->user['act_create'] == '0' ? 'hidden' : ''),
            'tuser' => $this->user, 'tmenu' => $this->menu,
        ];
        return view('file/akuntansi/dokumenpajak_view', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function crany()
    {
        do {
            $idu = buatid();
            $db = $this->deklarModel->satuID('m_kbli', $idu);
        } while ($db);
        $this->iduModel->saveID($idu);
        return redirect()->to('/dokumenpajak/input/' . $idu);
    }

    // ____________________________________________________________________________________________________________________________
    public function showdata($idunik)
    {
        (!preg_match("/134/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $db1 = $this->deklarModel->satuID('m_kbli', $idunik, 'y');
        $ticon = ($db1 ? lang("app.xdetil") : lang("app.xinput"));
        $data = [
            't_menu' => lang("app.tt_dokpajak"), 't_submenu' => '',
            't_icon' => '<i class="fa fa-balance-scale ' . $ticon . '"></i>',
            't_diricon' => '<i class="fa fa-balance-scale"></i>', 't_dir1' => lang("app.akuntansi"), 't_dirac' => lang("app.dokumenpajak"), 't_link' => '/dokumenpajak',
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
            'pajak' => $this->deklarModel->getDefakun('', 'pajak', 't'),
            'selnama' => $this->deklarModel->distSelect('kbli'),
            'baku' => $db1,
            'tuser' => $this->user, 'tmenu' => $this->menu,
        ];
        (empty($data['baku']) && empty($data['idu'])) && throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        if ($db1) $this->logModel->saveLog('Read', $idunik, "{$db1[0]->kode} ; {$db1[0]->nama}", '-');
        return view('file/akuntansi/dokumenpajak_input', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function savedata()
    {
        if ($this->request->isAJAX()) {
            $db1 = $this->deklarModel->satuID('m_kbli', $this->request->getVar('idunik'));
            $savj = ($db1 ? lang("app.judulubah") : lang("app.judulsimpan"));
            $rule_kode = ($db1 ? ($db1[0]->kode != $this->request->getVar('kode') ? 'required|is_unique[m_kbli.kode]|min_length[5]' : 'required|min_length[5]') : 'required|is_unique[m_kbli.kode]|min_length[5]');
            $rule_kode2 = ($db1 ? ($db1[0]->kode != $this->request->getVar('kode2') ? 'required|is_unique[m_kbli.kode]|min_length[9]' : 'required|min_length[9]') : 'required|is_unique[m_kbli.kode]|min_length[9]');
            $rule_pajak2 = 'required';
            $stconf = (($db1 && $db1[0]->is_confirm != '0') ? '2' : '0');
            if ($this->request->getVar('xpilih') != 'kbli') $rule_kode = 'permit_empty';
            if ($this->request->getVar('xpilih') != 'objekpajak') $rule_kode2 = 'permit_empty';
            if ($this->request->getVar('xpilih') != 'objekpajak') $rule_pajak2 = 'permit_empty';

            $validationRules = [
                'xpilih' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errpilih")]
                ],
                'kode' => [
                    'rules' => $rule_kode,
                    'errors' => ['required' => lang("app.errblank"), 'is_unique' => lang("app.errunik"), 'min_length' => lang("app.errlength", [5])]
                ],
                'kode2' => [
                    'rules' => $rule_kode2,
                    'errors' => ['required' => lang("app.errblank"), 'is_unique' => lang("app.errunik"), 'min_length' => lang("app.errlength", [9])]
                ],
                'nama' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errblank")]
                ],
                'pajak' => [
                    'rules' => $rule_pajak2,
                    'errors' => ['required' => lang("app.errpilih")]
                ],
            ];
            if (!$this->validate($validationRules)) {
                $msg = [
                    'error' => [
                        'xpilih' => $this->validation->getError('xpilih'),
                        'kode' => $this->validation->getError('kode'),
                        'kode2' => $this->validation->getError('kode2'),
                        'nama' => $this->validation->getError('nama'),
                        'pajak' => $this->validation->getError('pajak'),
                    ]
                ];
            } else {
                //Simpan
                $kode = ($this->request->getVar('xpilih') == 'kbli' ? $this->request->getVar('kode') : ($this->request->getVar('xpilih') == 'objekpajak' ? $this->request->getVar('kode2') : ''));
                $pajak = ($this->request->getVar('xpilih') == 'objekpajak' ? $this->request->getVar('pajak') : '');
                if ($this->request->getVar('postaction') == 'save') {
                    $this->kbliModel->save([
                        'id' => $db1[0]->id ?? '',
                        'idunik' => $this->request->getVar('idunik'),
                        'pilihan' => $this->request->getVar('xpilih'),
                        'kode' => $kode,
                        'nama' => $this->request->getVar('nama'),
                        'pajak_id' => $pajak,
                        'is_confirm' => $stconf,
                        'updated_by' => $this->user['id'],
                        'confirmed_by' => '0',
                    ]);
                    $db1 = $this->deklarModel->satuID('m_kbli', $this->request->getVar('idunik'));
                    $this->logModel->saveLog('Save', $this->request->getVar('idunik'), "{$db1[0]->kode} ; {$db1[0]->nama}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->nama} {$savj}", 'pilihan' => $db1[0]->pilihan]);
                }
                //Konfirmasi
                if ($this->request->getVar('postaction') == 'confirm') {
                    $this->kbliModel->save(['id' => $db1[0]->id, 'is_confirm' => '1', 'confirmed_by' => $this->user['id']]);
                    $this->logModel->saveLog('Confirm', $this->request->getVar('idunik'), "{$db1[0]->kode} ; {$db1[0]->nama}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->nama}" . lang("app.judulkonf"), 'pilihan' => $db1[0]->pilihan]);
                }
                //Aktifasi
                if ($this->request->getVar('postaction') == 'aktif') {
                    $akby = (($this->request->getVar('niaktif') == '0') ? $this->user['id'] : '0');
                    $savj = (($this->request->getVar('niaktif') == '0') ? lang("app.judulnoaktif") : lang("app.judulaktif"));
                    $onoff = (($this->request->getVar('niaktif') == '0') ? 'nonaktif' : 'aktif');
                    $this->kbliModel->save(['id' => $db1[0]->id, 'is_aktif' => $this->request->getVar('niaktif'), 'activated_by' => $akby]);
                    $this->logModel->saveLog('Active', $this->request->getVar('idunik'), "{$db1[0]->kode} ; {$db1[0]->nama} {$onoff}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->nama} {$savj}", 'pilihan' => $db1[0]->pilihan]);
                }
                $msg = ['redirect' => '/dokumenpajak'];
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
            $pilihan = ($this->request->getVar('pilihan') != 'all' ? $this->request->getVar('pilihan') : '');
            $data = ['baku' => $this->deklarModel->getKbli($this->urls[1], $pilihan)];
            $msg = ['data' => view('x-file/dokumenpajak_tabel', $data)];
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }
}
