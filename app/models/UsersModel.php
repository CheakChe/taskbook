<?php



class UsersModel extends Model
{
    public function userExists($vars)
    {
        return $this->fetch_assoc("SELECT * FROM `users` WHERE `name`='$vars'");
    }

    public function userOnline($user_id): void
    {
        $this->query("UPDATE `users` SET `status`='1' WHERE `id`='$user_id'");
    }

    public function logout($user_id): void
    {
        $this->query("UPDATE `users` SET `status`='0' WHERE `id`='$user_id'");
    }
}