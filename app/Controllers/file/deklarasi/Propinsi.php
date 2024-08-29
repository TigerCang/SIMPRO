<?php

namespace App\Controllers\file\deklarasi;

use Config\App;
use App\Controllers\BaseController;
use App\Models\file\PropinsiModel;

class Propinsi extends BaseController
{
    protected $propinsiModel;
    public function __construct()
    {
        $this->propinsiModel = new PropinsiModel();
    }

    // ____________________________________________________________________________________________________________________________
    public function index()
    {
        (!preg_match("/114/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $data = [
            't_menu' => lang("app.tt_propinsi"), 't_submenu' => '',
            't_icon' => '<i class="fa fa-file ' . lang("app.xlist") . '"></i>',
            't_diricon' => '<i class="fa fa-map-signs"></i>', 't_dir1' => lang("app.deklar"), 't_dirac' => lang("app.propkabu"), 't_link' => '/propinsi',
            'kabupaten' => $this->deklarModel->getPropinsi($this->urls[1]),
            'btnclascr' => lang('app.btncCreate'), 'btntextcr' => lang('app.btnCreate'),
            'actcreate' => ($this->user['act_create'] == '0' ? 'hidden' : ''),
            'tuser' => $this->user, 'tmenu' => $this->menu,
        ];
        return view('file/deklarasi/propinsi_view', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function crany()
    {
        do {
            $idu = buatid();
            $db = $this->deklarModel->satuID('m_propinsi', $idu);
        } while ($db);
        $this->iduModel->saveID($idu);
        return redirect()->to('/propinsi/input/' . $idu);
    }

    // ____________________________________________________________________________________________________________________________
    public function showdata($idunik)
    {
        (!preg_match("/114/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $db1 = $this->deklarModel->satuID('m_propinsi', $idunik, 'y');
        $ticon = ($db1 ? lang("app.xdetil") : lang("app.xinput"));
        $data = [
            't_menu' => lang("app.tt_propinsi"), 't_submenu' => '',
            't_icon' => '<i class="fa fa-file ' . $ticon . '"></i>',
            't_diricon' => '<i class="fa fa-map-signs"></i>', 't_dir1' => lang("app.deklar"), 't_dirac' => lang("app.propkabu"), 't_link' => '/propinsi',
            'idu' => $this->iduModel->cekID($idunik), 'idunik' => $idunik,
            'propinsi' => $this->deklarModel->distItem('m_propinsi', 'propinsi'),
            'btnhid' => ($db1 ? 'hidden' : ''),
            'btnclas1' => ($db1 ? lang('app.btncUpdate') : lang('app.btncSave')),
            'btntext1' => ($db1 ? lang('app.btnUpdate') : lang('app.btnSave')),
            'btnclas2' => (($db1 && $db1[0]->is_aktif == '0') ? lang('app.btncAktif') : lang('app.btncNoaktif')),
            'btntext2' => (($db1 && $db1[0]->is_aktif == '0') ? lang('app.btnAktif') : lang('app.btnNoaktif')),
            'btnsama' => ($db1 ? ($db1[0]->is_confirm == '1' ? 'disabled' : ($db1[0]->updated_by == $this->user['id'] ? 'disabled' : '')) : ''),
            'actcreate' => ($db1 ? ($this->user['act_edit'] == '0' ? 'disabled' : '') : ($this->user['act_create'] == '0' ? 'disabled' : '')),
            'actconf' => ($db1 ? ($this->user['act_confirm'] == '0' ? 'disabled hidden' : '') : 'disabled hidden'),
            'actaktif' => ($db1 ? ($this->user['act_aktif'] == '0' ? 'disabled hidden' : '') : 'disabled hidden'),
            'kabupaten' => $db1,
            'tuser' => $this->user, 'tmenu' => $this->menu,
        ];
        (empty($data['kabupaten']) && empty($data['idu'])) && throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        if ($db1) $this->logModel->saveLog('Read', $idunik, "{$db1[0]->propinsi} ; {$db1[0]->kabupaten}", '-');
        return view('file/deklarasi/propinsi_input', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function savedata()
    {
        if ($this->request->isAJAX()) {
            $db1 = $this->deklarModel->satuID('m_propinsi', $this->request->getVar('idunik'));
            $savj = ($db1 ? lang("app.judulubah") : lang("app.judulsimpan"));
            $cekKabupaten = $this->deklarModel->cekPropinsi($this->request->getVar('xpropinsi'), $this->request->getVar('kabupaten'), $this->request->getVar('idunik'));
            $rule_kabupaten = ($cekKabupaten ? 'required|is_unique[m_propinsi.kabupaten]' : 'required');
            $stconf = (($db1 && $db1[0]->is_confirm != '0') ? '2' : '0');

            $validationRules = [
                'xpropinsi' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errpilih")]
                ],
                'kabupaten' => [
                    'rules' => $rule_kabupaten,
                    'errors' => ['required' => lang("app.errblank"), 'is_unique' => lang("app.errunik")]
                ],
            ];
            if (!$this->validate($validationRules)) {
                $msg = [
                    'error' => [
                        'propinsi' => $this->validation->getError('xpropinsi'),
                        'kabupaten' => $this->validation->getError('kabupaten'),
                    ]
                ];
            } else {
                //Simpan
                if ($this->request->getVar('postaction') == 'save') {
                    $this->propinsiModel->save([
                        'id' => $db1[0]->id ?? '',
                        'idunik' => $this->request->getVar('idunik'),
                        'propinsi' => $this->request->getVar('xpropinsi'),
                        'kabupaten' => $this->request->getVar('kabupaten'),
                        'is_confirm' => $stconf,
                        'updated_by' => $this->user['id'],
                        'confirmed_by' => '0',
                    ]);
                    $db1 = $this->deklarModel->satuID('m_propinsi', $this->request->getVar('idunik'));
                    $this->logModel->saveLog('Save', $this->request->getVar('idunik'), "{$db1[0]->propinsi} ; {$db1[0]->kabupaten}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->propinsi} ; {$db1[0]->kabupaten} {$savj}"]);
                }
                //Konfirmasi
                if ($this->request->getVar('postaction') == 'confirm') {
                    $this->propinsiModel->save(['id' => $db1[0]->id, 'is_confirm' => '1', 'confirmed_by' => $this->user['id']]);
                    $this->logModel->saveLog('Confirm', $this->request->getVar('idunik'), "{$db1[0]->propinsi} ; {$db1[0]->kabupaten}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->propinsi} ; {$db1[0]->kabupaten}" . lang("app.judulkonf")]);
                }
                //Aktifasi
                if ($this->request->getVar('postaction') == 'aktif') {
                    $akby = (($this->request->getVar('niaktif') == '0') ? $this->user['id'] : '0');
                    $savj = (($this->request->getVar('niaktif') == '0') ? lang("app.judulnoaktif") : lang("app.judulaktif"));
                    $onoff = (($this->request->getVar('niaktif') == '0') ? 'nonaktif' : 'aktif');
                    $this->propinsiModel->save(['id' => $db1[0]->id, 'is_aktif' => $this->request->getVar('niaktif'), 'activated_by' => $akby]);
                    $this->logModel->saveLog('Active', $this->request->getVar('idunik'), "{$db1[0]->propinsi} ; {$db1[0]->kabupaten} {$onoff}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->propinsi} ; {$db1[0]->kabupaten} {$savj}"]);
                }
                $msg = ['redirect' => '/propinsi'];
            }
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }
}
