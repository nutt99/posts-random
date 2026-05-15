<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Comments;
use CodeIgniter\HTTP\ResponseInterface;

use Exception;

class CommentController extends BaseController
{
    public function index()
    {
        //
    }

    public function addComment()
    {
        if (!session()->get('isLogin')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Silahkan login untuk berkomentar']);
        }

        $commentModel = new Comments();
        $komentar = $this->request->getPost('komentar');
        
        $commentModel->insert([
            'id_user'      => session()->get('id'),
            'id_posts'      => $this->request->getPost('id_post'),
            'comments_text' => $komentar
        ]);

        return $this->response->setJSON([
            'status'   => 'success',
            'username' => session()->get('username'),
            'text'     => $komentar
        ]);
    }

    public function updateComment()
    {
        $comment_id = $this->request->getPost('comment_id');
        $comments_text = $this->request->getPost('comments_text');

        $session = session();
        $model = new Comments();

        //update data
        $model->update($comment_id, [
            'id_posts' => $comment_id,
            'id_user' => $session->get('id_user'),
            'comments_text' => $comments_text
        ]);

    }
}
