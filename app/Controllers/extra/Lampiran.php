<?php

namespace App\Controllers\extra;

use Config\App;
use App\Controllers\BaseController;
use App\Models\file\LampiranModel;

class Lampiran extends BaseController
{
    protected $lampiranModel;
    public function __construct()
    {
        $this->lampiranModel = new LampiranModel();
    }

    // ____________________________________________________________________________________________________________________________
    public function tabellampiran()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'lampiran' => $this->lampiranModel->getLampiran($this->request->getvar('xpilih'), $this->request->getvar('idunik')),
                'xpilih' => $this->request->getvar('xpilih'),
            ];
            $msg = ['data' => view('x-file/lampiran_tabel', $data)];
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }

    // ____________________________________________________________________________________________________________________________
    public function modallampiran()
    {
        if ($this->request->isAJAX()) {
            $data = ['idunik' => $this->request->getVar('idunik'), 'xpilih' => $this->request->getvar('xpilih')];
            $msg = ['data' => view('x-modal/input_lampiran', $data)];
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }

    // ____________________________________________________________________________________________________________________________
    public function savelampiran()
    {
        if ($this->request->isAJAX()) {
            $validationRules = [
                'judul' => [
                    'rules' => 'required',
                    'errors' => ['required' => lang("app.errblank")]
                ],
                'lampiran' => [ //20 MB
                    'rules' => 'uploaded[lampiran]|max_size[lampiran,20480]|ext_in[lampiran,pdf]',
                    'errors' => ['uploaded' => lang("app.errblank"), 'max_size' => lang("app.errfilebesar20"), 'ext_in' => lang("app.errextin")]
                ]
            ];
            if (!$this->validate($validationRules)) {
                $msg = ['error' => ['judul' => $this->validation->getError('judul'), 'lampiran' => $this->validation->getError('lampiran')]];
            } else {
                $berkaslampiran = $this->request->getFile('lampiran');
                $berkaslampiran->move('assets/berkas/' . $this->request->getVar('xpilih'));
                $nama_berkas = $berkaslampiran->getName();
                $this->lampiranModel->save([
                    'idunik' => $this->request->getVar('idunik'),
                    'pilihan' => $this->request->getVar('xpilih'),
                    'judul' => $this->request->getVar('judul'),
                    'tanggal' => $this->request->getVar('tanggal'),
                    'deskripsi' => $this->request->getVar('deskripsi'),
                    'lampiran' => $nama_berkas,
                    'updated_by' => $this->user['id'],
                ]);
                $msg = ['sukses' => $this->request->getVar('judul') . ' ' . lang("app.judulsimpan")];
            }
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }

    // ____________________________________________________________________________________________________________________________
    public function deletelampiran()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $this->lampiranModel->delete($id);
            unlink('assets/berkas/' . $this->request->getVar('xpilih') . '/' . $this->request->getVar('lampiran')); //hapus file lama
            $msg = ['sukses' => $this->request->getVar('judul') . ' ' . lang("app.judulhapus")];
            echo json_encode($msg);
        } else {
            exit('out');
        }
    }
}
