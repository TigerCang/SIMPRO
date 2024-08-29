<?php

namespace App\Controllers\file\sdm;

use Config\App;
use App\Controllers\BaseController;
use App\Models\file\KalenderModel;

class Kalender extends BaseController
{
    protected $kalenderModel;
    public function __construct()
    {
        $this->kalenderModel = new KalenderModel();
    }

    // ____________________________________________________________________________________________________________________________
    public function index()
    {
        (!preg_match("/148/i", $this->menu['menu_1'])) && throw \CodeIgniter\Security\Exceptions\SecurityException::forDisallowedAction();
        $data = [
            't_menu' => lang("app.tt_kalenderlibur"), 't_submenu' => '',
            't_icon' => '<i class="fa fa-calendar ' . lang("app.xlist") . '"></i>',
            't_diricon' => '<i class="icofont icofont-support"></i>', 't_dir1' => lang("app.sdm"), 't_dirac' => lang("app.kalender"), 't_link' => '/kalender',
            'btnclascr' => lang('app.btncCreate'), 'btntextcr' => lang('app.btnCreate'),
            'actcreate' => ($this->user['act_create'] == '0' ? 'hidden' : ''),
            'tuser' => $this->user, 'tmenu' => $this->menu,
        ];
        return view('file/sdm/kalender_view', $data);
    }

    // ____________________________________________________________________________________________________________________________
    public function modaldata()
    {
        if ($this->request->isAJAX()) {
            $msg = ['data' => view('x-modal/input_kalender')];
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }

    // ____________________________________________________________________________________________________________________________
    public function savedata()
    {
        if ($this->request->isAJAX()) {
            $validationRules = [
                'tanggalaw' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errblank")]
                ],
                'nama' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errblank")]
                ],
            ];
            if (!$this->validate($validationRules)) {
                $msg = [
                    'error' => [
                        'tanggalaw' => $this->validation->getError('tanggalaw'),
                        'nama' => $this->validation->getError('nama'),
                    ]
                ];
            } else {
                //Simpan
                if ($this->request->getVar('postaction') == 'save') {
                    $tglawal = strtotime($this->request->getVar('tanggalaw'));
                    $tglakhir = strtotime($this->request->getVar('tanggalak'));
                    $hariInput = date('N', strtotime($this->request->getVar('tanggalaw')));
                    $tanggalHari = array();
                    do {
                        $hari = date('N', $tglawal);
                        if ($hari == $hariInput) $tanggalHari[] = date('Y-m-d', $tglawal);
                        $tglawal = strtotime('+1 day', $tglawal);
                    } while ($tglawal <= $tglakhir);

                    $data = [
                        'nama' => $this->request->getVar('nama'),
                        'potong_cuti' => ($this->request->getVar('potcuti') == 'on' ? '1' : '0'),
                        'updated_by' => $this->user['id'],
                    ];
                    foreach ($tanggalHari as $tanggal) {
                        $db = $this->deklarModel->getTanggal($tanggal);
                        if (empty($db)) $this->kalenderModel->save(['tanggal' => $tanggal] + $data);
                    }
                    $menu = $this->deklarModel->lastID('m_kalender');
                    $strtanggal = date('d-m-Y', strtotime($this->request->getVar('tanggalaw')));
                    $this->logModel->saveLog('Save', $menu[0]->id, $strtanggal);
                }
                $msg = ['sukses' => $strtanggal . " " . lang("app.judulsimpan")];
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
            $id = $this->request->getVar('id');
            $this->kalenderModel->delete($id);
            $this->logModel->saveLog('Save', $id, $this->request->getVar('tanggal') . " hapus");
            $msg = ['sukses' => date('d-m-Y', strtotime($this->request->getVar('tanggal'))) . ' ' . lang("app.judulhapus")];
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }

    // ____________________________________________________________________________________________________________________________
    public function tabeldata()
    {
        if ($this->request->isAJAX()) {
            $data = ['kalender' => $this->deklarModel->getKalender($this->request->getVar('tahun'))];
            $msg = ['data' => view('x-file/kalender_tabel', $data)];
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }
}
