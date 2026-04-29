<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Users;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class UserController extends BaseController
{
    public function index() : string
    {
        return view('login/login_view');
    }

    public function register(){
        try{
            $username = $this->request->getPost('username');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $session = session();
            $model = new Users();
            
            if($model->insert([
                'username' => $username,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_BCRYPT)
            ])){
                $session->set([
                    'id' => $model->getInsertID(),
                    'username' => $username,
                    'isLogin' => true
                ]);

                return redirect()->to('/');
            } else{
                $session->setFlashdata('pesan', 'Usernam\e atau email sudah digunakan');
                return redirect()->to('/register');
            }
        } catch (Exception $e){
            $session->setFlashdata('pesan', $e->getMessage());
            return redirect()->to('/register');
        }
    }

    public function auth(): RedirectResponse{
        $session = session();
        $model = new Users();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        try{

            $data = $model->where('username', $username)->first();
            
            if($data){
                $verify_pass = password_verify($password, $data['password']);

                if($verify_pass){
                    $session->set([
                        'id' => $data['id'],
                        'username' => $data['username'],
                        'isLogin' => true
                    ]);

                    return redirect()->to('/');
                } else{
                    $session->setFlashdata('pesan', 'Maaf username atau password salah');
                    return redirect()->to('/login');
                }
            } else{
                $session->setFlashdata('pesan', 'username kamu atau password nya salah');
                return redirect()->to('/login');
            }

        } catch (Exception $e){
            $session->setFlashdata('pesan', $e->getMessage());
            return redirect()->to('/login');
        }
    }

    public function logout(){
        try{
            $session = session();
            $session->destroy();
            return redirect()->to('/login');
        } catch(Exception $e){
            $session->setFlashdata('pesan', 'Anda Belum Login');
            return redirect()->back();
        }
    }
}
