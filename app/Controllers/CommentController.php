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
                
            }
        } catch (Exception $e){

        }
    }
}
