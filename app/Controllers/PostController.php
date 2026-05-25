<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Posts;
use App\Models\Comments;
use App\Models\Likes;
use App\Models\Saves;
use Exception;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

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

                    $imagePath = FCPATH . 'uploads/photos/' . $namaFoto;

                    // $manager = new ImageManager(new Driver());

                    // $img = $manager->read($imagePath);

                    // $watermarkPath = FCPATH . 'images/logo-watermark.png';

                    // if (file_exists($watermarkPath)) {
                    //     $watermark = $manager->read($watermarkPath);

                    //     $watermark->scale(width: 100);

                    //     $img->place($watermark, 'bottom-right', 10, 10);
                    // }

                    // $img->save($imagePath, 90);

                    $postModel = new Posts();

                    $postModel->insert([
                        'id_user' => $session->get('id'),
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

        $post = $postModel->select('posts.*, users.username, users.display_name, users.avatar')
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

        $sudahSimpan = false;
        if (session()->get('isLogin')) {
            $saveModel = new Saves();
            $cekSimpan = $saveModel->where([
                'id_post' => $id,
                'id_user' => session()->get('id')
            ])->first();

            if ($cekSimpan) {
                $sudahSimpan = true;
            }
        }

        if (!$post) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Postingan tidak ditemukan.");
        }

        $data = [
            'post' => $post,
            'komentar' => $komentar,
            'jumlahLike' => $jumlahLike,
            'sudahLike' => $sudahLike,
            'sudahSimpan' => $sudahSimpan,
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

    public function edit($id)
    {
        $postModel = new Posts();
        $post = $postModel->find($id);

        if (!$post || $post['id_user'] != session()->get('id')) {
            return redirect()->to('/profile')->with('error', 'Akses ditolak atau Pin tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Pin',
            'post' => $post
        ];

        return view('profile/edit_view', $data);
    }

    public function update($id)
    {
        $postModel = new Posts();
        $post = $postModel->find($id);

        if (!$post || $post['id_user'] != session()->get('id')) {
            return redirect()->to('/profile')->with('error', 'Akses ditolak.');
        }

        $updateData = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
        ];

        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move(FCPATH . 'uploads', $newName);

            if (file_exists(FCPATH . 'uploads/' . $post['image_url']) && !empty($post['image_url'])) {
                unlink(FCPATH . 'uploads/' . $post['image_url']);
            }

            $updateData['image_url'] = $newName;
        }

        $postModel->update($id, $updateData);

        return redirect()->to('/profile')->with('success', 'Pin berhasil diperbarui.');
    }

    public function delete($id)
    {
        $postModel = new Posts();
        $post = $postModel->find($id);

        if (!$post || $post['id_user'] != session()->get('id')) {
            return redirect()->to('/profile')->with('error', 'Akses ditolak.');
        }

        if (file_exists(FCPATH . 'uploads/photos/' . $post['content_url']) && !empty($post['content_url'])) {
            unlink(FCPATH . 'uploads/photos/' . $post['content_url']);
        }

        $postModel->delete($id);

        return redirect()->to('/profile')->with('success', 'Pin berhasil dihapus.');
    }

    public function toggleSave()
    {
        if (!session()->get('isLogin')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Silahkan login terlebih dahulu']);
        }

        $saveModel = new Saves();
        $id_post = $this->request->getPost('id_post');
        $id_user = session()->get('id');

        $cekSave = $saveModel->where(['id_post' => $id_post, 'id_user' => $id_user])->first();

        if ($cekSave) {
            $saveModel->delete($cekSave['id']);
            $action = 'unsaved';
        } else {
            $saveModel->insert(['id_post' => $id_post, 'id_user' => $id_user]);
            $action = 'saved';
        }

        return $this->response->setJSON([
            'status' => 'success',
            'action' => $action
        ]);
    }

    public function downloadPhoto($namaFoto)
    {
        $imagePath = FCPATH . 'uploads/photos/' . $namaFoto;

        if (!file_exists($imagePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        $manager = new ImageManager(new Driver());

        $img = $manager->read($imagePath);

        $watermarkPath = FCPATH . 'images/logo-watermark.png';

        if (file_exists($watermarkPath)) {
            $watermark = $manager->read($watermarkPath);
            $watermark->scale(width: 100);
            $img->place($watermark, 'bottom-right', 10, 10);
        }

        $encodedImage = $img->toJpeg(90)->toString();

        $namaDownload = 'watermark_' . $namaFoto;

        return $this->response->download($namaDownload, $encodedImage);
    }

    
}