<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= SITENAME ?></title>
    <?php if (!empty($vars['styles'])): ?>
        <?php foreach ($vars['styles'] as $key => $item): ?>
            <link rel="stylesheet" href="/app/public/css/<?= $item ?>.css">
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>
<header>
    <div class="container-fluid">
        <div class="row justify-content-around mt-2">
            <a class="btn btn-dark" <?= $_SERVER['REQUEST_URI'] === '/' ? 'style="pointer-events: none"' : '' ?>
               href="/">На главную</a>
            <?php if (!isset($_SESSION['user'])): ?>
                <a class="btn btn-dark" href="/users">Авторизиция</a>
            <?php elseif (!empty($vars['nameUser'])): ?>
                <a class="btn btn-dark" href="/users/logout">Выход</a>
            <?php endif; ?>
        </div>
    </div>
</header>

