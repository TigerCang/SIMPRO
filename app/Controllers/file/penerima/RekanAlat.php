<?php

namespace App\Controllers\file\penerima;

use Config\App;
use App\Controllers\BaseController;
use App\Models\file\AlatModel;

class RekanAlat extends BaseController
{
    protected $alatModel;
    public function __construct()
    {
        $this->alatModel = new AlatModel();
    }

    // ____________________________________________________________________________________________________________________________
    public function index()
    {
        (!preg_match("/143/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $data = [
            't_menu' => lang("app.tt_mobilrekan"), 't_submenu' => '',
            't_icon' => '<i class="icofont icofont-vehicle-delivery-van ' . lang("app.xlist") . '"></i>',
            't_diricon' => '<i class="icofont icofont-people"></i>', 't_dir1' => lang("app.penerima"), 't_dirac' => lang("app.mobilrekan"), 't_link' => '/rekanalat',
            'perusahaan' => $this->deklarModel->getPerusahaan('', 't'),
            'divisi' => $this->deklarModel->getDivisi('', 'divisi', 't'),
            'penerima1' => $this->deklarModel->satuID('m_penerima', session()->getFlashdata('rekan') ?? '', '', 'id', 't'),
            'menu' => 'rekanalat', 'rhid' => '', 'pdhid' => 'hidden',
            'btnclascr' => lang('app.btncCreate'), 'btntextcr' => lang('app.btnCreate'),
            'actcreate' => ($this->user['act_create'] == '0' ? 'hidden' : ''),
            'tuser' => $this->user, 'tmenu' => $this->menu,
        ];
        return view('file/aset/alat_view', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function crany()
    {
        do {
            $idu = buatid();
            $db = $this->deklarModel->satuID('m_alat', $idu);
        } while ($db);
        $this->iduModel->saveID($idu);
        return redirect()->to('/rekanalat/input/' . $idu);
    }

    // ____________________________________________________________________________________________________________________________
    public function showdata($idunik)
    {
        (!preg_match("/143/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $db1 = $this->deklarModel->satuID('m_alat', $idunik, 'y');
        $ticon = ($db1 ? lang("app.xdetil") : lang("app.xinput"));
        $data = [
            't_menu' => lang("app.tt_mobilrekan"), 't_submenu' => '',
            't_icon' => '<i class="icofont icofont-vehicle-delivery-van ' . $ticon . '"></i>',
            't_diricon' => '<i class="icofont icofont-people"></i>', 't_dir1' => lang("app.penerima"), 't_dirac' => lang("app.mobilrekan"), 't_link' => '/rekanalat',
            'idu' => $this->iduModel->cekID($idunik), 'idunik' => $idunik,
            'selbentuk' => $this->deklarModel->distSelect('bentuk'),
            'penerima1' => $this->deklarModel->satuID('m_penerima', $db1['0']->penerima_id ?? '', '', 'id', 't'),
            'katalat' => $this->deklarModel->getDivisi('', 'katalat', 't'),
            'btnhid' => ($db1 ? 'hidden' : ''),
            'btnclas1' => ($db1 ? lang('app.btncUpdate') : lang('app.btncSave')),
            'btntext1' => ($db1 ? lang('app.btnUpdate') : lang('app.btnSave')),
            'btnclas2' => (($db1 && $db1[0]->is_aktif == '0') ? lang('app.btncAktif') : lang('app.btncNoaktif')),
            'btntext2' => (($db1 && $db1[0]->is_aktif == '0') ? lang('app.btnAktif') : lang('app.btnNoaktif')),
            'btnsama' => ($db1 ? ($db1[0]->is_confirm == '1' ? 'disabled' : ($db1[0]->updated_by == $this->user['id'] ? 'disabled' : '')) : ''),
            'actcreate' => ($db1 ? ($this->user['act_edit'] == '0' ? 'disabled' : '') : ($this->user['act_create'] == '0' ? 'disabled' : '')),
            'actconf' => ($db1 ? ($this->user['act_confirm'] == '0' ? 'disabled hidden' : '') : 'disabled hidden'),
            'actaktif' => ($db1 ? ($this->user['act_aktif'] == '0' ? 'disabled hidden' : '') : 'disabled hidden'),
            'alat' => $db1,
            'tuser' => $this->user, 'tmenu' => $this->menu,
        ];
        (empty($data['alat']) && empty($data['idu'])) && throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        if ($db1) $this->logModel->saveLog('Read', $idunik, "{$db1[0]->nomor} ; {$db1[0]->nama}", '-');
        return view('file/penerima/rekanalat_input', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function savedata()
    {
        if ($this->request->isAJAX()) {
            $db1 = $this->deklarModel->satuID('m_alat', $this->request->getVar('idunik'));
            $savj = ($db1 ? lang("app.judulubah") : lang("app.judulsimpan"));
            $stconf = (($db1 && $db1[0]->is_confirm != '0') ? '2' : '0');

            $validationRules = [
                'rekan' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errpilih")]
                ],
                'nomor' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errblank")]
                ],
                'nama' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errblank")]
                ],
                'bentuk' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errpilih")]
                ],
                'kategori' => [
                    'rules' => 'required',
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
                        'rekan' => $this->validation->getError('rekan'),
                        'nomor' => $this->validation->getError('nomor'),
                        'nama' => $this->validation->getError('nama'),
                        'bentuk' => $this->validation->getError('bentuk'),
                        'kategori' => $this->validation->getError('kategori'),
                        'catatan' => $this->validation->getError('catatan'),
                    ]
                ];
            } else {
                //Simpan
                if ($this->request->getVar('postaction') == 'save') {
                    $this->alatModel->save([
                        'id' => $db1[0]->id ?? '',
                        'idunik' => $this->request->getVar('idunik'),
                        'pilihan' => 'rekan',
                        'penerima_id' => $this->request->getVar('rekan'),
                        'nomor' => strtoupper($this->request->getVar('nomor')),
                        'nama' => $this->request->getVar('nama'),
                        'bentuk' => $this->request->getVar('bentuk'),
                        'kategori_id' => $this->request->getVar('kategori'),
                        'catatan' => $this->request->getVar('catatan'),
                        'is_confirm' => $stconf,
                        'updated_by' => $this->user['id'],
                        'confirmed_by' => '0',
                    ]);
                    $db1 = $this->deklarModel->satuID('m_alat', $this->request->getVar('idunik'));
                    $this->logModel->saveLog('Save', $this->request->getVar('idunik'), "{$db1[0]->nomor} ; {$db1[0]->nama}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->nomor} ; {$db1[0]->nama} {$savj}", 'rekan' => $db1[0]->penerima_id]);
                }
                //Konfirmasi
                if ($this->request->getVar('postaction') == 'confirm') {
                    $this->alatModel->save(['id' => $db1[0]->id, 'is_confirm' => '1', 'confirmed_by' => $this->user['id']]);
                    $this->logModel->saveLog('Confirm', $this->request->getVar('idunik'), "{$db1[0]->nomor} ; {$db1[0]->nama}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->nomor} ; {$db1[0]->nama}" . lang("app.judulkonf"), 'rekan' => $db1[0]->penerima_id]);
                }
                //Aktifasi
                if ($this->request->getVar('postaction') == 'aktif') {
                    $akby = (($this->request->getVar('niaktif') == '0') ? $this->user['id'] : '0');
                    $savj = (($this->request->getVar('niaktif') == '0') ? lang("app.judulnoaktif") : lang("app.judulaktif"));
                    $onoff = (($this->request->getVar('niaktif') == '0') ? 'nonaktif' : 'aktif');
                    $this->alatModel->save(['id' => $db1[0]->id, 'is_aktif' => $this->request->getVar('niaktif'), 'activated_by' => $akby]);
                    $this->logModel->saveLog('Active', $this->request->getVar('idunik'), "{$db1[0]->nomor} ; {$db1[0]->nama} {$onoff}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->nomor} ; {$db1[0]->nama} {$savj}", 'rekan' => $db1[0]->penerima_id]);
                }
                $msg = ['redirect' => '/rekanalat'];
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
            $penerima = ($this->request->getVar('penerima') == '' ? '-' : $this->request->getVar('penerima'));
            $data = ['alat' => $this->deklarModel->getAlat($this->urls[1], '', 'rekan', '', '', $penerima), 'rantkps' => '0010100', 'menu' => 'rekanalat'];
            $msg = ['data' => view('x-file/alat_tabel', $data)];
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }
}
// 'rknpcs' => '101010'