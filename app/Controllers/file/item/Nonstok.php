<?php

namespace App\Controllers\file\item;

use Config\App;
use App\Controllers\BaseController;
use App\Models\file\BarangModel;

class Nonstok extends BaseController
{
    protected $barangModel;
    public function __construct()
    {
        $this->barangModel = new BarangModel();
    }

    // ____________________________________________________________________________________________________________________________
    public function index()
    {
        (!preg_match("/139/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $data = [
            't_menu' => lang("app.tt_nonstok"), 't_submenu' => '',
            't_icon' => '<i class="icofont icofont-bricks ' . lang("app.xlist") . '"></i>',
            't_diricon' => '<i class="fa fa-cubes"></i>', 't_dir1' => lang("app.item"), 't_dirac' => lang("app.nonstok"), 't_link' => '/nonstok',
            'menu' => 'nonstok', 'ihid' => 'hidden', 'bhid' => 'hidden',
            'katbarang' => $this->deklarModel->distItem('m_barang', 'kategori', 'nonstok'),
            'btnclascr' => lang('app.btncCreate'), 'btntextcr' => lang('app.btnCreate'),
            'actcreate' => ($this->user['act_create'] == '0' ? 'hidden' : ''),
            'tuser' => $this->user, 'tmenu' => $this->menu,
        ];
        return view('file/item/barang_view', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function crany()
    {
        do {
            $idu = buatid();
            $db = $this->deklarModel->satuID('m_barang', $idu);
        } while ($db);
        $this->iduModel->saveID($idu);
        return redirect()->to('/nonstok/input/' . $idu);
    }

    // ____________________________________________________________________________________________________________________________
    public function showdata($idunik)
    {
        (!preg_match("/139/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $db1 = $this->deklarModel->satuID('m_barang', $idunik, 'y');
        $ticon = ($db1 ? lang("app.xdetil") : lang("app.xinput"));
        $data = [
            't_menu' => lang("app.tt_nonstok"), 't_submenu' => '',
            't_icon' => '<i class="icofont icofont-bricks ' . $ticon . '"></i>',
            't_diricon' => '<i class="fa fa-cubes"></i>', 't_dir1' => lang("app.item"), 't_dirac' => lang("app.nonstok"), 't_link' => '/nonstok',
            'idu' => $this->iduModel->cekID($idunik), 'idunik' => $idunik,
            'kelakun' => $this->deklarModel->getKelAkun('stok', 'item'),
            'katbarang' => $this->deklarModel->distItem('m_barang', 'kategori', 'nonstok'),
            'merkbarang' => $this->deklarModel->distItem('m_barang', 'merk', 'barang'),
            'satuan' => $this->deklarModel->getDivisi('', 'satuan', 't'),
            'menu' => 'nonstok', 'ihid' => 'hidden', 'shid' => 'hidden', 'nhid' => '', 'ahid' => 'hidden',
            'barang' => $db1,
            'btnhid' => ($db1 ? 'hidden' : ''),
            'btnclas1' => ($db1 ? lang('app.btncUpdate') : lang('app.btncSave')),
            'btntext1' => ($db1 ? lang('app.btnUpdate') : lang('app.btnSave')),
            'btnclas2' => (($db1 && $db1[0]->is_aktif == '0') ? lang('app.btncAktif') : lang('app.btncNoaktif')),
            'btntext2' => (($db1 && $db1[0]->is_aktif == '0') ? lang('app.btnAktif') : lang('app.btnNoaktif')),
            'btnsama' => ($db1 ? ($db1[0]->is_confirm == '1' ? 'disabled' : ($db1[0]->updated_by == $this->user['id'] ? 'disabled' : '')) : ''),
            'actcreate' => ($db1 ? ($this->user['act_edit'] == '0' ? 'disabled' : '') : ($this->user['act_create'] == '0' ? 'disabled' : '')),
            'actconf' => ($db1 ? ($this->user['act_confirm'] == '0' ? 'disabled hidden' : '') : 'disabled hidden'),
            'actaktif' => ($db1 ? ($this->user['act_aktif'] == '0' ? 'disabled hidden' : '') : 'disabled hidden'),
            'tuser' => $this->user, 'tmenu' => $this->menu,
        ];
        (empty($data['barang']) && empty($data['idu'])) && throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        if ($db1) $this->logModel->saveLog('Read', $idunik, "{$db1[0]->kode} ; {$db1[0]->nama}", '-');
        return view('file/item/barang_input', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function savedata()
    {
        if ($this->request->isAJAX()) {
            $db1 = $this->deklarModel->satuID('m_barang', $this->request->getVar('idunik'));
            $savj = ($db1 ? lang("app.judulubah") : lang("app.judulsimpan"));
            $rule_kode = ($db1 ? ($db1[0]->kode != strtoupper($this->request->getVar('kodens')) ? 'required|is_unique[m_barang.kode]|min_length[11]' : 'required|min_length[11]') : 'required|is_unique[m_barang.kode]|min_length[11]');
            $stconf = (($db1 && $db1[0]->is_confirm != '0') ? '2' : '0');

            $validationRules = [
                'kodens' => [
                    'rules' => $rule_kode,
                    'errors' => ['required' => lang("app.errblank"), 'is_unique' => lang("app.errunik"), 'min_length' => lang("app.errlength", [11])]
                ],
                'nama' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errblank")]
                ],
                'kategori' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errpilih")]
                ],
                'satuan' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errpilih")]
                ],
                'catatan' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errblank")]
                ],
                'gambar' => [
                    'rules' => 'max_size[gambar,1024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/bmp,image/png]',
                    'errors' => ['max_size' => lang("app.errfilebesar"), 'is_image' => lang("app.errnotimg"), 'mime_in' => lang("app.errfileext")]
                ],
            ];
            if (!$this->validate($validationRules)) {
                $msg = [
                    'error' => [
                        'kodens' => $this->validation->getError('kodens'),
                        'nama' => $this->validation->getError('nama'),
                        'kategori' => $this->validation->getError('kategori'),
                        'satuan' => $this->validation->getError('satuan'),
                        'catatan' => $this->validation->getError('catatan'),
                        'gambar' => $this->validation->getError('gambar'),
                    ]
                ];
            } else {
                //Simpan
                if ($this->request->getVar('postaction') == 'save') {
                    $file_gambar = $this->request->getFile('gambar');
                    $nama_gambar = ($file_gambar->getError() == 4) ? $this->request->getVar('namagambar') : $file_gambar->getName();
                    if ($file_gambar->getError() != 4) $file_gambar->move('assets/fileimg/barang', $nama_gambar);
                    if ($this->request->getVar('namagambar') != 'default.png' && $file_gambar->getError() != 4) unlink('assets/fileimg/barang' . $this->request->getVar('namagambar'));
                    $this->barangModel->save([
                        'id' => $db1[0]->id ?? '',
                        'idunik' => $this->request->getVar('idunik'),
                        'pilihan' => "nonstok",
                        'kode' => strtoupper($this->request->getVar('kodens')),
                        'nama' => $this->request->getVar('nama'),
                        'kategori' => $this->request->getVar('kategori'),
                        'satuan' => $this->request->getVar('satuan'),
                        'catatan' => $this->request->getVar('catatan'),
                        'gambar' => $nama_gambar,
                        'is_confirm' => $stconf,
                        'updated_by' => $this->user['id'],
                        'confirmed_by' => '0',
                    ]);
                    $db1 = $this->deklarModel->satuID('m_barang', $this->request->getVar('idunik'));
                    $this->logModel->saveLog('Save', $this->request->getVar('idunik'), "{$db1[0]->kode} ; {$db1[0]->nama}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->kode} ; {$db1[0]->nama} {$savj}", 'kate' => $db1[0]->kategori]);
                }
                //Konfirmasi
                if ($this->request->getVar('postaction') == 'confirm') {
                    $this->barangModel->save(['id' => $db1[0]->id, 'is_confirm' => '1', 'confirmed_by' => $this->user['id']]);
                    $this->logModel->saveLog('Confirm', $this->request->getVar('idunik'), "{$db1[0]->kode} ; {$db1[0]->nama}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->kode} ; {$db1[0]->nama}" . lang("app.judulkonf")]);
                }
                //Aktifasi
                if ($this->request->getVar('postaction') == 'aktif') {
                    $akby = (($this->request->getVar('niaktif') == '0') ? $this->user['id'] : '0');
                    $savj = (($this->request->getVar('niaktif') == '0') ? lang("app.judulnoaktif") : lang("app.judulaktif"));
                    $onoff = (($this->request->getVar('niaktif') == '0') ? 'nonaktif' : 'aktif');
                    $this->barangModel->save(['id' => $db1[0]->id, 'is_aktif' => $this->request->getVar('niaktif'), 'activated_by' => $akby]);
                    $this->logModel->saveLog('Active', $this->request->getVar('idunik'), "{$db1[0]->kode} ; {$db1[0]->nama} {$onoff}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->kode} ; {$db1[0]->nama} {$savj}"]);
                }
                $msg = ['redirect' => '/nonstok'];
            }
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }
}
