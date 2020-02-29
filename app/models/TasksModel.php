<?php


class TasksModel extends Model
{
    public function allTask($vars = NULL): array
    {
        $sort = ($vars['sort'] ?? '');
        $paging = ($vars['paging'] ?? '');
        return $this->fetch_all("SELECT * FROM `tasks` $sort $paging");
    }

    public function countTask()
    {
        return $this->fetch_assoc('SELECT COUNT(*) AS count FROM `tasks`')['count'];
    }

    public function saveNew($vars)
    {

        $this->query("INSERT INTO `tasks` SET 
                        `name`='{$vars['nameNew']}',
                        `email`='{$vars['emailNew']}',
                        `task`='{$vars['taskNew']}'
                        ");
    }

    public function save($vars): void
    {
        $this->query("UPDATE `tasks` SET 
                        `name`='{$vars['name']}',
                        `email`='{$vars['email']}',
                        `task`='{$vars['task']}',
                        `status`='{$vars['status']}',
                        `change_admin`='{$vars['change_admin']}'
                        WHERE `id`='{$vars['id']}'");
    }

    public function textTask($task_id)
    {
        return $this->fetch_assoc("SELECT task FROM `tasks` WHERE `id`='$task_id'")['task'];
    }
}