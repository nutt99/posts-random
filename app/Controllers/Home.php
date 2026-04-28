<?php

namespace App\Controllers;

class Home extends BaseController
{
    // refactor this code when done slicing
    public function index(): string
    {
        return view('home/home_view');
    }

    public function navbar(): string {
        return view('navbar');
    }

    public function login(): string {
        return view('login/login_view');
    }

    public function detailPage(): string{
        return view('detail-page/detail_page_view');
    }

    public function profile(): string{
        return view('profile/profile_view');
    }

    public function uploadForm(): string {
        return view('post/create_post_view');
    }
}
