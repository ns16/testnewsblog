<div id="header-dropdown" class="dropdown">
    <span id="header-dropdown-user">
        <?php if($user): ?>
            <?= $user->username; ?>
        <?php endif; ?>
    </span>
    <button id="header-dropdown-button" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        <span class="glyphicon glyphicon-user"></span>
    </button>
    <ul id="header-dropdown-list" class="dropdown-menu" aria-labelledby="dropdownMenu1">
        <?php if($user): ?>
            <li><?= HTML::anchor('/user/profile/index/'.$user->id, 'Мой профиль'); ?></li>
            <li><?= HTML::anchor('/user/settings/personal/'.$user->id, 'Мои настройки'); ?></li>
            <li><?= HTML::anchor('/auth/logout', 'Выйти'); ?></li>
        <?php else: ?>
            <li><?= HTML::anchor('/auth/login', 'Войти'); ?></li>
            <li><?= HTML::anchor('/user/form', 'Зарегистрироваться'); ?></li>
        <?php endif; ?>
    </ul>
</div>