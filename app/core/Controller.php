<?php


class Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new BasicModel();
    }

    public function init()
    {

        $data['header'] = Router::render('layouts/header',
            [
                'styles' => ['bootstrap.min', 'main'],
                'nameUser' => $this->model->nameUser()
            ]);

        $data['footer'] = Router::render('layouts/footer',
            ['scripts' => ['main']]);

        return $data;
    }
}