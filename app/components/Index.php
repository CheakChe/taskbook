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
        } elseif (isset($_POST['save-all'])) {
            $this->saveAll();
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

    public function saveAll(): void
    {
        if (isset($_SESSION['user'])) {
            foreach ($_POST['name'] as $key => $item) {
                $task_current = $this->tasks->textTask($key);
                if ($_POST['task'][$key][0] !== $task_current) {
                    $change_admin = '1';
                } else {
                    $change_admin = '0';
                }
                if ($_POST['status'][$key][0] === 'on') {
                    $_POST['status'][$key][0] = '1';
                } else {
                    $_POST['status'][$key][0] = '0';
                }
                $this->tasks->save(
                    [
                        'name' => $_POST['name'][$key][0],
                        'email' => $_POST['email'][$key][0],
                        'task' => $_POST['task'][$key][0],
                        'status' => $_POST['status'][$key][0],
                        'change_admin' => $change_admin,
                        'id' => $key
                    ]
                );
            }
            $_SESSION['message'][] = 'Задачи сохранены.';
        } else {
            $_SESSION['message'][] = 'У вас нет прав для данных действий.';
        }
    }

    public function save(): void
    {
        if (isset($_SESSION['user'])) {
            $task_current = $this->tasks->textTask($_POST['save']);
            if ($_POST['task'][$_POST['save']][0] !== $task_current) {
                $change_admin = '1';
            } else {
                $change_admin = '0';
            }
            if ($_POST['status'][$_POST['save']][0] === 'on') {
                $_POST['status'][$_POST['save']][0] = '1';
            } else {
                $_POST['status'][$_POST['save']][0] = '0';
            }
            $this->tasks->save(
                [
                    'name' => $_POST['name'][$_POST['save']][0],
                    'email' => $_POST['email'][$_POST['save']][0],
                    'task' => $_POST['task'][$_POST['save']][0],
                    'status' => $_POST['status'][$_POST['save']][0],
                    'change_admin' => $change_admin,
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
        if (isset($_SESSION['sort_pre']) && $_SESSION['sort_pre'] === $_POST['sort'][0]) {
            if (false !== stripos($_SESSION['sort'], 'ASC')) {
                $_SESSION['sort'] = str_replace('ASC', 'DESC', $_SESSION['sort']);
            } elseif (false !== stripos($_SESSION['sort'], 'DESC')) {
                $_SESSION['sort'] = str_replace('DESC', 'ASC', $_SESSION['sort']);
            }
        } elseif (isset($_POST['sort'])) {
            $_SESSION['sort_pre'] = $_POST['sort'][0];
            $_SESSION['sort'] = 'ORDER BY ' . $_POST['sort'][0] . ' ASC';
        } elseif (!isset($_SESSION['sort'])) {
            $_SESSION['sort'] = 'ORDER BY tasks.name ASC';
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