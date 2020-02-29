<?php


class Users extends AbstractController
{
    private $users;
    private $url;

    public function __construct()
    {
        $this->users = new UsersModel();
        $this->url = explode('/', $_SERVER['REQUEST_URI']);
    }

    public function index()
    {
        if ($this->url[2] === 'logout' && isset($_SESSION['user'])) {
            $this->logout();
        }

        if (isset($_SESSION['user'])) {
            header('Location: /');
        }

        if (isset($_POST['auth'])) {
            $this->auth();
        }

        return Router::render('layouts/auth');
    }

    private function auth(): void
    {
        if ($user = $this->users->userExists($_POST['name'])) {
            if (password_verify($_POST['password'], $user['password'])) {
                $_SESSION['user'] = $user['id'];
                $this->users->userOnline($user['id']);
                $_SESSION['message'][] = 'Вы успешно авторизировались.';
                header('Location: /');
            } else {
                $_SESSION['message'][] = 'Не верный пароль.';
            }
        } else {
            $_SESSION['message'][] = 'Пользователь не существует';
        }
    }

    public function logout(): void
    {
        $this->users->logout($_SESSION['user']);
        unset($_SESSION['user']);
    }
}