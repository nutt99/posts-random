<?php

namespace App\Controllers;

use App\Models\Posts;

class Home extends BaseController
{
    // refactor this code when done slicing
    public function index(): string
    {
        $postModel = new Posts();

        // $posts = $postModel->orderBy('id', 'RANDOM')->paginate(15, 'default');
        $posts = $postModel->orderBy('id', 'DESC')->paginate(15, 'default');

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
            'title' => 'Hasil Pencarian',
            'posts' => $posts,
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

    public function loadMore()
    {
        $postModel = new \App\Models\Posts();

        $page = (int) ($this->request->getGet('page') ?? 1);
        $keyword = $this->request->getGet('q');
        
        $perPage = 15;
        $offset = ($page - 1) * $perPage;

        if (!empty($keyword)) {
            $posts = $postModel->groupStart()
                               ->like('title', $keyword)
                               ->orLike('description', $keyword)
                               ->groupEnd()
                               ->orderBy('id', 'DESC')
                               ->findAll($perPage, $offset);
        } else {
            $posts = $postModel->orderBy('id', 'DESC')->findAll($perPage, $offset);
        }

        if (empty($posts)) {
            return $this->response->setJSON(['html' => '', 'hasMore' => false]);
        }

        $html = '';
        foreach ($posts as $p) {
            $fotoUrl = (strpos($p['content_url'], 'http') === 0)
                ? $p['content_url']
                : base_url('uploads/photos/' . $p['content_url']);

            $detailUrl = base_url('post/' . $p['id']); 
            
            $html .= '
            <div class="masonry-item">
                <a href="' . $detailUrl . '">
                    <img src="' . $fotoUrl . '" class="w-100 border" style="border-radius: 16px; transition: filter 0.3s;" alt="' . esc($p['title']) . '">
                </a>
            </div>';
        }

        return $this->response->setJSON(['html' => $html, 'hasMore' => true]);
    }

}
