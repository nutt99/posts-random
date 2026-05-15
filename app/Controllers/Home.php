<?php

namespace App\Controllers;

use App\Models\Posts;

class Home extends BaseController
{
    // refactor this code when done slicing
    public function index(): string
    {
        $postModel = new Posts();

        $posts = $postModel->orderBy('id', 'RANDOM')->findAll();

        return view('home/home_view', [
            'title' => 'Beranda',
            'posts' => $posts
        ]);
    }

    public function search(): string
    {
        $postModel = new Posts();
        
        $keyword = $this->request->getGet('q');

        if ($keyword) {
            $posts = $postModel->like('title', $keyword)
                               ->orLike('description', $keyword)
                               ->findAll();
        } else {
            $posts = $postModel->findAll();
        }

        return view('home/home_view', [
            'title'   => 'Hasil Pencarian',
            'posts'   => $posts,
            'keyword' => $keyword
        ]);
    }

    public function login(): string
    {
        return view('login/login_view');
    }

    public function detailPage(): string
    {
        return view('detail-page/detail_page_view');
    }

    public function profile(): string
    {
        return view('profile/profile_view');
    }

}
