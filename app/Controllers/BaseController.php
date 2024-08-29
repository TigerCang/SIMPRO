<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;
    protected $session;
    protected $language;
    protected $logModel;
    protected $iduModel;
    protected $userModel;
    protected $konfigurasiModel;
    protected $deklarModel;
    protected $tranModel;
    protected $user;
    protected $menu;
    protected $validation;
    protected $urls;
    protected $level;
    protected $levacc;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    // protected $helpers = [];
    protected $helpers = ['url', 'form', 'custom_helper'];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
        // $this bisa dijadikan variabel parent 

        // $encrypter = \config\Services::encrypter();
        // $encrypter->encrypt('sandy'); $encrypter->decrypt('sandy');

        // Language
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->language = \Config\Services::language();
        $this->language->setLocale($this->session->lang);
        $this->urls = explode('/', $_SERVER['REQUEST_URI']);

        $this->logModel = new \App\Models\extra\LogModel();
        $this->iduModel = new \App\Models\extra\IdunikModel();
        $this->deklarModel = new \App\Models\extra\DeklarModel();
        $this->tranModel = new \App\Models\extra\TranModel();
        $this->userModel = new \App\Models\admin\UserModel();
        $this->roleModel = new \App\Models\admin\RoleModel();
        $this->konfigurasiModel = new \App\Models\admin\KonfigurasiModel();

        $this->user = $this->userModel->getUser(session()->username);
        $this->menu = $this->roleModel->getRole($this->user['role_id'] ?? '');
        $this->level = $this->konfigurasiModel->getKonfigurasi('konf_jlsetuju');
        $this->anu = $this->konfigurasiModel->getKonfigurasi();
        $this->levacc = (isset($this->user['acc_setuju']) ? ($this->user['acc_setuju'] == '0' ? $this->level[0]['nilai'] : $this->user['acc_setuju'] - 1) : '0');

        helper(['text', 'session', 'filesystem']);
    }
}
