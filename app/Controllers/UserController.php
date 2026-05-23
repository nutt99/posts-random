<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Users;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class UserController extends BaseController
{
    public function index(): string
    {
        return view('login/login_view');
    }

    public function registerView(): string{
        return view('login/register_view');
    }

    public function register(): RedirectResponse
    { {
            // Aturan validasi
            $rules = [
                'username' => [
                    'rules' => 'required|min_length[3]|is_unique[users.username]',
                    'errors' => [
                        'required' => 'Username harus diisi.',
                        'min_length' => 'Username minimal 3 karakter.',
                        'is_unique' => 'Username sudah digunakan, pilih yang lain.'
                    ]
                ],
                'email' => [
                    'rules' => 'required|valid_email|is_unique[users.email]',
                    'errors' => [
                        'required' => 'Email harus diisi.',
                        'valid_email' => 'Format email tidak valid.',
                        'is_unique' => 'Email ini sudah terdaftar.'
                    ]
                ],
                'password' => [
                    'rules' => 'required|min_length[6]',
                    'errors' => [
                        'required' => 'Password harus diisi.',
                        'min_length' => 'Password minimal 6 karakter.'
                    ]
                ],
                'password_confirm' => [
                    'rules' => 'matches[password]',
                    'errors' => [
                        'matches' => 'Konfirmasi password tidak cocok.'
                    ]
                ]
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $userModel = new Users();

            $userModel->insert([
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            ]);

            session()->setFlashdata('pesan', 'Registrasi berhasil! Silakan masuk dengan akun baru Anda.');
            return redirect()->to('/login');
        }
    }

    public function auth(): RedirectResponse
    {
        $session = session();
        $model = new Users();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        try {

            $data = $model->where('username', $username)->first();

            if ($data) {
                $verify_pass = password_verify($password, $data['password']);

                if ($verify_pass) {
                    $session->set([
                        'id' => $data['id'],
                        'username' => $data['username'],
                        'isLogin' => true,
                        'avatar'   => $data['avatar'] ?? ''
                    ]);

                    return redirect()->to('/');
                } else {
                    $session->setFlashdata('pesan', 'Maaf username atau password salah');
                    return redirect()->to('/login');
                }
            } else {
                $session->setFlashdata('pesan', 'username kamu atau password nya salah');
                return redirect()->to('/login');
            }

        } catch (Exception $e) {
            $session->setFlashdata('pesan', $e->getMessage());
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        try {
            $session = session();
            $session->destroy();
            return redirect()->to('/login');
        } catch (Exception $e) {
            $session->setFlashdata('pesan', 'Anda Belum Login');
            return redirect()->back();
        }
    }
}
