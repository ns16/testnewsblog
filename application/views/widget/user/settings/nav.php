<nav id="container-navigation" class="navbar navbar-default">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <?php foreach ($items as $item_title => $item_url): ?>
                <li <?php if (strpos($current_url, $item_url)): ?>
                    class="active"
                <?php endif; ?>>
                    <a href="<?= URL::site($item_url); ?>"><?= $item_title; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>