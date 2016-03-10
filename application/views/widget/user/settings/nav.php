<nav id="container-navigation" class="navbar navbar-default">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <? foreach ($items as $item_title => $item_url): ?>
                <li <? if (strpos($current_url, $item_url)): ?>
                    class="active"
                <? endif; ?>>
                    <a href="<?= URL::site($item_url); ?>"><?= $item_title; ?></a>
                </li>
            <? endforeach; ?>
        </ul>
    </div>
</nav>