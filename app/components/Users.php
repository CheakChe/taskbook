<?php

class Users extends AbstractController
{
    private $users;

    public function __construct()
    {
        $this->users = new \Model\Users();
    }

    public function index()
    {
        if (isset($_POST['auth'])) {
            $this->auth();
        }
        return Router::render('layouts/auth');
    }

    private function auth()
    {
        $this->users->userExists($_POST['name']);
    }
}