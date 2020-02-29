<?php


class Tasks extends Model
{
    public function allTask($vars = NULL): array
    {
        $sort = ($vars['sort'] ?? '');
        $paging = ($vars['paging'] ?? '');
        return $this->fetch_all("SELECT * FROM `tasks` $sort $paging");
    }

    public function countTask()
    {
        return $this->fetch_assoc('SELECT COUNT(*) AS count FROM `tasks`');
    }

    public function saveNew($vars)
    {

        $this->query("INSERT INTO `tasks` SET 
                        `name`='{$vars['nameNew']}',
                        `email`='{$vars['emailNew']}',
                        `task`='{$vars['taskNew']}'
                        ");
    }
}