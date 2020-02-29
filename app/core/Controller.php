<?php


class Controller
{
    public function init()
    {
        $data['header'] = Router::render('layouts/header',
            ['styles' => ['bootstrap.min', 'main']]);

        $data['footer'] = Router::render('layouts/footer',
            ['scripts' => ['main']]);

        return $data;
    }
}