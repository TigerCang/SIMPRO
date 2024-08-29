<?php

namespace App\Controllers\file\aset;

use Config\App;
use App\Controllers\BaseController;
use App\Models\file\AlatModel;

class Alat extends BaseController
{
    protected $alatModel;
    public function __construct()
    {
        $this->alatModel = new AlatModel();
    }

    // ____________________________________________________________________________________________________________________________
    public function index()
    {
        (!preg_match("/126/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $data = [
            't_menu' => lang("app.tt_alat"), 't_submenu' => '',
            't_icon' => '<i class="icofont icofont-vehicle-dozer ' . lang("app.xlist") . '"></i>',
            't_diricon' => '<i class="fa fa-sitemap"></i>', 't_dir1' => lang("app.cabangaset"), 't_dir2' => lang("app.alat"), 't_dirac' => lang("app.alat"), 't_link' => '/alat',
            'menu' => 'alat', 'rhid' => 'hidden', 'pdhid' => '',
            'perusahaan' => $this->deklarModel->getPerusahaan('', 't'),
            'divisi' => $this->deklarModel->getDivisi('', 'divisi', 't'),
            'penerima1' => $this->deklarModel->satuID('m_penerima', 'id'),
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
        return redirect()->to('/alat/input/' . $idu);
    }

    // ____________________________________________________________________________________________________________________________
    public function showdata($idunik)
    {
        (!preg_match("/126/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $db1 = $this->deklarModel->satuID('m_alat', $idunik, 'y');
        $ticon = ($db1 ? lang("app.xdetil") : lang("app.xinput"));
        $data = [
            't_menu' => lang("app.tt_alat"), 't_submenu' => '',
            't_icon' => '<i class="icofont icofont-vehicle-dozer ' . $ticon . '"></i>',
            't_diricon' => '<i class="fa fa-sitemap"></i>', 't_dir1' => lang("app.cabangaset"), 't_dir2' => lang("app.alat"), 't_dirac' => lang("app.alat"), 't_link' => '/alat',
            'idu' => $this->iduModel->cekID($idunik), 'idunik' => $idunik,
            'perusahaan' => $this->deklarModel->getPerusahaan('', 't'),
            'wilayah' => $this->deklarModel->getDivisi('', 'wilayah', 't'),
            'divisi' => $this->deklarModel->getDivisi('', 'divisi', 't'),
            'kelakun' => $this->deklarModel->getKelAkun('aset', 'alat'),
            'katalat' => $this->deklarModel->getDivisi('', 'katalat', 't'),
            'tipealat' => $this->deklarModel->distItem('m_alat', 'jenis'),
            'selnama' => $this->deklarModel->distSelect('sistemsusut'),
            'selbentuk' => $this->deklarModel->distSelect('bentuk'),
            'supir1' => $this->deklarModel->satuID('m_penerima', $db1[0]->supir_id ?? '', '', 'id', 't'),
            'kbli1' => $this->deklarModel->satuID('m_kbli', $db1[0]->kbli_id ?? '', '', 'id', 't'),
            'biaya1' => $this->deklarModel->satuID('m_biaya', $db1[0]->biaya_id ?? '', '', 'id', 't'),
            'btnhid' => ($db1 ? 'hidden' : ''), 'btnlam' => ($db1 ? '' : 'hidden'),
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
        if ($data['alat']) {
            if ($this->user['act_perusahaan'] == "0" && !preg_match("/," . $data['alat'][0]->perusahaan_id . ",/i", $this->user['perusahaan'])) throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
            if ($this->user['act_wilayah'] == "0" && !preg_match("/," . $data['alat'][0]->wilayah_id . ",/i", $this->user['wilayah'])) throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
            if ($this->user['act_divisi'] == "0" && !preg_match("/," . $data['alat'][0]->divisi_id . ",/i", $this->user['divisi'])) throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        }
        if ($db1) $this->logModel->saveLog('Read', $idunik, "{$db1[0]->kode} ; {$db1[0]->nomor} ; {$db1[0]->nama}", '-');
        return view('file/aset/alat_input', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function savedata()
    {
        if ($this->request->isAJAX()) {
            $db1 = $this->deklarModel->satuID('m_alat', $this->request->getVar('idunik'));
            $savj = ($db1 ? lang("app.judulubah") : lang("app.judulsimpan"));
            $rule_kode = ($db1 ? ($db1[0]->kode != strtoupper($this->request->getVar('kode')) ? 'required|is_unique[m_alat.kode]|min_length[10]' : 'required|min_length[10]') : 'required|is_unique[m_alat.kode]|min_length[10]');
            $stconf = (($db1 && $db1[0]->is_confirm != '0') ? '2' : '0');

            $validationRules = [
                'kode' => [
                    'rules' => $rule_kode,
                    'errors' => ['required' => lang("app.errblank"), 'is_unique' => lang("app.errunik"), 'min_length' => lang("app.errlength", [10])]
                ],
                'nama' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errblank")]
                ],
                'idperusahaan' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errpilih")]
                ],
                'idwilayah' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errpilih")]
                ],
                'iddivisi' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errpilih")]
                ],
                'kbli' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errpilih")]
                ],
                'kelakun' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errpilih")]
                ],
                'nibeli' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errblank")]
                ],
                'nisewa' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errblank")]
                ],
                'msusut' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errpilih")]
                ],
                'biaya' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errpilih")]
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
                'gambar' => [
                    'rules' => 'max_size[gambar,1024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/bmp,image/png]',
                    'errors' => ['max_size' => lang("app.errfilebesar1"), 'is_image' => lang("app.errnotimg"), 'mime_in' => lang("app.errfileext")]
                ],
            ];
            if (!$this->validate($validationRules)) {
                $msg = [
                    'error' => [
                        'kode' => $this->validation->getError('kode'),
                        'nama' => $this->validation->getError('nama'),
                        'perusahaan' => $this->validation->getError('idperusahaan'),
                        'wilayah' => $this->validation->getError('idwilayah'),
                        'divisi' => $this->validation->getError('iddivisi'),
                        'kbli' => $this->validation->getError('kbli'),
                        'kelakun' => $this->validation->getError('kelakun'),
                        'nibeli' => $this->validation->getError('nibeli'),
                        'nisewa' => $this->validation->getError('nisewa'),
                        'msusut' => $this->validation->getError('msusut'),
                        'biaya' => $this->validation->getError('biaya'),
                        'bentuk' => $this->validation->getError('bentuk'),
                        'kategori' => $this->validation->getError('kategori'),
                        'catatan' => $this->validation->getError('catatan'),
                        'gambar' => $this->validation->getError('gambar'),
                    ]
                ];
            } else {
                //Simpan
                if ($this->request->getVar('postaction') == 'save') {
                    $file_gambar = $this->request->getFile('gambar');
                    $nama_gambar = (($file_gambar->getError() == 4) ? $this->request->getVar('gambarlama') : $file_gambar->getName());
                    if ($file_gambar->getError() != 4) $file_gambar->move('assets/fileimg/alat', $nama_gambar);
                    if ($this->request->getVar('gambarlama') != 'default.png' && $file_gambar->getError() != 4) unlink('assets/fileimg/alat' . $this->request->getVar('gambarlama'));
                    $this->alatModel->save([
                        'id' => $db1[0]->id ?? '',
                        'idunik' => $this->request->getVar('idunik'),
                        'pilihan' => 'pribadi',
                        'perusahaan_id' => $this->request->getVar('idperusahaan'),
                        'wilayah_id' => $this->request->getVar('idwilayah'),
                        'divisi_id' => $this->request->getVar('iddivisi'),
                        'perusahaanin_id' => $this->request->getVar('perusahaaninternal'),
                        'kakun_id' => $this->request->getVar('kelakun'),
                        'kode' => strtoupper($this->request->getVar('kode')),
                        'nomor' => strtoupper($this->request->getVar('nomor')),
                        'nama' => $this->request->getVar('nama'),
                        'kbli_id' => $this->request->getVar('kbli'),
                        'merk' => $this->request->getVar('merk'),
                        'bentuk' => $this->request->getVar('bentuk'),
                        'kategori_id' => $this->request->getVar('kategori'),
                        'jenis' => $this->request->getVar('jenis'),
                        'surat' => $this->request->getVar('surat'),
                        'mesin' => $this->request->getVar('mesin'),
                        'transmisi' => $this->request->getVar('transmisi'),
                        'tgl_beli' => $this->request->getVar('tglbeli'),
                        'tgl_produksi' => $this->request->getVar('tglbuat'),
                        'tgl_stnk' => $this->request->getVar('tglstnk'),
                        'tgl_keur' => $this->request->getVar('tglkir'),
                        'umur' => ubahseparator($this->request->getVar('umur')),
                        'sisa' => ubahseparator($this->request->getVar('sisa')),
                        'ni_beli' => ubahseparator($this->request->getVar('nibeli')),
                        'ni_residu' => ubahseparator($this->request->getVar('niresidu')),
                        'ni_sewa' => ubahseparator($this->request->getVar('nisewa')),
                        'ni_susut' => ubahseparator($this->request->getVar('nisusut')),
                        'modsusut' => $this->request->getVar('msusut'),
                        'berat' => ubahseparator($this->request->getVar('kapasitas')),
                        'ibbm' => ubahseparator($this->request->getVar('ibbm')),
                        'bukti' => $this->request->getVar('faktur'),
                        'supir_id' => $this->request->getVar('pegawai'),
                        'biaya_id' => $this->request->getVar('biaya'),
                        'catatan' => $this->request->getVar('catatan'),
                        'gambar' => $nama_gambar,
                        'is_confirm' => $stconf,
                        'updated_by' => $this->user['id'],
                        'confirmed_by' => '0',
                    ]);
                    $db1 = $this->deklarModel->satuID('m_alat', $this->request->getVar('idunik'));
                    $wil1 = $this->deklarModel->satuID('m_divisi', $this->request->getVar('idwilayah'), '', 'id');
                    $strwil = (($this->request->getVar('idwilayah') != $this->request->getVar('idwilayahlama')) && ($this->request->getVar('idwilayahlama') == '')) ?
                        "{$db1[0]->kode} ; {$db1[0]->nomor} ; {$db1[0]->nama} => {$wil1[0]->nama}" : "{$db1[0]->kode} ; {$db1[0]->nomor} ; {$db1[0]->nama}";
                    $this->logModel->saveLog('Save', $this->request->getVar('idunik'), $strwil);
                    $this->session->setFlashdata(['judul' => "{$db1[0]->kode} ; {$db1[0]->nomor} ; {$db1[0]->nama} {$savj}", 'perus' => $db1[0]->perusahaan_id, 'div' => $db1[0]->divisi_id]);
                }
                $wil1 = $this->deklarModel->satuID('m_divisi', $this->request->getVar('idwilayah'), '', 'id');
                $strwil = (($this->request->getVar('idwilayah') != $this->request->getVar('idwilayahlama')) && ($this->request->getVar('idwilayahlama') == '')) ?
                    "{$db1[0]->kode} ; {$db1[0]->nomor} ; {$db1[0]->nama} => {$wil1[0]->nama}" : "{$db1[0]->kode} ; {$db1[0]->nomor} ; {$db1[0]->nama}";
                //Konfirmasi
                if ($this->request->getVar('postaction') == 'confirm') {
                    $this->alatModel->save(['id' => $db1[0]->id, 'is_confirm' => '1', 'confirmed_by' => $this->user['id']]);
                    $this->logModel->saveLog('Confirm', $this->request->getVar('idunik'), $strwil);
                    $this->session->setFlashdata(['judul' => "{$db1[0]->kode} ; {$db1[0]->nomor} ; {$db1[0]->nama}" . lang("app.judulkonf"), 'perus' => $db1[0]->perusahaan_id, 'div' => $db1[0]->divisi_id]);
                }
                //Aktifasi
                if ($this->request->getVar('postaction') == 'aktif') {
                    $akby = (($this->request->getVar('niaktif') == '0') ? $this->user['id'] : '0');
                    $savj = (($this->request->getVar('niaktif') == '0') ? lang("app.judulnoaktif") : lang("app.judulaktif"));
                    $onoff = (($this->request->getVar('niaktif') == '0') ? 'nonaktif' : 'aktif');
                    $this->alatModel->save(['id' => $db1[0]->id, 'is_aktif' => $this->request->getVar('niaktif'), 'activated_by' => $akby]);
                    $this->logModel->saveLog('Active', $this->request->getVar('idunik'), "{$strwil} {$onoff}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->kode} ; {$db1[0]->nomor} ; {$db1[0]->nama} {$savj}", 'perus' => $db1[0]->perusahaan_id, 'div' => $db1[0]->divisi_id]);
                }
                $msg = ['redirect' => '/alat'];
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
            // rantkps : rekan alat nopol tool kategori perusahaan sewa
            $perus = ($this->request->getVar('perusahaan') != 'all' ? $this->request->getVar('perusahaan') : '');
            $div = ($this->request->getVar('divisi') != 'all' ? $this->request->getVar('divisi') : '');
            $data = ['alat' => $this->deklarModel->getAlat($this->urls[1], '', 'pribadi', $perus, $div), 'rantkps' => '0100111', 'menu' => 'alat'];
            $msg = ['data' => view('x-file/alat_tabel', $data)];
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }
}
