<?php

namespace App\Controllers\file\deklarasi;

use Config\App;
use App\Controllers\BaseController;
use App\Models\file\PerusahaanModel;

class Perusahaan extends BaseController
{
    protected $perusahaanModel;
    public function __construct()
    {
        $this->perusahaanModel = new PerusahaanModel();
    }

    // ____________________________________________________________________________________________________________________________
    public function index()
    {
        (!preg_match("/107/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $data = [
            't_menu' => lang("app.tt_perusahaan"), 't_submenu' => '',
            't_icon' => '<i class="icofont icofont-company ' . lang("app.xlist") . '"></i>',
            't_diricon' => '<i class="fa fa-map-signs"></i>', 't_dir1' => lang("app.deklar"), 't_dirac' => lang("app.perusahaan"), 't_link' => '/perusahaan',
            'menu' => 'perusahaan', 'phid' => 'hidden', 'ahid' => '',
            'perusahaan' => $this->deklarModel->getPerusahaan($this->urls[1]),
            'btnclascr' => lang('app.btncCreate'), 'btntextcr' => lang('app.btnCreate'),
            'actcreate' => ($this->user['act_create'] == '0' ? 'hidden' : ''),
            'tuser' => $this->user, 'tmenu' => $this->menu,
        ];
        return view('file/deklarasi/perusahaan_view', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function crany()
    {
        do {
            $idu = buatid();
            $db = $this->deklarModel->satuID('m_perusahaan', $idu);
        } while ($db);
        $this->iduModel->saveID($idu);
        return redirect()->to('/perusahaan/input/' . $idu);
    }

    // ____________________________________________________________________________________________________________________________
    public function showdata($idunik)
    {
        (!preg_match("/107/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $db1 = $this->deklarModel->satuID('m_perusahaan', $idunik, 'y');
        $ticon = ($db1 ? lang("app.xdetil") : lang("app.xinput"));
        $data = [
            't_menu' => lang("app.tt_perusahaan"), 't_submenu' => '',
            't_icon' => '<i class="icofont icofont-company ' . $ticon . '"></i>',
            't_diricon' => '<i class="fa fa-map-signs"></i>', 't_dir1' => lang("app.deklar"), 't_dirac' => lang("app.perusahaan"), 't_link' => '/perusahaan',
            'idu' => $this->iduModel->cekID($idunik), 'idunik' => $idunik,
            'menu' => 'perusahaan', 'phid' => 'hidden', 'ahid' => '', 'penro' => '', 'penerima1' => '',
            'btnhid' => ($db1 ? 'hidden' : ''), 'btnlam' => ($db1 ? '' : 'hidden'),
            'btnclas1' => ($db1 ? lang('app.btncUpdate') : lang('app.btncSave')),
            'btntext1' => ($db1 ? lang('app.btnUpdate') : lang('app.btnSave')),
            'btnclas2' => (($db1 && $db1[0]->is_aktif == '0') ? lang('app.btncAktif') : lang('app.btncNoaktif')),
            'btntext2' => (($db1 && $db1[0]->is_aktif == '0') ? lang('app.btnAktif') : lang('app.btnNoaktif')),
            'btnsama' => ($db1 ? ($db1[0]->is_confirm == '1' ? 'disabled' : ($db1[0]->updated_by == $this->user['id'] ? 'disabled' : '')) : ''),
            'actcreate' => ($db1 ? ($this->user['act_edit'] == '0' ? 'disabled' : '') : ($this->user['act_create'] == '0' ? 'disabled' : '')),
            'actconf' => ($db1 ? ($this->user['act_confirm'] == '0' ? 'disabled hidden' : '') : 'disabled hidden'),
            'actaktif' => ($db1 ? ($this->user['act_aktif'] == '0' ? 'disabled hidden' : '') : 'disabled hidden'),
            'perusahaan' => $db1,
            'tuser' => $this->user, 'tmenu' => $this->menu,
        ];
        (empty($data['perusahaan']) && empty($data['idu'])) && throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        if ($db1) $this->logModel->saveLog('Read', $idunik, "{$db1[0]->kode} ; {$db1[0]->nama}", '-');
        return view('file/deklarasi/perusahaan_input', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function savedata()
    {
        if ($this->request->isAJAX()) {
            $db1 = $this->deklarModel->satuID('m_perusahaan', $this->request->getVar('idunik'));
            $savj = ($db1 ? lang("app.judulubah") : lang("app.judulsimpan"));
            $rule_kode = ($db1 ? ($db1[0]->kode != $this->request->getVar('kode') ? 'required|is_unique[m_perusahaan.kode]|min_length[3]' : 'required|min_length[3]') : 'required|is_unique[m_perusahaan.kode]|min_length[3]');
            $rule_kui = ($db1 ? ($db1[0]->kui != $this->request->getVar('kui') ? 'required|is_unique[m_perusahaan.kui]|min_length[3]' : 'required|min_length[3]') : 'required|is_unique[m_perusahaan.kui]|min_length[3]');
            $stconf = (($db1 && $db1[0]->is_confirm != '0') ? '2' : '0');
            // if (!$this->validate([

            $validationRules = [
                'kode' => [
                    'rules' => $rule_kode,
                    'errors' => ['required' => lang("app.errblank"), 'is_unique' => lang("app.errunik"), 'min_length' => lang("app.errlength", [3])]
                ],
                'kui' => [
                    'rules' => $rule_kui,
                    'errors' => ['required' => lang("app.errblank"), 'is_unique' => lang("app.errunik"), 'min_length' => lang("app.errlength", [3])]
                ],
                'nama' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errblank")]
                ],
                'alamat' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errblank")]
                ],
                'kota' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errblank")]
                ],
                'gambar' => [
                    'rules' => 'max_size[gambar,1024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/bmp,image/png]',
                    'errors' => ['max_size' => lang("app.errfilebesar1"), 'is_image' => lang("app.errnotimg"), 'mime_in' => lang("app.errfileext")]
                ],
            ];
            if (!$this->validate($validationRules)) {
                $msg = [
                    'error' => [
                        'kode' => $this->validation->getError('kode'),
                        'kui' => $this->validation->getError('kui'),
                        'nama' => $this->validation->getError('nama'),
                        'alamat' => $this->validation->getError('alamat'),
                        'kota' => $this->validation->getError('kota'),
                        'gambar' => $this->validation->getError('gambar'),
                    ]
                ];
            } else {
                //Simpan
                if ($this->request->getVar('postaction') == 'save') {
                    $file_gambar = $this->request->getFile('gambar');
                    $nama_gambar = ($file_gambar->getError() == 4) ? $this->request->getVar('namagambar') : $file_gambar->getName();
                    if ($file_gambar->getError() != 4) $file_gambar->move('assets/fileimg/perusahaan', $nama_gambar);
                    if ($this->request->getVar('namagambar') != 'default.png' && $file_gambar->getError() != 4) unlink('assets/fileimg/perusahaan' . $this->request->getVar('namagambar'));
                    $this->perusahaanModel->save([
                        'id' => $db1[0]->id ?? '',
                        'idunik' => $this->request->getVar('idunik'),
                        'kode' => $this->request->getVar('kode'),
                        'kui' => strtoupper($this->request->getVar('kui')),
                        'nama' => $this->request->getVar('nama'),
                        'alamat' => $this->request->getVar('alamat'),
                        'telp' => $this->request->getVar('telp'),
                        'kota' => $this->request->getVar('kota'),
                        'direktur' => $this->request->getVar('direktur'),
                        'logo' => $nama_gambar,
                        'is_confirm' => $stconf,
                        'updated_by' => $this->user['id'],
                        'confirmed_by' => '0',
                    ]);
                    $db1 = $this->deklarModel->satuID('m_perusahaan', $this->request->getVar('idunik'));
                    $this->logModel->saveLog('Save', $this->request->getVar('idunik'), "{$db1[0]->kode} ; {$db1[0]->nama}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->kode} ; {$db1[0]->nama} {$savj}"]);
                }
                //Konfirmasi
                if ($this->request->getVar('postaction') == 'confirm') {
                    $this->perusahaanModel->save(['id' => $db1[0]->id, 'is_confirm' => '1', 'confirmed_by' => $this->user['id']]);
                    $this->logModel->saveLog('Confirm', $this->request->getVar('idunik'), "{$db1[0]->kode} ; {$db1[0]->nama}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->kode} ; {$db1[0]->nama}" . lang("app.judulkonf")]);
                }
                //Aktifasi
                if ($this->request->getVar('postaction') == 'aktif') {
                    $akby = (($this->request->getVar('niaktif') == '0') ? $this->user['id'] : '0');
                    $savj = (($this->request->getVar('niaktif') == '0') ? lang("app.judulnoaktif") : lang("app.judulaktif"));
                    $onoff = (($this->request->getVar('niaktif') == '0') ? 'nonaktif' : 'aktif');
                    $this->perusahaanModel->save(['id' => $db1[0]->id, 'is_aktif' => $this->request->getVar('niaktif'), 'activated_by' => $akby]);
                    $this->logModel->saveLog('Active', $this->request->getVar('idunik'), "{$db1[0]->kode} ; {$db1[0]->nama} {$onoff}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->kode} ; {$db1[0]->nama} {$savj}"]);
                }
                $msg = ['redirect' => '/perusahaan'];
            }
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }
}
