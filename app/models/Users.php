<?php

namespace Model;

use Model;

class Users extends Model
{
    public function userExists()
    {
        return $this->query("SELECT * FROM `users` WHERE `name`=$vars");
    }
}