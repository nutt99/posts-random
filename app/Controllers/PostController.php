<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Posts;
use App\Models\Comments;
use App\Models\Likes;
use Exception;

class PostController extends BaseController
{
    public function index()
    {
        return view('post/create_post_view', [
            'title' => 'Tambahkan Postingan',
        ]);
    }

    public function addPhoto()
    {
        try {
            $session = session();

            if (!$session->get('isLogin')) {
                $session->setFlashdata('pesan', 'Silahkan login terlebih dahulu');
                return redirect()->to('/login');
            } else {
                $rules = [
                    'foto' => [
                        'rules' => 'uploaded[foto]|max_size[foto,20480]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png,image/webp]',
                        'errors' => [
                            'uploaded' => 'Pilih gambar terlebih dahulu.',
                            'max_size' => 'Ukuran gambar terlalu besar (Maksimal 20MB).',
                            'is_image' => 'File yang dipilih bukan gambar.',
                            'mime_in' => 'Format gambar tidak didukung.'
                        ]
                    ],
                    'judul' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Judul tidak boleh kosong'
                        ]
                    ]
                ];

                if (!$this->validate($rules)) {
                    return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
                }

                $foto = $this->request->getFile('foto');

                if ($foto->isValid() && !$foto->hasMoved()) {
                    $judul = $this->request->getPost('judul');
                    $deskripsi = $this->request->getPost('deskripsi') ?? '';

                    $namaFoto = $foto->getRandomName();

                    $foto->move('uploads/photos', $namaFoto);

                    $postModel = new Posts();

                    $postModel->insert([
                        'id_user' => $session->get('id'),
                        // 'id_user'   => 1, 
                        'title' => $judul,
                        'description' => $deskripsi,
                        'content_url' => $namaFoto
                    ]);

                    $session->setFlashdata('success', 'Postingan berhasil diunggah!');
                    return redirect()->to('/');
                }
            }
        } catch (Exception $e) {
            session()->setFlashdata('pesan', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function detail($id)
    {
        $postModel = new Posts();
        $commentModel = new Comments();
        $likeModel = new Likes();

        $post = $postModel->select('posts.*, users.username')
            ->join('users', 'users.id = posts.id_user')
            ->where('posts.id', $id)
            ->first();

        $relatedPosts = $postModel->where('id !=', $id)
            ->orderBy('id', 'RANDOM')
            ->limit(12)
            ->findAll();

        $komentar = $commentModel->select('comments.*, users.username')
            ->join('users', 'users.id = comments.id_user')
            ->where('id_posts', $id)
            ->findAll();

        $jumlahLike = $likeModel->where('id_post', $id)->countAllResults();

        $sudahLike = false;
        if (session()->get('isLogin')) {
            $cekLike = $likeModel->where([
                'id_post' => $id,
                'id_user' => session()->get('id')
            ])->first();

            if ($cekLike) {
                $sudahLike = true;
            }
        }

        if (!$post) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Postingan tidak ditemukan.");
        }

        $data = [
            'post' => $postModel->find($id),
            'komentar' => $komentar,
            'jumlahLike' => $jumlahLike,
            'sudahLike' => $sudahLike,
            'relatedPosts' => $relatedPosts
        ];

        return view('detail-page/detail_page_view', $data);
    }

    public function registerView(): string
    {
        return view('login/register_view');
    }

    public function toggleLike()
    {
        if (!session()->get('isLogin')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Silahkan login terlebih dahulu']);
        }

        $likeModel = new Likes();
        $id_post = $this->request->getPost('id_post');
        $id_user = session()->get('id');

        $cekLike = $likeModel->where([
            'id_post' => $id_post,
            'id_user' => $id_user
        ])->first();

        if ($cekLike) {
            $likeModel->delete($cekLike['id']);
            $action = 'unliked';
        } else {
            $likeModel->insert([
                'id_post' => $id_post,
                'id_user' => $id_user
            ]);
            $action = 'liked';
        }

        $totalLike = $likeModel->where('id_post', $id_post)->countAllResults();

        return $this->response->setJSON([
            'status' => 'success',
            'action' => $action,
            'total' => $totalLike
        ]);
    }


}
