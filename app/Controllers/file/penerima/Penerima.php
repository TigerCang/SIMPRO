<?php

namespace App\Controllers\file\penerima;

use Config\App;
use App\Controllers\BaseController;
use App\Models\file\PenerimaModel;

class Penerima extends BaseController
{
    protected $penerimaModel;
    public function __construct()
    {
        $this->penerimaModel = new PenerimaModel();
    }

    // ____________________________________________________________________________________________________________________________
    public function index()
    {
        (!preg_match("/141/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $data = [
            't_menu' => lang("app.tt_penerima"), 't_submenu' => '',
            't_icon' => '<i class="icofont icofont-people ' . lang("app.xlist") . '"></i>',
            't_diricon' => '<i class="icofont icofont-people"></i>', 't_dir1' => lang("app.penerima"), 't_dirac' => lang("app.penerima"), 't_link' => '/penerima',
            'kelompok' => $this->deklarModel->distPenerima(),
            'kategori' => $this->deklarModel->distItem('m_penerima', 'kategori'),
            'btnclascr' => lang('app.btncCreate'), 'btntextcr' => lang('app.btnCreate'),
            'actcreate' => ($this->user['act_create'] == '0' ? 'hidden' : ''),
            'tuser' => $this->user, 'tmenu' => $this->menu,
        ];
        return view('file/penerima/penerima_view', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function crany()
    {
        do {
            $idu = buatid();
            $db = $this->deklarModel->satuID('m_penerima', $idu);
        } while ($db);
        $this->iduModel->saveID($idu);
        return redirect()->to('/penerima/input/' . $idu);
    }

    // ____________________________________________________________________________________________________________________________
    public function showdata($idunik)
    {
        (!preg_match("/141/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $db1 = $this->deklarModel->satuID('m_penerima', $idunik, 'y');
        $ticon = ($db1 ? lang("app.xdetil") : lang("app.xinput"));
        $data = [
            't_menu' => lang("app.tt_penerima"), 't_submenu' => '',
            't_icon' => '<i class="icofont icofont-people ' . $ticon . '"></i>',
            't_diricon' => '<i class="icofont icofont-people"></i>', 't_dir1' => lang("app.penerima"), 't_dirac' => lang("app.penerima"), 't_link' => '/penerima',
            'idu' => $this->iduModel->cekID($idunik), 'idunik' => $idunik,
            'kelakun1' => $this->deklarModel->getKelAkun('penerima', 'pelanggan'),
            'kelakun2' => $this->deklarModel->getKelAkun('penerima', 'suplier'),
            'kelakun3' => $this->deklarModel->getKelAkun('penerima', 'subkon'),
            'kelakun4' => $this->deklarModel->getKelAkun('penerima', 'pegawai'),
            'kategori' => $this->deklarModel->distItem('m_penerima', 'kategori'),
            'btnhid' => ($db1 ? 'hidden' : ''),
            'btnclas1' => ($db1 ? lang('app.btncUpdate') : lang('app.btncSave')),
            'btntext1' => ($db1 ? lang('app.btnUpdate') : lang('app.btnSave')),
            'btnclas2' => (($db1 && $db1[0]->is_aktif == '0') ? lang('app.btncAktif') : lang('app.btncNoaktif')),
            'btntext2' => (($db1 && $db1[0]->is_aktif == '0') ? lang('app.btnAktif') : lang('app.btnNoaktif')),
            'btnsama' => ($db1 ? ($db1[0]->is_confirm == '1' ? 'disabled' : ($db1[0]->updated_by == $this->user['id'] ? 'disabled' : '')) : ''),
            'actcreate' => ($db1 ? ($this->user['act_edit'] == '0' ? 'disabled' : '') : ($this->user['act_create'] == '0' ? 'disabled' : '')),
            'actconf' => ($db1 ? ($this->user['act_confirm'] == '0' ? 'disabled hidden' : '') : 'hidden'),
            'actaktif' => ($db1 ? ($this->user['act_aktif'] == '0' ? 'disabled hidden' : '') : 'hidden'),
            'btnhid' => ($db1 ? 'hidden' : ''), 'btnlam' => ($db1 ? '' : 'hidden'),
            'btnclas1' => ($db1 ? lang('app.btncUpdate') : lang('app.btncSave')),
            'btntext1' => ($db1 ? lang('app.btnUpdate') : lang('app.btnSave')),
            'btnclas2' => (($db1 && $db1[0]->is_aktif == '0') ? lang('app.btncAktif') : lang('app.btncNoaktif')),
            'btntext2' => (($db1 && $db1[0]->is_aktif == '0') ? lang('app.btnAktif') : lang('app.btnNoaktif')),
            'btnsama' => ($db1 ? ($db1[0]->is_confirm == '1' ? 'disabled' : ($db1[0]->updated_by == $this->user['id'] ? 'disabled' : '')) : ''),
            'actcreate' => ($db1 ? ($this->user['act_edit'] == '0' ? 'disabled' : '') : ($this->user['act_create'] == '0' ? 'disabled' : '')),
            'actconf' => ($db1 ? ($this->user['act_confirm'] == '0' ? 'disabled hidden' : '') : 'disabled hidden'),
            'actaktif' => ($db1 ? ($this->user['act_aktif'] == '0' ? 'disabled hidden' : '') : 'disabled hidden'),
            'penerima' => $db1,
            'tuser' => $this->user, 'tmenu' => $this->menu,
        ];
        (empty($data['penerima']) && empty($data['idu'])) && throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        if ($db1) $this->logModel->saveLog('Read', $idunik, "{$db1[0]->kode} ; {$db1[0]->nama}", '-');
        return view('file/penerima/penerima_input', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function savedata()
    {
        if ($this->request->isAJAX()) {
            $db1 = $this->deklarModel->satuID('m_penerima', $this->request->getVar('idunik'));
            $savj = ($db1 ? lang("app.judulubah") : lang("app.judulsimpan"));
            $rule_kode = ($db1 ? ($db1[0]->kode != strtoupper($this->request->getVar('kode')) ? 'required|is_unique[m_penerima.kode]|min_length[16]' : 'required|min_length[16]') : 'required|is_unique[m_penerima.kode]|min_length[16]');
            $rule_kel1 = ($this->request->getVar('pelanggan') == 'on' ? 'required' : 'permit_empty');
            $rule_kel2 = ($this->request->getVar('suplier') == 'on' ? 'required' : 'permit_empty');
            $rule_kel3 = ($this->request->getVar('subkon') == 'on' ? 'required' : 'permit_empty');
            $stconf = (($db1 && $db1[0]->is_confirm != '0') ? '2' : '0');
            // $staktif = ($db1 ? ($db1[0]->st_peg == '1' ? $db1[0]->is_aktif : $this->request->getVar('status')) : 'on');

            $validationRules = [
                'kode' => [
                    'rules' => $rule_kode,
                    'errors' => ['required' => lang("app.errblank"), 'is_unique' => lang("app.errunik"), 'min_length' => lang("app.errlength", [16])]
                ],
                'nama' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errblank")]
                ],
                'kategori' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errpilih")]
                ],
                'kelakun1' => [
                    'rules' => $rule_kel1,
                    'errors' => ['required' => lang("app.errpilih")]
                ],
                'kelakun2' => [
                    'rules' => $rule_kel2,
                    'errors' => ['required' => lang("app.errpilih")]
                ],
                'kelakun3' => [
                    'rules' => $rule_kel3,
                    'errors' => ['required' => lang("app.errpilih")]
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
                        'kategori' => $this->validation->getError('kategori'),
                        'kelakun1' => $this->validation->getError('kelakun1'),
                        'kelakun2' => $this->validation->getError('kelakun2'),
                        'kelakun3' => $this->validation->getError('kelakun3'),
                        'catatan' => $this->validation->getError('catatan'),
                    ]
                ];
            } else {
                //Simpan
                if ($this->request->getVar('postaction') == 'save') {
                    $this->penerimaModel->save([
                        'id' => $db1[0]->id ?? '',
                        'idunik' => $this->request->getVar('idunik'),
                        'kode' => strtoupper($this->request->getVar('kode')),
                        'nama' => $this->request->getVar('nama'),
                        'alamat' => $this->request->getVar('alamat'),
                        'kontak' => $this->request->getVar('kontak'),
                        'kategori' => $this->request->getVar('kategori'),
                        'rating' => $this->request->getVar('nilairating'),
                        'st_pel' => ($this->request->getVar('pelanggan') == 'on' ? '1' : '0'),
                        'kakun_pel' => $this->request->getVar('kelakun1'),
                        'st_sup' => ($this->request->getVar('suplier') == 'on' ? '1' : '0'),
                        'kakun_sup' => $this->request->getVar('kelakun2'),
                        'st_lain' => ($this->request->getVar('subkon') == 'on' ? '1' : '0'),
                        'kakun_lain' => $this->request->getVar('kelakun3'),
                        'catatan' => $this->request->getVar('catatan'),
                        'is_confirm' => $stconf,
                        'updated_by' => $this->user['id'],
                        'confirmed_by' => '0',
                    ]);
                    $db1 = $this->deklarModel->satuID('m_penerima', $this->request->getVar('idunik'));
                    $this->logModel->saveLog('Save', $this->request->getVar('idunik'), "{$db1[0]->kode} ; {$db1[0]->nama}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->kode} ; {$db1[0]->nama} {$savj}", 'kate' => $db1[0]->kategori]);
                }
                //Konfirmasi
                if ($this->request->getVar('postaction') == 'confirm') {
                    $this->penerimaModel->save(['id' => $db1[0]->id, 'is_confirm' => '1', 'confirmed_by' => $this->user['id']]);
                    $this->logModel->saveLog('Confirm', $this->request->getVar('idunik'), "{$db1[0]->kode} ; {$db1[0]->nama}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->kode} ; {$db1[0]->nama}" . lang("app.judulkonf"), 'kate' => $db1[0]->kategori]);
                }
                //Aktifasi
                if ($this->request->getVar('postaction') == 'aktif') {
                    $akby = (($this->request->getVar('niaktif') == '0') ? $this->user['id'] : '0');
                    $savj = (($this->request->getVar('niaktif') == '0') ? lang("app.judulnoaktif") : lang("app.judulaktif"));
                    $onoff = (($this->request->getVar('niaktif') == '0') ? 'nonaktif' : 'aktif');
                    $this->penerimaModel->save(['id' => $db1[0]->id, 'is_aktif' => $this->request->getVar('niaktif'), 'activated_by' => $akby]);
                    $this->logModel->saveLog('Active', $this->request->getVar('idunik'), "{$db1[0]->kode} ; {$db1[0]->nama} {$onoff}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->kode} ; {$db1[0]->nama} {$savj}", 'kate' => $db1[0]->kategori]);
                }
                $msg = ['redirect' => '/penerima'];
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
            $kategori = ($this->request->getVar('kategori') != 'all' ? $this->request->getVar('kategori') : '');
            $data = ['penerima' => $this->deklarModel->getPenerima($this->urls[1], '0', '', '', $kategori)];
            $msg = ['data' => view('x-file/penerima_tabel', $data)];
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }
}
