<?php


class Index extends AbstractController
{
    private $tasks;

    public function __construct()
    {
        $this->tasks = new TasksModel();
    }

    public function index()
    {
        if ($_POST['save'] === 'new') {
            $this->saveNew();
        } elseif (isset($_POST['save']) && $_POST['save'] !== 'new') {
            $this->save();
        }
        $this->sort();
        $paging['count'] = $this->paging();
        $paging['url'] = stristr($_SERVER['REQUEST_URI'], 'page', true);
        if (empty($paging['url'])) {
            $paging['url'] = $_SERVER['REQUEST_URI'];
        }
        $data['paging'] = Router::render('layouts/paging', $paging);

        $data['tasks'] = $this->tasks->allTask($_SESSION);

        return Router::render('main', $data);
    }

    private function saveNew(): void
    {
        $this->tasks->saveNew(
            [
                'nameNew' => $_POST['nameNew'],
                'emailNew' => $_POST['emailNew'],
                'taskNew' => $_POST['taskNew']
            ]
        );
        $_SESSION['message'][] = 'Задача добавлена.';
    }

    public function save()
    {
        if (isset($_SESSION['user'])) {
            $this->tasks->saveNew(
                [
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'task' => $_POST['task'],
                    'id' => $_POST['save']
                ]
            );
            $_SESSION['message'][] = 'Задача сохранена.';
        } else {
            $_SESSION['message'][] = 'У вас нет прав для данных действий.';
        }
    }

    private function sort(): void
    {
        if (isset($_SESSION['sort']) && $_SESSION['sort'] === 'ORDER BY ' . $_POST['sort']) {
            if (false !== stripos($_SESSION['sort'], 'ASC')) {
                $_SESSION['sort'] = str_replace('ASC', 'DESC', $_SESSION['sort']);
            } elseif (false !== stripos($_SESSION['sort'], 'DESC')) {
                $_SESSION['sort'] = str_replace('DESC', 'ASC', $_SESSION['sort']);
            }
        } elseif (isset($_POST['sort'])) {
            $_SESSION['sort'] = (isset($_POST['sort']) ? 'ORDER BY ' . $_POST['sort'] : '');
        }
    }

    private function paging()
    {
        $countTask = $this->tasks->countTask();
        if (preg_match('@\/page\/@i', $_SERVER['REQUEST_URI'])) {
            $url = explode('/', $_SERVER['REQUEST_URI']);
            $current_count = (int)(end($url) - 1) * 3;
            if ($current_count > $countTask) {
                header('Location: /error');
            }
            $_SESSION['paging'] = "LIMIT $current_count, 3";
        } else {
            $_SESSION['paging'] = 'LIMIT 0, 3';
        }
        return ceil($countTask / 3);
    }

}