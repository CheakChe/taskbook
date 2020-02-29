<div class="paging d-flex">
    <?php for ($i = 1; $i <= $vars['count']; $i++): ?>
        <div class="paging__link mr-1 ml-1">
            <?php if (!preg_match("@\/page\/$i@i", $_SERVER['REQUEST_URI'])): ?>
                <?php if ($i === 1): ?>
                    <a href="<?= $vars['url'] ?>"><?= $i ?></a>
                <?php else: ?>
                    <a href="<?= $vars['url'] ?>page/<?= $i ?>"><?= $i ?></a>
                <?php endif; ?>
            <?php else: ?>
                <p><?= $i ?></p>
            <?php endif; ?>
        </div>
    <?php endfor; ?>
</div>
