<?php

namespace App\Controllers\kas;

use Config\App;
use App\Controllers\BaseController;
use App\Models\kas\KasindukModel;
use App\Models\kas\KasanakModel;
use App\Models\kas\KasdetilModel;

class Kaspindah extends BaseController
{
    protected $kasindukModel;
    protected $kasanakModel;
    protected $kasdetilModel;

    public function __construct()
    {
        $this->kasindukModel = new KasindukModel();
        $this->kasanakModel = new KasanakModel();
        $this->kasdetilModel = new KasdetilModel();
    }

    // ____________________________________________________________________________________________________________________________
    public function index()
    {
        // if (!preg_match("/122/i", session()->menu->menu_1))
        //     throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();

        $data = [
            't_menu' => lang("app.tt_kaspindah"),
            't_submenu' => '',
            't_icon' => '<i class="fa fa-money ' . lang("app.xlist") . '"></i>',
            't_diricon' => '<i class="fa fa-money"></i>',
            't_dir1' => lang("app.mintakas"),
            't_dirac' => lang("app.kaspindah"),
            'perusahaan' => $this->deklarModel->getPerusahaan('1'),
            'wilayah' => $this->deklarModel->getDivisi('wilayah', '1'),
            'divisi' => $this->deklarModel->getDivisi('divisi', '1'),
            'menu' => 'kaspindah',
            'pesan' => '0',
            'peminta' => session()->username,
            'tuser' => $this->user,
        ];

        return view('kas/mintakas_view', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function crany()
    {
        ulang1:
        $idu = buatid('60');
        $db = $this->deklarModel->cekID('kas_induk', $idu);
        if (!empty($db)) {
            goto ulang1;
        }
        $this->iduModel->saveID($idu);
        return redirect()->to('/kaspindah/input/' . $idu);
    }

    // ____________________________________________________________________________________________________________________________
    public function showdata($idunik)
    {
        // if (!preg_match("/122/i", session()->menu->menu_1))
        // throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();

        $db1 = $this->deklarModel->satuID('kas_induk', '', $idunik, '1');
        ((!empty($db1)) && ($db1['0']->norevisi != '0')) ? $ticon = '<i class="fa fa-money ' . lang("app.xdetil") . '"></i>' : $ticon = '<i class="fa fa-money ' . lang("app.xinput") . '"></i>';
        ((!empty($db1)) && ($db1['0']->norevisi != '0')) ? $revisi = "y" : $revisi = "n";
        (!empty($db1)) ? $cabang = $db1['0']->cabang_id : $cabang = '';
        (!empty($db1)) ? $penerima = $db1['0']->penerima_id : $penerima = '';
        (!empty($db1)) ? $induk = $db1['0']->id : $induk = '';
        $anak = $this->tranModel->getKasanak($induk);
        (empty($anak)) ? $akun = '' : $akun = $anak['0']->akun_id;

        $kbli = "";
        $norevisi = '0';
        if (!empty($db1)) {
            $dbkbli = $this->tranModel->getKasanak($db1['0']->id);
            $kbli = $dbkbli['0']->kbli_id;

            //     $dbrev = $this->customModel->cariRevisikas($idunik);
            //     if ($db['0']->nrev == '0') { // jika belum masuk proses 
            //         $norevisi = $dbrev['0']->norevisi;
            //     } else {
            //         $norevisi = $dbrev['0']->norevisi + 1;
            //     }
        }
        $data = [
            't_menu' => lang("app.tt_kaspindah"),
            't_submenu' => '',
            't_icon' => $ticon,
            't_diricon' => '<i class="fa fa-money"></i>',
            't_dir1' => lang("app.mintakas"),
            't_dirac' => lang("app.kaspindah"),
            'idu' => $this->iduModel->cekID($idunik),
            'idunik' => $idunik,
            'perusahaan' => $this->deklarModel->getPerusahaan('1'),
            'wilayah' => $this->deklarModel->getDivisi('wilayah', '1'),
            'divisi' => $this->deklarModel->getDivisi('divisi', '1'),
            'nodoc' => $this->deklarModel->cekForm('dokumen', 'kaspindah', '1', '', '', ''),
            'minta' => $this->tranModel->getKasinduk($idunik),
            'anak' => $this->tranModel->getKasanak($induk),
            'selnama' => $this->deklarModel->distSelect('beban'),
            'proyek1' => $this->deklarModel->satuID('m_proyek', '1', $cabang),
            'camp1' => $this->deklarModel->satuID('m_camp', '1', $cabang),
            'alat1' => $this->deklarModel->satuID('m_alat', '1', $cabang),
            'tanah1' => $this->deklarModel->satuID('m_tanah', '1', $cabang),
            'penerima1' => $this->deklarModel->satuID('m_penerima', '1', $penerima),
            'kbli1' => $this->deklarModel->satuID('m_kbli', '1', $kbli),
            'akun1' => $this->deklarModel->satuID('m_akun', '1', $akun),
            'norevisi' => $norevisi,
            'revisi' => $revisi,
            'menu' => 'kaspindah',
            'tuser' => $this->user,
            'validation' => \config\Services::validation()
        ];

        if ((empty($data['nodoc'])) || (empty($data['minta']) && (empty($data['idu'])))) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
        return view('kas/kaspindah_input', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function savedata()
    {
        if ($this->request->isAJAX()) {
            $validation = \config\Services::validation();

            //status 0 belum sama antara peminta dan penginput
            $status = '1';
            $rule_akses = 'permit_empty';
            if (session()->username != $this->request->getVar('userid')) {
                $status = '0';
                $peminta = $this->deklarModel->getUser($this->request->getVar('userid'));
                $perush = $this->request->getVar('idperusahaan');
                $wil = $this->request->getVar('idwilayah');
                $div = $this->request->getVar('iddivisi');
                $cab = $this->request->getVar('idbeban');
                $error = "0";

                if (empty($peminta)) {
                    $error = "1";
                    goto err1;
                }
                if (($peminta['0']->akses_perusahaan == "0") && (!preg_match("/,$perush,/i", $peminta['0']->perusahaan))) {
                    $error = "1";
                    goto err1;
                }
                if (($peminta['0']->akses_wilayah == "0") && (!preg_match("/,$wil,/i", $peminta['0']->wilayah))) {
                    $error = "1";
                    goto err1;
                }
                if (($peminta['0']->akses_divisi == "0") && (!preg_match("/,$div,/i", $peminta['0']->divisi))) {
                    $error = "1";
                    goto err1;
                }

                switch ($this->request->getVar('xpilihan')) {
                    case 'proyek':
                        if (($peminta['0']->akses_proyek == "0") && (!preg_match("/,$cab,/i", $peminta['0']->proyek))) {
                            $error = "1";
                            goto err1;
                        }
                        break;
                    case 'camp':
                        if (($peminta['0']->akses_camp == "0") && (!preg_match("/,$cab,/i", $peminta['0']->camp))) {
                            $error = "1";
                            goto err1;
                        }
                        break;
                    case 'alat':
                        if (($peminta['0']->akses_alat == "0") && (!preg_match("/,$cab,/i", $peminta['0']->alat))) {
                            $error = "1";
                            goto err1;
                        }
                        break;
                    case 'tanah':
                        if (($peminta['0']->akses_aset == "0") && (!preg_match("/,$cab,/i", $peminta['0']->aset))) {
                            $error = "1";
                            goto err1;
                        }
                        break;
                }
                err1:
                if ($error == "1") {
                    $rule_akses = 'required';
                }
            }

            if (!$this->validate([
                'idperusahaan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => lang("app.errpilih"),
                    ]
                ],
                'idwilayah' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => lang("app.errpilih"),
                    ]
                ],
                'iddivisi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => lang("app.errpilih"),
                    ]
                ],
                'xpilihan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => lang("app.errpilih"),
                    ]
                ],
                'userid' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => lang("app.errblank"),
                    ]
                ],
                'akses' => [
                    'rules' => $rule_akses,
                    'errors' => [
                        'required' => lang("app.errnoakses"),
                    ]
                ],
                'beban' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => lang("app.errblank"),
                    ]
                ],
                'penerima' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => lang("app.errblank"),
                    ]
                ],
                'noakun' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => lang("app.errpilih"),
                    ]
                ],
                'vtotal' => [
                    'rules' => 'required|greater_than_equal_to[1]',
                    'errors' => [
                        'required' => lang("app.errblank"),
                        'greater_than_equal_to' => lang("app.err0"),
                    ]
                ],
                'catatan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => lang("app.errblank"),
                    ]
                ],
            ])) {
                $msg = [
                    'error' => [
                        'akses' => $validation->getError('akses'),
                        'perusahaan' => $validation->getError('idperusahaan'),
                        'wilayah' => $validation->getError('idwilayah'),
                        'divisi' => $validation->getError('iddivisi'),
                        'pilihan' => $validation->getError('xpilihan'),
                        'userid' => $validation->getError('userid'),
                        'beban' => $validation->getError('beban'),
                        'penerima' => $validation->getError('penerima'),
                        'noakun' => $validation->getError('noakun'),
                        'vtotal' => $validation->getError('vtotal'),
                        'catatan' => $validation->getError('catatan'),
                    ]
                ];
            } else {
                $nomordokumen = $this->request->getVar('nodoc');
                if ($this->request->getVar('nodoc') == "") {
                    $db = $this->tranModel->getNomordoc('kas_induk', $this->request->getVar('kui'), "-" . substr($this->request->getVar('tanggal'), 2, 2));
                    (empty($db['0']->nodoc)) ? $nomor = "1" : $nomor = substr($db['0']->nodoc, -4) + 1;
                    $nomordokumen = nodokumen($this->request->getVar('kui'), $this->request->getVar('tanggal'), $nomor);
                }
                $kasinduk1 = $this->deklarModel->satuID('kas_induk', '', $this->request->getVar('idunik'), '1');
                if (empty($kasinduk1)) {
                    $this->kasindukModel->save([
                        'idunik' =>  $this->request->getVar('idunik'),
                        'perusahaan_id' => $this->request->getVar('idperusahaan'),
                        'wilayah_id' => $this->request->getVar('idwilayah'),
                        'divisi_id' => $this->request->getVar('iddivisi'),
                        'userid' => session()->username,
                        'peminta' => $this->request->getVar('userid'),
                        'nodoc' => $nomordokumen,
                        'tgl_minta' => $this->request->getVar('tanggal'),
                        'norevisi' => $this->request->getVar('norev'),
                        'pilihan' => $this->request->getVar('xpilihan'),
                        'cabang_id' => $this->request->getVar('idbeban'),
                        'penerima_id' => $this->request->getVar('penerima'),
                        'level_aw' => $this->request->getVar('xlevel'),
                        'level_pos' => $this->request->getVar('xlevel'),
                        'asal' => 'kaspindah',
                        'jenis' => 'ju',
                        'status' => $status,
                    ]);
                    $kasin1 = $this->deklarModel->satuID('kas_induk', '', $this->request->getVar('idunik'), '1');
                    $this->kasanakModel->save([
                        'kasinduk_id' => $kasin1['0']->id,
                        'akun_id' => $this->request->getVar('noakun'),
                        'jumlah' => ubahkoma($this->request->getVar('jumlah')),
                        'harga' => ubahkoma($this->request->getVar('harga')),
                        'debit' => ubahkoma($this->request->getVar('total')),
                        'catatan' => $this->request->getVar('catatan'),
                        'status' => '1',
                    ]);
                } else {
                    $this->kasindukModel->save([
                        'id' => $kasinduk1['0']->id,
                        'cabang_id' => $this->request->getVar('idbeban'),
                        'level_pos' => $this->request->getVar('level'),
                        'penerima_id' => $this->request->getVar('penerima'),
                    ]);
                    $kasan1 = $this->tranModel->getKasanak($kasinduk1['0']->id);
                    $this->kasanakModel->save([
                        'id' =>  $kasan1['0']->id,
                        'akun_id' => $this->request->getVar('noakun'),
                        'jumlah' => ubahkoma($this->request->getVar('jumlah')),
                        'harga' => ubahkoma($this->request->getVar('harga')),
                        'debit' => ubahkoma($this->request->getVar('total')),
                        'catatan' => $this->request->getVar('catatan'),
                        'status' => '1',
                    ]);
                }

                // if ($this->request->getVar('norev') != "0") {
                //     $this->tranModel->updateRevisi('kas_beban', $this->request->getVar('idunik'), $this->request->getVar('norev'));
                //     $this->tranModel->updateLogaksi($this->request->getVar('nodoc'));
                // }

                $msg = [
                    'sukses' => lang("app.inputdata") . ' ' . $nomordokumen . ' ' . lang("app.sukses"),
                    'judul' => lang("app.mintajudul"),
                    'nodoc' => $nomordokumen,
                ];
            }
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }

    // ____________________________________________________________________________________________________________________________
    public function modallampiran()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'idunik' => $this->request->getVar('idunik'),
            ];
            $msg = [
                'data' => view('x-modal/input_kaspindah', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }
    public function savelampiran()
    {
        if ($this->request->isAJAX()) {
            $validation = \config\Services::validation();
            $idkasinduk = $this->deklarModel->satuID('kas_induk', '', $this->request->getVar('midunik'), '1');
            (empty($idkasinduk)) ? $rule_data = 'required' : $rule_data = 'permit_empty';

            if (!$this->validate([
                'noakun2' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => lang("app.errpilih"),
                    ]
                ],
                'totalv2' => [
                    'rules' => 'required|greater_than_equal_to[1]',
                    'errors' => [
                        'required' => lang("app.errblank"),
                        'greater_than_equal_to' => lang("app.err0"),
                    ]
                ],
                'catatan2' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => lang("app.errblank"),
                    ]
                ]
            ])) {
                $msg = [
                    'error' => [
                        'mnoakun' => $validation->getError('noakun2'),
                        'mtotal' => $validation->getError('totalv2'),
                        'mcatatan' => $validation->getError('catatan2'),
                    ]
                ];
            } else {
                $kasin1 = $this->deklarModel->satuID('kas_induk', '', $this->request->getVar('midunik'), '1');
                $this->kasdetilModel->save([
                    'kasinduk_id' => $kasin1['0']->id,
                    'biaya_id' => $this->request->getVar('noakun2'),
                    'debit' => ubahkoma($this->request->getVar('total2')),
                    'catatan' => $this->request->getVar('catatan2'),
                ]);

                $akun1 = $this->deklarModel->satuID('m_akun', '1', $this->request->getVar('noakun2'));
                $msg = [
                    'sukses' => lang("app.simpandata") . ' ' . $akun1['0']->noakun . ' ' . lang("app.sukses"),
                    'judul' => lang("app.simpanjudul"),
                ];
            }
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }

    // ____________________________________________________________________________________________________________________________
    public function canceldokumen($idunik)
    {
        $db = $this->tranModel->getKasinduk($idunik);
        if (empty(!$db)) {
            $this->kasindukModel->save([
                'id' => $db['0']->id,
                'status' => '5',
            ]);

            $this->logModel->saveLog('/kaspindah', $db['0']->id, 'Cancel', $db['0']->nodoc);
            session()->setflashdata('judul', lang("app.bataljudul"));
            session()->setflashdata('pesan', lang("app.bataldoc") . ' ' . $db['0']->nodoc . ' ' . lang("app.sukses"));
            session()->setflashdata('perus', $db['0']->perusahaan_id);
            session()->setflashdata('div', $db['0']->divisi_id);
        }
        return redirect()->to('/kaspindah');
    }

    // ____________________________________________________________________________________________________________________________
    public function deletelampiran()
    {
        if ($this->request->isAJAX()) {
            $validation = \config\Services::validation();

            $id = $this->request->getVar('id');
            $this->kasdetilModel->delete($id);

            $msg = [
                'sukses' => lang("app.delitem") . ' ' . $this->request->getVar('akun') . ' ' . lang("app.sukses"),
                'judul' => lang("app.deljudul"),
            ];
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }
}
