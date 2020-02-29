<div class="container-fluid">
    <div class="row justify-content-center mt-5">
        <div class="tasks col-lg-12 col-lx-8">
            <?php if (isset($_SESSION['message'])): ?>
                <div class="tasks__message text-center">
                    <p><?= array_shift($_SESSION['message']) ?></p>
                </div>
            <?php endif; ?>
            <div class="tasks__button-new">
                <button class="new_task btn btn-dark">Новая задачу</button>
            </div>
            <form class="tasks__form col-12" action="" method="POST">
                <div class="tasks__new"></div>
                <?php foreach ($vars['tasks'] as $key => $item): ?>
                    <?php if ($key === 0): ?>
                        <div class="tasks__sorts justify-content-end d-sm-flex d-block text-center m-2 ">
                            <button class="btn btn-light" type="submit" name="sort[]" value="tasks.name">Имя
                            </button>
                            <button class="btn btn-light" type="submit" name="sort[]" value="tasks.email">
                                Почта
                            </button>
                            <button class="btn btn-light" type="submit" name="sort[]" value="tasks.status">
                                Статус задачи
                            </button>
                        </div>
                    <?php endif; ?>
                    <div class="tasks__element col-12 d-block flex-wrap">
                        <div class="tasks__info d-lg-flex d-md-block m-2 justify-content-lg-between justify-content-md-center text-md-center text-center">
                            <span class="tasks__number align-self-center col-2">Задание №<?= $item['id'] ?></span>
                            <div class="tasks__item d-lg-flex d-md-flex justify-content-md-center d-sm-block align-items-center m-2 col-xl-8 ">
                                <div class="tasks__input m-2">
                                    <input required type="text" <?= ($_SESSION['user'] ?? 'readonly') ?>
                                           placeholder="Имя"
                                           name="name[<?= $item['id'] ?>][]"
                                           value="<?= $item['name'] ?>">
                                </div>
                                <div class="tasks__input m-2">
                                    <input required type="email" <?= ($_SESSION['user'] ?? 'readonly') ?>
                                           placeholder="Почта"
                                           name="email[<?= $item['id'] ?>][]"
                                           value="<?= $item['email'] ?>">
                                </div>
                                <div class="tasks__input m-2">
                                    <input required type="text" <?= ($_SESSION['user'] ?? 'readonly') ?>
                                           placeholder="Задача"
                                           name="task[<?= $item['id'] ?>][]"
                                           value="<?= $item['task'] ?>">
                                </div>
                                <div class="tasks__check">
                                    <?php if (isset($_SESSION['user'])): ?>
                                        <input type="checkbox" <?= ($item['status'] === '1' ? 'checked' : '') ?> <?= ($_SESSION['user'] ?? 'readonly') ?>
                                               name="status[<?= $item['id'] ?>][]">
                                    <?php else: ?>
                                        <?php if ($item['status'] === '1'): ?>
                                            <span title="Выполнено">&#9745;</span>
                                        <?php else: ?>
                                            <span title="Не выполнено">&#9746;</span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if (isset($_SESSION['user'])): ?>
                                <button class="btn btn-dark align-self-end" type="submit" name="save"
                                        value="<?= $item['id'] ?>">Сохранить
                                </button>
                            <?php endif; ?>
                        </div>
                        <?php if ($item['change_admin'] === '1'): ?>
                            <div class="tasks__change">
                                <p>Отредактировано администатором.</p>
                            </div>
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