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

    public function addComment(){
        try{
            $session = session();
            $model = new Comments();

            $id_post = $this->request->getPost('id_post');
            $id_user = $session->get('id');
            $text = $this->request->getPost('comments_text');

            if($model->insert([
                'id_posts' => $id_post,
                'id_user' => $id_user,
                'comments_text' => $text
            ])){
                return 'success';
            } else{
                $session->setFlashdata('pesan', 'Terjadi kesalahan saat berkomentar');
                return redirect()->to('/');
            }
        } catch (Exception $e){
            $session->setFlashdata('pesan', $e->getMessage());
            return redirect()->to('/');
        }
    }

    public function updateComment(){
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
