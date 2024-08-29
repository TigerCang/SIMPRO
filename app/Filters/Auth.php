<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $userModel = new \App\Models\admin\UserModel();
        $logModel = new \App\Models\extra\LogModel();
        $user = $userModel->getUser(session()->username);
        $urls = explode('/', $_SERVER['REQUEST_URI']);
        if (session()->username) {
            if ($urls[1] != 'login' && !$user) {
                $logModel->saveLog('lo', '', session()->username);
                session()->destroy();
                return redirect()->to('/login');
            }
        } else {
            return redirect()->to('/login');
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
