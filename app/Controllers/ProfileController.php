<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Posts;

class ProfileController extends BaseController
{
    public function profile()
{
    if (!session()->get('isLogin')) {
        return redirect()->to('/login');
    }

    $postModel = new Posts();
    $userId = session()->get('id');

    $userPosts = $postModel->where('id_user', $userId)->findAll();

    return view('profile/profile_view', [
        'title' => 'Profil Saya',
        'post' => $userPosts,
        'user'  => [
            'username' => session()->get('username'),
            'email'    => session()->get('email')
        ]
    ]);
}
}
