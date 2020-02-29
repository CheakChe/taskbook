<div class="container-fluid">
    <div class="row justify-content-center d-block auth">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="auth__message text-center">
                <p style="color: red"><?= array_shift($_SESSION['message']); ?></p>
            </div>
        <?php endif; ?>
        <form method="POST">
            <div class="auth__element m-2 text-center">
                <input required type="text" name="name" value="<?= $_POST['name'] ?>" placeholder="Имя">
            </div>
            <div class="auth__element m-2 text-center">
                <input required type="password" name="password" placeholder="Пароль">
            </div>
            <div class="auth__element m-2 text-center">
                <button class="btn btn-dark" type="submit" name="auth">Авторизироваться</button>
            </div>
        </form>
    </div>
</div>