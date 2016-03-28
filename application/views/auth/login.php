<div id="container">
    <div id="container-form" class="col-md-4">
        <?php if ($message): ?>
            <div id="container-form-message" class="alert alert-danger" role="alert">
                <?= $message; ?>
            </div>
        <? endif; ?>
        <h3 id="container-form-title" class="text-center">Вход</h3>
        <form id="container-form-main" action="" method="post">
            <div class="form-group">
                <label for="username">Имя</label>
                <input id="username" class="form-control" type="text" value="<?= $username; ?>" name="username">
                <span class='text-danger'><?= Arr::get($errors, 'username'); ?></span>
            </div>

            <div class="form-group">
                <label for="password">Пароль</label>
                <input id="password" class="form-control" type="password" name="password">
                <span class='text-danger'><?= Arr::get($errors, 'password'); ?></span>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" value="1"> Запомнить меня
                </label>
            </div>

            <input class="btn btn-default" type="submit" value="Вход" name="submit">
        </form>

        <div id="container-form-prompt" class="text-center">
            <span>Еще не зарегистрированы? </span><?= HTML::anchor(URL::get_default_url('user', 'form'), 'Регистрация', array('class' => 'btn btn-default')); ?>
        </div>
    </div>
</div>