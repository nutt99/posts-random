<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Posts;
use App\Models\Saves;
use App\Models\Users;

class ProfileController extends BaseController
{
    public function profile()
    {
        if (!session()->get('isLogin')) {
            return redirect()->to('/login');
        }

        $postModel = new Posts();
        $saveModel = new Saves();
        $userModel = new Users();
        $userId = session()->get('id');

        $userPosts = $postModel->where('id_user', $userId)->findAll();
        $savedPosts = $postModel->select('posts.*')
            ->join('saves', 'saves.id_post = posts.id')
            ->where('saves.id_user', $userId)
            ->findAll();

        $userData = $userModel->find($userId);

        return view('profile/profile_view', [
            'title' => 'Profil Saya',
            'posts' => $userPosts,
            'savedPosts' => $savedPosts,
            'user' => $userData,
            'isOwnProfile' => true
        ]);
    }

    public function edit()
    {
        if (!session()->get('isLogin')) {
            return redirect()->to('/login');
        }

        $userModel = new Users();
        $user = $userModel->find(session()->get('id'));

        return view('profile/edit_profile_view', [
            'title' => 'Edit Profil',
            'user' => $user
        ]);
    }

    public function update()
    {
        if (!session()->get('isLogin'))
            return redirect()->to('/login');

        $userModel = new Users();
        $userId = session()->get('id');
        $user = $userModel->find($userId);

        $dataUpdate = [
            'display_name' => $this->request->getPost('display_name'),
            'bio' => $this->request->getPost('bio')
        ];

        $avatar = $this->request->getFile('avatar');
        if ($avatar && $avatar->isValid() && !$avatar->hasMoved()) {

            if (!is_dir(FCPATH . 'uploads/profile')) {
                mkdir(FCPATH . 'uploads/profile', 0777, true);
            }

            $namaAvatar = $avatar->getRandomName();
            $avatar->move(FCPATH . 'uploads/profile', $namaAvatar);

            if ($user['avatar'] != 'default.png' && $user['avatar'] != '' && file_exists(FCPATH . 'uploads/profile/' . $user['avatar'])) {
                unlink(FCPATH . 'uploads/profile/' . $user['avatar']);
            }

            $dataUpdate['avatar'] = $namaAvatar;

        }

        $userModel->update($userId, $dataUpdate);
        session()->set('avatar', $namaAvatar);

        // session()->set('username', $dataUpdate['username']);

        return redirect()->to('/profile')->with('success', 'Profil berhasil diperbarui!');
    }

    public function viewProfile($id)
    {
        $postModel = new Posts();
        $saveModel = new Saves();
        $userModel = new Users();

        $userData = $userModel->find($id);

        if (!$userData) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Pengguna tidak ditemukan.");
        }

        $userPosts = $postModel->where('id_user', $id)->findAll();
        $savedPosts = $postModel->select('posts.*')
            ->join('saves', 'saves.id_post = posts.id')
            ->where('saves.id_user', $id)
            ->findAll();

        return view('profile/profile_view', [
            'title'        => 'Profil ' . ($userData['display_name'] ?: $userData['username']),
            'posts'        => $userPosts,
            'savedPosts'   => $savedPosts,
            'user'         => $userData,
            'isOwnProfile' => (session()->get('id') == $id)
        ]);
    }
}
