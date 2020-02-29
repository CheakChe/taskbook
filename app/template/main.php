<div class="container-fluid">
    <div class="row justify-content-center mt-5">
        <div class="tasks">
            <?php if (isset($_SESSION['message'])): ?>
                <div class="tasks__message">
                    <p><?= array_shift($_SESSION['message']) ?></p>
                </div>
            <?php endif; ?>
            <div class="tasks__button-new">
                <button class="new_task btn btn-dark">Новая задачу</button>
            </div>
            <form action="" method="POST">
                <div class="tasks__news"></div>
                <?php foreach ($vars['tasks'] as $key => $item): ?>
                    <div class="tasks__element d-flex justify-content-between">
                        <p class="align-self-end">Задание №<?= $item['id'] ?></p>
                        <div class="tasks__item align-items-center m-2">
                            <?php if ($key === 0): ?>
                                <div class="tasks__sorts justify-content-between d-flex m-2">
                                    <button name="sort" value="<?= ($_COOKIE['sort_name'] ?? 'tasks.name ASC') ?>">Имя
                                    </button>
                                    <button name="sort" value="<?= ($_COOKIE['sort_email'] ?? 'tasks.email ASC') ?>">
                                        Почта
                                    </button>
                                    <button name="sort" value="<?= ($_COOKIE['sort_task'] ?? 'tasks.task ASC') ?>">
                                        Описание задачи
                                    </button>
                                </div>
                            <?php endif; ?>
                            <input required type="text" <?= ($_SESSION['user'] ?? 'readonly') ?> placeholder="Имя"
                                   name="name[<?= $item['id'] ?>][]"
                                   value="<?= $item['name'] ?>">
                            <input required type="email" <?= ($_SESSION['user'] ?? 'readonly') ?> placeholder="Почта"
                                   name="email[<?= $item['id'] ?>][]"
                                   value="<?= $item['email'] ?>">
                            <input required type="text" <?= ($_SESSION['user'] ?? 'readonly') ?> placeholder="Задача"
                                   name="task[<?= $item['id'] ?>][]"
                                   value="<?= $item['task'] ?>">
                        </div>
                        <?php if (isset($_SESSION['user'])): ?>
                            <button class="btn btn-dark align-self-end" type="submit" name="save"
                                    value="<?= $item['id'] ?>">Сохранить
                            </button>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
                <?php if (isset($_SESSION['user'])): ?>
                    <div class="tasks__button-save text-center mt-5">
                        <button class="btn btn-dark" type="submit" name="save-all">Сохранить всё</button>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <div class="row justify-content-center mt-5">
        <?= $vars['paging'] ?>
    </div>
</div>