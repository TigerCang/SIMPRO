<?php

namespace App\Controllers\file\aset;

use Config\App;
use App\Controllers\BaseController;
use App\Models\file\ProyekModel;

class Proyek extends BaseController
{
    protected $proyekModel;
    public function __construct()
    {
        $this->proyekModel = new ProyekModel();
    }

    // ____________________________________________________________________________________________________________________________
    public function index()
    {
        (!preg_match("/123/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $data = [
            't_menu' => lang("app.tt_proyek"), 't_submenu' => '',
            't_icon' => '<i class="fa fa-road ' . lang("app.xlist") . '"></i>',
            't_diricon' => '<i class="fa fa-sitemap"></i>', 't_dir1' => lang("app.cabangaset"), 't_dir2' => lang("app.proyek"), 't_dirac' => lang("app.proyek"), 't_link' => '/proyek',
            'perusahaan' => $this->deklarModel->getPerusahaan('', 't'),
            'wilayah' => $this->deklarModel->getDivisi('', 'wilayah', 't'),
            'btnclascr' => lang('app.btncCreate'), 'btntextcr' => lang('app.btnCreate'),
            'actcreate' => ($this->user['act_create'] == '0' ? 'hidden' : ''),
            'tuser' => $this->user, 'tmenu' => $this->menu,
        ];
        return view('file/aset/proyek_view', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function crany()
    {
        do {
            $idu = buatid();
            $db = $this->deklarModel->satuID('m_proyek', $idu);
        } while ($db);
        $this->iduModel->saveID($idu);
        return redirect()->to('/proyek/input/' . $idu);
    }

    // ____________________________________________________________________________________________________________________________
    public function showdata($idunik)
    {
        (!preg_match("/123/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $db1 = $this->deklarModel->satuID('m_proyek', $idunik, 'y');
        $ticon = ($db1 ? lang("app.xdetil") : lang("app.xinput"));
        $data = [
            't_menu' => lang("app.tt_proyek"), 't_submenu' => '',
            't_icon' => '<i class="fa fa-road ' . $ticon . '"></i>',
            't_diricon' => '<i class="fa fa-sitemap"></i>', 't_dir1' => lang("app.cabangaset"), 't_dir2' => lang("app.proyek"), 't_dirac' => lang("app.proyek"), 't_link' => '/proyek',
            'idu' => $this->iduModel->cekID($idunik), 'idunik' => $idunik,
            'perusahaan' => $this->deklarModel->getPerusahaan('', 't'),
            'wilayah' => $this->deklarModel->getDivisi('', 'wilayah', 't'),
            'divisi' => $this->deklarModel->getDivisi('', 'divisi', 't', 't'),
            'katproyek' => $this->deklarModel->getDivisi('', 'katproyek', 't'),
            'kbli1' => $this->deklarModel->satuID('m_kbli', $db1[0]->kbli_id ?? '', '', 'id', 't'),
            'propinsi1' => $this->deklarModel->satuID('m_propinsi', $db1[0]->propinsi_id ?? '', '', 'id', 't'),
            'propinsi' => $this->deklarModel->distItem('m_propinsi', 'propinsi'),
            'btnhid' => ($db1 ? 'hidden' : ''), 'btnlam' => ($db1 ? '' : 'hidden'),
            'btnclas1' => ($db1 ? lang('app.btncUpdate') : lang('app.btncSave')),
            'btntext1' => ($db1 ? lang('app.btnUpdate') : lang('app.btnSave')),
            'btnclas2' => (($db1 && $db1[0]->is_aktif == '0') ? lang('app.btncAktif') : lang('app.btncNoaktif')),
            'btntext2' => (($db1 && $db1[0]->is_aktif == '0') ? lang('app.btnAktif') : lang('app.btnNoaktif')),
            'btnsama' => ($db1 ? ($db1[0]->is_confirm == '1' ? 'disabled' : ($db1[0]->updated_by == $this->user['id'] ? 'disabled' : '')) : ''),
            'actcreate' => ($db1 ? ($this->user['act_edit'] == '0' ? 'disabled' : '') : ($this->user['act_create'] == '0' ? 'disabled' : '')),
            'actconf' => ($db1 ? ($this->user['act_confirm'] == '0' ? 'disabled hidden' : '') : 'hidden'),
            'actaktif' => ($db1 ? ($this->user['act_aktif'] == '0' ? 'disabled hidden' : '') : 'hidden'),
            'proyek' => $db1,
            'tuser' => $this->user, 'tmenu' => $this->menu,
        ];
        (empty($data['proyek']) && empty($data['idu'])) && throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        if ($data['proyek']) {
            if ($this->user['act_perusahaan'] == "0" && !preg_match("/," . $data['proyek'][0]->perusahaan_id . ",/i", $this->user['perusahaan'])) throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
            if ($this->user['act_wilayah'] == "0" && !preg_match("/," . $data['proyek'][0]->wilayah_id . ",/i", $this->user['wilayah'])) throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
            if ($this->user['act_divisi'] == "0" && !preg_match("/," . $data['proyek'][0]->divisi_id . ",/i", $this->user['divisi'])) throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        }
        if ($db1) $this->logModel->saveLog('Read', $idunik, "{$db1[0]->kode} ; {$db1[0]->paket}", '-');
        return view('file/aset/proyek_input', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function savedata()
    {
        if ($this->request->isAJAX()) {
            $db1 = $this->deklarModel->satuID('m_proyek', $this->request->getVar('idunik'));
            $savj = ($db1 ? lang("app.judulubah") : lang("app.judulsimpan"));
            $rule_kode = ($db1 ? ($db1[0]->kode != strtoupper($this->request->getVar('kode')) ? 'required|is_unique[m_proyek.kode]|min_length[10]' : 'required|min_length[10]') : 'required|is_unique[m_proyek.kode]|min_length[10]');
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
                'paket' => [
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
                'jenis' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errpilih")]
                ],
                'nikontrak' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errblank")]
                ],
                'periode1' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errblank")]
                ],
                'pelaksanaan' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errblank")]
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
                        'paket' => $this->validation->getError('paket'),
                        'perusahaan' => $this->validation->getError('idperusahaan'),
                        'wilayah' => $this->validation->getError('idwilayah'),
                        'divisi' => $this->validation->getError('iddivisi'),
                        'kbli' => $this->validation->getError('kbli'),
                        'jenis' => $this->validation->getError('jenis'),
                        'nikontrak' => $this->validation->getError('nikontrak'),
                        'periode1' => $this->validation->getError('periode1'),
                        'pelaksanaan' => $this->validation->getError('pelaksanaan'),
                        'catatan' => $this->validation->getError('catatan'),
                    ]
                ];
            } else {
                //Simpan
                if ($this->request->getVar('postaction') == 'save') {
                    $this->proyekModel->save([
                        'id' => $db1[0]->id ?? '',
                        'idunik' => $this->request->getVar('idunik'),
                        'perusahaan_id' => $this->request->getVar('idperusahaan'),
                        'wilayah_id' => $this->request->getVar('idwilayah'),
                        'divisi_id' => $this->request->getVar('iddivisi'),
                        'kode' => strtoupper($this->request->getVar('kode')),
                        'nama' => $this->request->getVar('nama'),
                        'paket' => $this->request->getVar('paket'),
                        'atasnama' => $this->request->getVar('an'),
                        'lokasi' => $this->request->getVar('lokasi'),
                        'kbli_id' => $this->request->getVar('kbli'),
                        'propinsi_id' => $this->request->getVar('kabupaten'),
                        'pemilik' => $this->request->getVar('pemilik'),
                        'scope' => $this->request->getVar('cakupan'),
                        'konsultan' => $this->request->getVar('konsultan'),
                        'asuransi' => $this->request->getVar('asuransi'),
                        'keuangan' => $this->request->getVar('keuangan'),
                        'pelaksanaan' => $this->request->getVar('pelaksanaan'),
                        'tipe_id' => $this->request->getVar('jenis'),
                        'carabayar' => $this->request->getVar('carabayar'),
                        'tgl_kontrak' => $this->request->getVar('tglkontrak'),
                        'tgl_pho' => $this->request->getVar('tglpho'),
                        'tgl_fho' => $this->request->getVar('tglfho'),
                        'ppn' => ubahseparator($this->request->getVar('ppnps')),
                        'pph' => ubahseparator($this->request->getVar('pphps')),
                        'ni_kontrak' => ubahseparator($this->request->getVar('nikontrak')),
                        'ni_tambah' => ubahseparator($this->request->getVar('nitbhkur')),
                        'ni_lain' => ubahseparator($this->request->getVar('nilain')),
                        'ni_bruto' => ubahseparator($this->request->getVar('nibruto')),
                        'ni_ppn' => ubahseparator($this->request->getVar('nippn')),
                        'ni_pph' => ubahseparator($this->request->getVar('nipph')),
                        'ni_netto' => ubahseparator($this->request->getVar('ninetto')),
                        'periode1' => $this->request->getVar('periode1'),
                        'periode2' => $this->request->getVar('periode2'),
                        'modeyear' => ($this->request->getVar('periode1') == $this->request->getVar('periode2') ? 'Single Year' : 'Multi Year'),
                        'catatan' => $this->request->getVar('catatan'),
                        'is_pajak' => ($this->request->getVar('pajak') == 'on' ? '1' : '0'),
                        'is_confirm' => $stconf,
                        'updated_by' => $this->user['id'],
                        'confirmed_by' => '0',
                    ]);
                    $db1 = $this->deklarModel->satuID('m_proyek', $this->request->getVar('idunik'));
                    $this->logModel->saveLog('Save', $this->request->getVar('idunik'), "{$db1[0]->kode} ; {$db1[0]->paket}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->kode} ; {$db1[0]->paket} {$savj}", 'perus' => $db1[0]->perusahaan_id, 'wil' => $db1[0]->wilayah_id, 'thn' => $db1[0]->periode1]);
                }
                //Konfirmasi
                if ($this->request->getVar('postaction') == 'confirm') {
                    $this->proyekModel->save(['id' => $db1[0]->id, 'is_confirm' => '1', 'confirmed_by' => $this->user['id']]);
                    $this->logModel->saveLog('Confirm', $this->request->getVar('idunik'), "{$db1[0]->kode} ; {$db1[0]->paket}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->kode} ; {$db1[0]->paket}" . lang("app.judulkonf"), 'perus' => $db1[0]->perusahaan_id, 'wil' => $db1[0]->wilayah_id, 'thn' => $db1[0]->periode1]);
                }
                //Aktifasi
                if ($this->request->getVar('postaction') == 'aktif') {
                    $akby = (($this->request->getVar('niaktif') == '0') ? $this->user['id'] : '0');
                    $savj = (($this->request->getVar('niaktif') == '0') ? lang("app.judulnoaktif") : lang("app.judulaktif"));
                    $onoff = (($this->request->getVar('niaktif') == '0') ? 'nonaktif' : 'aktif');
                    $this->proyekModel->save(['id' => $db1[0]->id, 'is_aktif' => $this->request->getVar('niaktif'), 'activated_by' => $akby]);
                    $this->logModel->saveLog('Active', $this->request->getVar('idunik'), "{$db1[0]->kode} ; {$db1[0]->paket} {$onoff}");
                    $this->session->setFlashdata(['judul' => "{$db1[0]->kode} ; {$db1[0]->paket} {$savj}", 'perus' => $db1[0]->perusahaan_id, 'wil' => $db1[0]->wilayah_id, 'thn' => $db1[0]->periode1]);
                }
                $msg = ['redirect' => '/proyek'];
            }
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }

    // ____________________________________________________________________________________________________________________________
    public function loadkabupaten()
    {
        if ($this->request->isAJAX()) {
            $skabupaten = $this->request->getvar('kabupaten');
            $kabupaten = $this->deklarModel->getKabupaten($this->request->getvar('propinsi'));
            $isikabupaten = "";
            $isikabupaten .= '<option value="">' . lang("app.pilih-") . '</option>';
            foreach ($kabupaten as $db) :
                $terpilih = "";
                if ($db->id == $skabupaten) $terpilih = 'selected';
                $isikabupaten .= "<option value='{$db->id}'" . $terpilih . ">{$db->kabupaten}</option>";
            endforeach;
            $data = ['kabupaten' => $isikabupaten];
            echo json_encode($data);
        } else {
            exit('out');
        }
    }

    // ____________________________________________________________________________________________________________________________
    public function tabeldata()
    {
        if ($this->request->isAJAX()) {
            $perus = ($this->request->getVar('perusahaan') != 'all' ? $this->request->getVar('perusahaan') : '');
            $wil = ($this->request->getVar('wilayah') != 'all' ? $this->request->getVar('wilayah') : '');
            $data = ['proyek' => $this->deklarModel->getProyek($this->urls[1], '', $perus, $wil, $this->request->getVar('tahun'))];
            $msg = ['data' => view('x-file/proyek_tabel', $data)];
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }
}
