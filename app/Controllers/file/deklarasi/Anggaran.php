<?php

namespace App\Controllers\file\deklarasi;

use Config\App;
use App\Controllers\BaseController;
use App\Models\file\AnggaranModel;

class Anggaran extends BaseController
{
    protected $anggaranModel;
    public function __construct()
    {
        $this->anggaranModel = new AnggaranModel();
    }

    // ____________________________________________________________________________________________________________________________
    public function index()
    {
        (!preg_match("/153/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $data = [
            't_menu' => lang("app.tt_anggaranbawaan"), 't_submenu' => '',
            't_icon' => '<i class="fa fa-calculator ' . lang("app.xlist") . '"></i>',
            't_diricon' => '<i class="fa fa-map-signs"></i>', 't_dir1' => lang("app.deklar"), 't_dirac' => lang("app.anggaranbawaan"), 't_link' => '/anggaran',
            'anggaran' => $this->deklarModel->getAnggaran($this->urls[1]),
            'btnclascr' => lang('app.btncCreate'), 'btntextcr' => lang('app.btnCreate'),
            'actcreate' => ($this->user['act_create'] == '0' ? 'hidden' : ''),
            'tuser' => $this->user, 'tmenu' => $this->menu,
        ];
        return view('file/deklarasi/anggaran_view', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function crany()
    {
        do {
            $idu = buatid();
            $db = $this->deklarModel->satuID('m_anggaran', $idu);
        } while ($db);
        $this->iduModel->saveID($idu);
        return redirect()->to('/anggaran/input/' . $idu);
    }

    // ____________________________________________________________________________________________________________________________
    public function showdata($idunik)
    {
        (!preg_match("/153/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $db1 = $this->deklarModel->satuID('m_anggaran', $idunik, 'y');
        $ticon = (($db1 && $db1[0]->is_confirm == '1') ? lang("app.xdetil") : lang("app.xinput"));
        $data = [
            't_menu' => lang("app.tt_anggaranbawaan"), 't_submenu' => '',
            't_icon' => '<i class="fa fa-calculator ' . $ticon . '"></i>',
            't_diricon' => '<i class="fa fa-map-signs"></i>', 't_dir1' => lang("app.deklar"), 't_dirac' => lang("app.anggaranbawaan"), 't_link' => '/anggaran',
            'idu' => $this->iduModel->cekID($idunik), 'idunik' => $idunik,
            'selnama' => $this->deklarModel->distSelect('beban'),
            'selanggaran' => $this->deklarModel->distSelect('setanggaran'),
            'kategori' => $this->deklarModel->distBiayalv1('btlangsung'),
            'btnclas2' => (($db1 && $db1[0]->is_aktif == '0') ? lang('app.btncAktif') : lang('app.btncNoaktif')),
            'btntext2' => (($db1 && $db1[0]->is_aktif == '0') ? lang('app.btnAktif') : lang('app.btnNoaktif')),
            'btnsama' => ($db1 ? ($db1[0]->is_confirm == '1' ? 'disabled' : ($db1[0]->updated_by == $this->user['id'] ? 'disabled' : '')) : ''),
            'actcreate' => ($this->user['act_create'] == '0' ? 'disabled' : ''),
            'actconf' => ($db1 ? ($this->user['act_confirm'] == '0' ? 'disabled hidden' : '') : 'disabled hidden'),
            'actaktif' => ($db1 ? ($this->user['act_aktif'] == '0' ? 'disabled hidden' : '') : 'disabled hidden'),
            'btnbaru' => (($db1 && $db1[0]->is_confirm == '3') ? 'disabled hidden' : ''),
            'anggaran' => $db1,
            'tuser' => $this->user, 'tmenu' => $this->menu,
        ];
        (empty($data['anggaran']) && empty($data['idu'])) && throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        if ($db1) $this->logModel->saveLog('Read', $idunik, "{$db1[0]->pilihan} ; {$db1[0]->tujuan}", '-');
        return view('file/deklarasi/anggaran_input', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function tambahdata()
    {
        if ($this->request->isAJAX()) {
            $idunik = $this->request->getVar('idunik');
            $pilihan = $this->request->getVar('xpilih');
            $tujuan = $this->request->getVar('xtujuan');
            $jenis = $this->request->getVar('xjenis');
            $cekanggaran = $this->deklarModel->cekAnggaran('', 'objek', $pilihan, $tujuan, $jenis);
            $rule_akses = ($cekanggaran && $cekanggaran[0]->idunik == $idunik) ? 'permit_empty' : 'required';
            if (!$cekanggaran) $rule_akses = 'permit_empty';
            $rule_biaya = ($this->request->getVar('xtujuan') == 'proyek' ? 'required' : 'permit_empty');
            $rule_akun = ($this->request->getVar('xtujuan') != 'proyek' ? 'required' : 'permit_empty');
            $rule_pilih = (($this->request->getVar('xtujuan') == 'proyek' && $this->request->getVar('xpilih') == 'pendapatan') ? 'valid_email' : 'required');
            $rule_jenis = ($tujuan == 'proyek' ? 'required' : 'permit_empty');

            $validationRules = [
                'akses' => [
                    'rules' => $rule_akses,
                    'errors' => ['required' => lang("app.errunik2")]
                ],
                'xpilih' => [
                    'rules' => $rule_pilih,
                    'errors' => ['required' => lang("app.errpilih"), 'valid_email' => lang("app.errunik3")]
                ],
                'xtujuan' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errpilih")]
                ],
                'xjenis' => [
                    'rules' => $rule_jenis,
                    'errors' => ['required' => lang("app.errpilih")]
                ],
                'biaya' => [
                    'rules' => $rule_biaya,
                    'errors' => ['required' => lang("app.errpilih")]
                ],
                'akun' => [
                    'rules' => $rule_akun,
                    'errors' => ['required' => lang("app.errpilih")]
                ],
                'total' => [
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
                        'akses' => $this->validation->getError('akses'),
                        'pilih' => $this->validation->getError('xpilih'),
                        'tujuan' => $this->validation->getError('xtujuan'),
                        'jenis' => $this->validation->getError('xjenis'),
                        'biaya' => $this->validation->getError('biaya'),
                        'akun' => $this->validation->getError('akun'),
                        'total' => $this->validation->getError('total'),
                        'catatan' => $this->validation->getError('catatan'),
                    ]
                ];
            } else {
                $total = ubahseparator($this->request->getVar('total'));
                $this->anggaranModel->save([
                    'idunik' =>  $idunik,
                    'pilihan' => $pilihan,
                    'tujuan' => $tujuan,
                    'jenis' => $jenis,
                    'biaya_id' => $this->request->getVar('biaya'),
                    'akun_id' => $this->request->getVar('akun'),
                    'bulan' => ubahseparator($this->request->getVar('bulan')),
                    'jumlah' => ubahseparator($this->request->getVar('jumlah')),
                    'harga' =>  ubahseparator($this->request->getVar('harga')),
                    'total' => $total,
                    'catatan' => $this->request->getVar('catatan'),
                ]);

                $nfield = ($tujuan == 'proyek' ? 'biaya' : 'akun');
                $nid = ($tujuan == 'proyek' ? 'biaya_id' : 'akun_id');
                $db4 = $this->deklarModel->getIndukbiaya($nfield, $this->request->getVar($nfield));
                $ceklev3 = $this->deklarModel->cekAnggaran($idunik, $nfield, $nid, $db4[0]->idlev3);
                if ($ceklev3) {
                    $total3 = $this->deklarModel->anggaranTotal($idunik, $db4[0]->idlev3, $nfield);
                    $this->anggaranModel->save(['id' => $ceklev3[0]->id, 'total' => $total3[0]->subtotal]);
                    $this->deklarModel->updateDeletedat('m_anggaran', $ceklev3[0]->id);
                } else {
                    $this->anggaranModel->save([
                        'idunik' =>  $idunik,
                        'pilihan' => $pilihan,
                        'tujuan' => $tujuan,
                        'jenis' => $jenis,
                        $nid => $db4[0]->idlev3,
                        'total' => $total,
                    ]);
                }

                $ceklev2 = $this->deklarModel->cekAnggaran($idunik, $nfield, $nid, $db4[0]->idlev2);
                if ($ceklev2) {
                    $total2 = $this->deklarModel->anggaranTotal($idunik, $db4[0]->idlev2, $nfield);
                    $this->anggaranModel->save(['id' => $ceklev2[0]->id, 'total' => $total2[0]->subtotal]);
                    $this->deklarModel->updateDeletedat('m_anggaran', $ceklev2[0]->id);
                } else {
                    $this->anggaranModel->save([
                        'idunik' =>  $idunik,
                        'pilihan' => $pilihan,
                        'tujuan' => $tujuan,
                        'jenis' => $jenis,
                        $nid => $db4[0]->idlev2,
                        'total' => $total,
                    ]);
                }

                $ceklev1 = $this->deklarModel->cekAnggaran($idunik, $nfield, $nid, $db4[0]->idlev1);
                if ($ceklev1) {
                    $total1 = $this->deklarModel->anggaranTotal($idunik, $db4[0]->idlev1, $nfield);
                    $this->anggaranModel->save(['id' => $ceklev1[0]->id, 'total' => $total1[0]->subtotal]);
                    $this->deklarModel->updateDeletedat('m_anggaran', $ceklev1[0]->id);
                } else {
                    $this->anggaranModel->save([
                        'idunik' =>  $idunik,
                        'pilihan' => $pilihan,
                        'tujuan' => $tujuan,
                        'jenis' => $jenis,
                        $nid => $db4[0]->idlev2,
                        'total' => $total,
                        'levsatu' => '1',
                    ]);
                }
                $this->deklarModel->updateData('m_anggaran', 'tujuan', $tujuan, 'idunik', $idunik);
                $this->deklarModel->updateData('m_anggaran', 'is_confirm', '3', 'idunik', $idunik);
                $this->deklarModel->updateData('m_anggaran', 'confirmed_by', '0', 'idunik', $idunik);
                $msg = ['sukses' => "{$db4[0]->nama}" . lang("app.judultambah")];
            }
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }

    // ____________________________________________________________________________________________________________________________
    public function modaldata()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getvar('id');
            $db = $this->deklarModel->satuID('m_anggaran', $id, '', 'id');
            $data = [
                'anggaran' => $db,
                'biaya1' => $this->deklarModel->satuID('m_biaya', $db[0]->biaya_id, '', 'id'),
                'akun1' => $this->deklarModel->satuID('m_akun', $db[0]->akun_id, '', 'id'),
            ];
            $msg = ['data' => view('x-modal/koreksi_anggaran', $data)];
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }

    // ____________________________________________________________________________________________________________________________
    public function savedata()
    {
        if ($this->request->isAJAX()) {
            $idunik = $this->request->getVar('idunik');
            $db1 = $this->deklarModel->satuID('m_anggaran', $idunik);
            $rule_akses = ($db1 ? 'permit_empty' : 'required');
            $validationRules = [
                'akses' => [
                    'rules' => $rule_akses,
                    'errors' => ['required' => lang("app.errunik2")]
                ],
            ];

            if (!$this->validate($validationRules)) {
                $msg = ['error' => ['akses' => $this->validation->getError('akses')]];
            } else {
                $akby = (($this->request->getVar('niaktif') == '0') ? $this->user['id'] : '0');
                $savj = (($this->request->getVar('niaktif') == '0') ? lang("app.judulnoaktif") : lang("app.judulaktif"));
                $onoff = (($this->request->getVar('niaktif') == '0') ? 'nonaktif' : 'aktif');
                if ($this->request->getVar('postaction') == 'save') {
                    $this->deklarModel->updateData('m_anggaran', 'is_confirm', '0', 'idunik', $idunik);
                    $this->deklarModel->updateData('m_anggaran', 'updated_by', $this->user['id'], 'idunik', $idunik);
                    $this->deklarModel->updateData('m_anggaran', 'confirmed_by', '0', 'idunik', $idunik);
                    $this->logModel->saveLog('Save', $idunik, "{$this->request->getVar('xpilih')} ; {$this->request->getVar('xtujuan')}");
                    session()->setFlashdata('judul', lang('app.' . $this->request->getVar('xpilih')) . ' ; ' . lang('app.' . $this->request->getVar('xtujuan')) . ' ' . lang("app.judulsimpan"));
                } elseif ($this->request->getVar('postaction') == 'confirm') {
                    $this->deklarModel->updateData('m_anggaran', 'is_confirm', '1', 'idunik', $idunik);
                    $this->deklarModel->updateData('m_anggaran', 'confirmed_by', $this->user['id'], 'idunik', $idunik);
                    $this->logModel->saveLog('Confirm', $idunik, "{$this->request->getVar('xpilih')} ; {$this->request->getVar('xtujuan')}");
                    session()->setFlashdata('judul', lang('app.' . $this->request->getVar('xpilih')) . ' ; ' . lang('app.' . $this->request->getVar('xtujuan')) . ' ' . lang("app.judulkonf"));
                } elseif ($this->request->getVar('postaction') == 'aktif') {
                    $this->deklarModel->updateData('m_anggaran', 'is_aktif', $this->request->getVar('niaktif'), 'idunik', $idunik);
                    $this->deklarModel->updateData('m_anggaran', 'activated_by', $akby, 'idunik', $idunik);
                    $this->logModel->saveLog('Active', $idunik, "{$this->request->getVar('xpilih')} ; {$this->request->getVar('xtujuan')} {$onoff}");
                    session()->setFlashdata('judul', lang('app.' . $this->request->getVar('xpilih')) . ' ; ' . lang('app.' . $this->request->getVar('xtujuan')) . ' ' . lang("app.judulkonf") . ' ' . $savj);
                }
                $msg = ['redirect' => '/anggaran'];
            }
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }

    // ____________________________________________________________________________________________________________________________
    public function tabelbudget()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'anggaran' => $this->deklarModel->getAnggaran('', '0', $this->request->getVar('idunik'), $this->request->getVar('tujuan')), 'tujuan' => $this->request->getVar('xtujuan'),
                'ada' => $this->request->getVar('ada'),
            ];
            $msg = ['data' => view('x-file/anggaran_tabel', $data)];
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }

    // ____________________________________________________________________________________________________________________________
    public function updatedata()
    {
        if ($this->request->isAJAX()) {
            $tujuan = $this->request->getVar('mtujuan');
            $idunik = $this->request->getVar('midunik');

            $validationRules = [
                'mcatatan' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errblank")]
                ],
            ];
            if (!$this->validate($validationRules)) {
                $msg = ['error' => ['mcatatan' => $this->validation->getError('mcatatan')]];
            } else {
                $ntabel = ($this->request->getVar('mtujuan') == 'proyek' ? 'm_biaya' : 'm_akun');
                $nfield = ($tujuan == 'proyek' ? 'biaya' : 'akun');
                $nid = ($this->request->getVar('mtujuan') == 'proyek' ? 'biaya_id' : 'akun_id');
                $this->anggaranModel->save([
                    'id' => $this->request->getVar('mid'),
                    'bulan' => ubahseparator($this->request->getVar('mbulan')),
                    'jumlah' => ubahseparator($this->request->getVar('mjumlah')),
                    'harga' =>  ubahseparator($this->request->getVar('mharga')),
                    'total' => ubahseparator($this->request->getVar('mtotal')),
                    'catatan' => $this->request->getVar('mcatatan'),
                ]);
                $dbu = $this->deklarModel->satuID('m_anggaran', $idunik);
                // $stconf = (($dbu && $dbu[0]->is_confirm != 'off') ? 'onoff' : 'off');
                // $this->deklarModel->updateData('m_anggaran', 'is_confirm', $stconf, 'idunik', $idunik);
                $db4 = $this->deklarModel->satuID($ntabel, $this->request->getVar('mitem'), '', 'id');
                $item = ($tujuan == 'proyek') ? $db4[0]->kode : $db4[0]->noakun;
                // 
                $db3 = $this->deklarModel->satuID($ntabel, $db4[0]->induk_id, '', 'id');
                $ceklev3 = $this->deklarModel->cekAnggaran($idunik, $nfield, $nid, $db3[0]->id);
                $total3 = $this->deklarModel->anggaranTotal($idunik, $db3[0]->id, $nfield);
                $this->anggaranModel->save(['id' => $ceklev3[0]->id, 'total' => $total3[0]->subtotal]);
                // 
                $db2 = $this->deklarModel->satuID($ntabel, $db3[0]->induk_id, '', 'id');
                $ceklev2 = $this->deklarModel->cekAnggaran($idunik, $nfield, $nid, $db2[0]->id);
                $total2 = $this->deklarModel->anggaranTotal($idunik, $db2[0]->id, $nfield);
                $this->anggaranModel->save(['id' => $ceklev2[0]->id, 'total' => $total2[0]->subtotal]);
                // 
                $db1 = $this->deklarModel->satuID($ntabel, $db2[0]->induk_id, '', 'id');
                $ceklev1 = $this->deklarModel->cekAnggaran($idunik, $nfield, $nid, $db1[0]->id);
                $total1 = $this->deklarModel->anggaranTotal($idunik, $db1[0]->id, $nfield);
                $this->anggaranModel->save(['id' => $ceklev1[0]->id, 'total' => $total1[0]->subtotal]);
                $msg = ['sukses' => "{$item}" . lang("app.judulubah")];
            }
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }

    // ____________________________________________________________________________________________________________________________
    public function deletedata()
    {
        if ($this->request->isAJAX()) {
            die;
            $id = $this->request->getVar('id');
            $dbu = $this->deklarModel->satuID('m_anggaran', $id, '', 'id');
            $idunik = $dbu[0]->idunik;
            $stconf = (($dbu && $dbu[0]->is_confirm != 'off') ? 'onoff' : 'off');

            // $pilihan = $dbu[0]->pilihan;
            $tujuan = $dbu[0]->tujuan;
            // $jenis = $dbu[0]->idunik;


            $total = ubahseparator($this->request->getVar('total'));
            $nfield = ($tujuan == 'proyek' ? 'biaya' : 'akun');
            $ntabel = ($tujuan == 'proyek' ? 'm_biaya' : 'm_akun');
            $nid = ($tujuan == 'proyek' ? 'biaya_id' : 'akun_id');
            $nitem = ($tujuan == 'proyek' ? $dbu[0]->biaya_id : $dbu[0]->akun_id);


            // $this->deklarModel->updateData('m_anggaran', 'is_confirm', $stconf, 'idunik', $idunik);
            // $this->anggaranModel->delete($id);

            $db4 = $this->deklarModel->satuID($ntabel, $nitem, '', 'id');
            $item = ($tujuan == 'proyek') ? $db4[0]->kode : $db4[0]->noakun;

            var_dump($tujuan, $nfield, $ntabel, $id, $nitem, $item);
            die;

            // 
            $db3 = $this->deklarModel->satuID($ntabel, $db4[0]->induk_id, '', 'id');
            $ceklev3 = $this->deklarModel->cekAnggaran($idunik, $nfield, $nid, $db3[0]->id);
            $total3 = $this->deklarModel->anggaranTotal($idunik, $db3[0]->id, $nfield);
            $this->anggaranModel->save(['id' => $ceklev3[0]->id, 'total' => $total3[0]->subtotal]);
            $this->deklarModel->updateDeletedat('m_anggaran', $ceklev3[0]->id);
            // 
            $db2 = $this->deklarModel->satuID($ntabel, $db3[0]->induk_id, '', 'id');
            $ceklev2 = $this->deklarModel->cekAnggaran($idunik, $nfield, $nid, $db2[0]->id);
            $total2 = $this->deklarModel->anggaranTotal($idunik, $db2[0]->id, $nfield);
            $this->anggaranModel->save(['id' => $ceklev2[0]->id, 'total' => $total2[0]->subtotal]);
            $this->deklarModel->updateDeletedat('m_anggaran', $ceklev2[0]->id);
            // 
            $db1 = $this->deklarModel->satuID($ntabel, $db2[0]->induk_id, '', 'id');
            $ceklev1 = $this->deklarModel->cekAnggaran($idunik, $nfield, $nid, $db1[0]->id);
            $total1 = $this->deklarModel->anggaranTotal($idunik, $db1[0]->id, $nfield);
            $this->anggaranModel->save(['id' => $ceklev1[0]->id, 'total' => $total1[0]->subtotal]);
            $this->deklarModel->updateDeletedat('m_anggaran', $ceklev1[0]->id);

            $msg = ['sukses' => $this->request->getVar('kode') . ' ' . lang("app.judulhapus")];
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }
}
