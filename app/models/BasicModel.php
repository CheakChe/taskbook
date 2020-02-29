<?php


class BasicModel extends Model
{
    public function nameUser()
    {
        return $this->fetch_assoc("SELECT name FROM `users` WHERE `id`='{$_SESSION['user']}'")['name'];
    }
}