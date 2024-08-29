<?php

namespace App\Controllers\file\deklarasi;

use Config\App;
use App\Controllers\BaseController;

class aUser extends BaseController
{
    // ____________________________________________________________________________________________________________________________
    public function index()
    {
        (!preg_match("/140/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $data = [
            't_menu' => lang("app.tt_user"), 't_submenu' => strtoupper(lang("app.veranak")),
            't_icon' => '<i class="fa fa-user ' . lang("app.xlist") . '"></i>',
            't_diricon' => '<i class="fa fa-map-signs"></i>', 't_dir1' => lang("app.deklar"), 't_dirac' => lang("app.user"), 't_link' => '/auser',
            'user' => $this->deklarModel->getUser($this->urls[1], $this->user['id']),
            'menu' => 'auser',
            'tuser' => $this->user, 'tmenu' => $this->menu,
        ];
        return view('file/admin/user_view', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function showdata($idunik)
    {
        (!preg_match("/140/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $db1 = $this->deklarModel->satuID('m_user', $idunik, 'y');
        $data = [
            't_menu' => lang("app.tt_user"), 't_submenu' => strtoupper(lang("app.veranak")),
            't_icon' => '<i class="fa fa-user ' . lang("app.xdetil") . '"></i>',
            't_diricon' => '<i class="fa fa-map-signs"></i>', 't_dir1' => lang("app.deklar"), 't_dirac' => lang("app.user"), 't_link' => '/auser',
            'idu' => $this->iduModel->cekID($idunik), 'idunik' => $idunik,
            'menu' => 'auser', 'btnhapus' => 'hidden',
            'role' => $this->deklarModel->getRole('', 't'),
            'level' => $this->konfigurasiModel->getKonfigurasi('konf_jlsetuju'),
            'perusahaan' => $this->deklarModel->getPerusahaan('', 't'),
            'wilayah' => $this->deklarModel->getDivisi('', 'wilayah', 't'),
            'divisi' => $this->deklarModel->getDivisi('', 'divisi', 't'),
            'jabatan' => $this->deklarModel->getDivisi('', 'jabatan', 't'),
            'proyek' => $this->deklarModel->getProyek('', 't'),
            'camp' => $this->deklarModel->getCamp('', 't'),
            'alat' => $this->deklarModel->getAlat('', 't', 'multi'),
            'tanah' => $this->deklarModel->getTanah('', 't'),
            'kasbank' => $this->deklarModel->getDefakun('', 'kas', 't'),
            'user1' => $this->deklarModel->get1User($db1[0]->atasan_id ?? '', 't'),
            'useratas' => $this->deklarModel->satuID('m_user', $db1[0]->atasan_id ?? '', '', 'id', 't'),
            'btnclas1' => lang('app.btncUpdate'),
            'btntext1' => lang('app.btnUpdate'),
            'btnclas2' => ($db1[0]->is_aktif == '0' ? lang('app.btncAktif') : lang('app.btncNoaktif')),
            'btntext2' => ($db1[0]->is_aktif == '0' ? lang('app.btnAktif') : lang('app.btnNoaktif')),
            'btnsama' => ($db1[0]->is_confirm == '1' ? 'disabled' : ($db1[0]->updated_by == $this->user['id'] ? 'disabled' : '')),
            'actcreate' => ($this->user['act_edit'] == '0' ? 'disabled' : ''),
            'actconf' => ($this->user['act_confirm'] == '0' ? 'disabled hidden' : ''),
            'actaktif' => ($this->user['act_aktif'] == '0' ? 'disabled hidden' : ''),
            'user' => $db1,
            'tuser' => $this->user, 'tmenu' => $this->menu,
        ];
        (empty($data['user']) && empty($data['idu'])) && throw new \CodeIgniter\Exceptions\PageNotFoundException();
        if ($db1) $this->logModel->saveLog('Read', $idunik, $db1[0]->kode, '-');
        return view('file/admin/user_input', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function savedata()
    {
        if ($this->request->isAJAX()) {
            $db1 = $this->deklarModel->satuID('m_user', $this->request->getVar('idunik'));
            $rule_atasan = ($db1[0]->id == $this->request->getVar('idatasan') ? 'valid_email' : 'permit_empty');
            $rule_batas = (ubahseparator($this->request->getVar('nibatas')) > $this->request->getVar('limitatasan') ? 'valid_email' : 'permit_empty');
            $rule_akses = (($this->request->getVar('level') != '0' && $this->request->getVar('setuju') != '') ? 'valid_email' : 'permit_empty');

            $validationRules = [
                'idatasan' => [
                    'rules' => $rule_atasan,
                    'errors' => ['valid_email' => lang("app.errunik")]
                ],
                'setuju' => [
                    'rules' => $rule_akses,
                    'errors' => ['valid_email' => lang("app.errunik")]
                ],
                'nibatas' => [
                    'rules' => $rule_batas,
                    'errors' => ['valid_email' => lang("app.errunik")]
                ],
                'role' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errblank")]
                ],
            ];
            if (!$this->validate($validationRules)) {
                $msg = [
                    'error' => [
                        'idatasan' => $this->validation->getError('idatasan'),
                        'setuju' => $this->validation->getError('setuju'),
                        'nibatas' => $this->validation->getError('nibatas'),
                        'role' => $this->validation->getError('role'),
                    ]
                ];
            } else {
                //Simpan
                if ($this->request->getVar('postaction') == 'save') {
                    $perusahaanmulti = (isset($_POST['dafperusahaan']) ? ',' . implode(",", $_POST['dafperusahaan']) . ',' : '' . ',');
                    $wilayahmulti = (isset($_POST['dafwilayah']) ? ',' . implode(",", $_POST['dafwilayah']) . ',' : '' . ',');
                    $divisimulti = (isset($_POST['dafdivisi']) ? ',' . implode(",", $_POST['dafdivisi']) . ',' : '' . ',');
                    $jabatanmulti = (isset($_POST['dafjabatan']) ? ',' . implode(",", $_POST['dafjabatan']) . ',' : '' . ',');
                    $proyekmulti = (isset($_POST['dafproyek']) ? ',' . implode(",", $_POST['dafproyek']) . ',' : '' . ',');
                    $campmulti = (isset($_POST['dafcamp']) ? ',' . implode(",", $_POST['dafcamp']) . ',' : '' . ',');
                    $alatmulti = (isset($_POST['dafalat']) ? ',' . implode(",", $_POST['dafalat']) . ',' : '' . ',');
                    $tanahmulti = (isset($_POST['daftanah']) ? ',' . implode(",", $_POST['daftanah']) . ',' : '' . ',');
                    $kasmulti = (isset($_POST['dafkas']) ? ',' . implode(",", $_POST['dafkas']) . ',' : '' . ',');

                    $this->userModel->save([
                        'id' => $db1[0]->id,
                        'idunik' => $this->request->getVar('idunik'),
                        'atasan_id' => $this->request->getVar('idatasan'),
                        'acc_setuju' => $this->request->getVar('level'),
                        'batasacc' => ubahseparator($this->request->getVar('nibatas')),
                        'act_create' => ($this->request->getVar('create') == 'on' ? '1' : '0'),
                        'act_edit' => ($this->request->getVar('edit') == 'on' ? '1' : '0'),
                        'act_confirm' => ($this->request->getVar('pasti') == 'on' ? '1' : '0'),
                        'act_aktif' => ($this->request->getVar('aktif') == 'on' ? '1' : '0'),
                        'act_perusahaan' => ($this->request->getVar('perusahaan') == 'on' ? '1' : '0'),
                        'perusahaan' => $perusahaanmulti,
                        'act_wilayah' => ($this->request->getVar('wilayah') == 'on' ? '1' : '0'),
                        'wilayah' => $wilayahmulti,
                        'act_divisi' => ($this->request->getVar('divisi') == 'on' ? '1' : '0'),
                        'divisi' => $divisimulti,
                        'act_gaji' => ($this->request->getVar('gaji') == 'on' ? '1' : '0'),
                        'gaji' => $jabatanmulti,
                        'act_camp' => ($this->request->getVar('camp') == 'on' ? '1' : '0'),
                        'camp' => $campmulti,
                        'act_proyek' => ($this->request->getVar('proyek') == 'on' ? '1' : '0'),
                        'proyek' => $proyekmulti,
                        'act_alat' => ($this->request->getVar('alat') == 'on' ? '1' : '0'),
                        'alat' => $alatmulti,
                        'act_tanah' => ($this->request->getVar('tanah') == 'on' ? '1' : '0'),
                        'tanah' => $tanahmulti,
                        'jenis_kas' => $kasmulti,
                        'act_super' => ($this->request->getVar('super') == 'on' ? '1' : '0'),
                        'act_saring' => ($this->request->getVar('saring') == 'on' ? '1' : '0'),
                        'act_setuju' => $this->request->getVar('setuju'),
                        'role_id' => $this->request->getVar('role'),
                        'is_confirm' => '0',
                        'updated_by' => $this->user['id'],
                        'confirmed_by' => '0',
                    ]);
                    $this->logModel->saveLog('Save', $this->request->getVar('idunik'), $db1[0]->kode);
                    $this->session->setFlashdata(['judul' => "{$db1[0]->kode}" . lang("app.judulubah")]);
                }
                //Konfirmasi
                if ($this->request->getVar('postaction') == 'confirm') {
                    $this->userModel->save(['id' => $db1[0]->id, 'is_confirm' => '1', 'confirmed_by' => $this->user['id']]);
                    $this->logModel->saveLog('Confirm', $this->request->getVar('idunik'), $db1[0]->kode);
                    $this->session->setFlashdata(['judul' => "{$db1[0]->kode}" . lang("app.judulkonf")]);
                }
                //Aktifasi
                if ($this->request->getVar('postaction') == 'aktif') {
                    $akby = (($this->request->getVar('niaktif') == '0') ? $this->user['id'] : '0');
                    $savj = (($this->request->getVar('niaktif') == '0') ? lang("app.judulnoaktif") : lang("app.judulaktif"));
                    $onoff = (($this->request->getVar('niaktif') == '0') ? 'nonaktif' : 'aktif');
                    $this->userModel->save(['id' => $db1[0]->id, 'is_aktif' => $this->request->getVar('niaktif'), 'activated_by' => $akby]);
                    $this->logModel->saveLog('Active', $this->request->getVar('idunik'), "{$db1[0]->kode} {$onoff}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->kode} {$savj}"]);
                }
                $msg = ['redirect' => '/auser'];
            }
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }
}
