<div id="container-account" class="col-md-6">
    <h3>Учетная запись</h3>
    <form action="" enctype="multipart/form-data" method="post" class="form-horizontal">
        <div class="form-group">
            <label for="username" class="col-md-4 control-label">Логин: <span class="text-danger">*</span></label>
            <div class="col-md-8">
                <input id="username" class="form-control" type="text" value="<?= $settings['username']; ?>" name="username">
            </div>
            <div class="col-md-12 text-danger">
                <?= Arr::get($errors, 'username'); ?>
            </div>
            <p class="container-account-prompt col-md-12 text-muted">* Ваше имя пользователя для авторизации на сайте.</p>
        </div>

        <div class="form-group">
            <label for="email" class="col-md-4 control-label">Адрес электронной почты: <span class="text-danger">*</span></label>
            <div class="col-md-8">
                <input id="email" class="form-control" type="text" value="<?= $settings['email']; ?>" name="email">
            </div>
            <div class="col-md-12 text-danger">
                <?= Arr::get($errors, 'email'); ?>
            </div>
            <p class="container-account-prompt col-md-12 text-muted">* Существующий адрес электронной почты. Все почтовые сообщения с сайта будут отсылаться на этот адрес. Адрес электронной почты не будет виден остальным пользователям.</p>
        </div>

        <div class="form-group">
            <label for="password" class="col-md-4 control-label">Пароль:</label>
            <div class="col-md-8">
                <input id="password" class="form-control" type="password" value="" name="password">
            </div>
        </div>

        <div class="form-group">
            <label for="password-confirm" class="col-md-4 control-label">Повторите пароль:</label>
            <div class="col-md-8">
                <input id="password-confirm" class="form-control" type="password" value="" name="password_confirm">
            </div>
            <div class="col-md-12 text-danger">
                <?= Arr::get($errors, 'password'); ?>
            </div>
            <p class="container-account-prompt col-md-12 text-muted">Чтобы изменить текущий пароль, укажите новый пароль в обоих полях.</p>
        </div>

        <div class="form-group">
            <div id="container-account-avatar">
                <?= Files::display($user_id); ?>
            </div>
            <label for="image" class="col-md-4 control-label">Загрузите изображение:</label>
            <div class="col-md-8">
                <input id="image" class="form-control" type="file" value="" name="image">
            </div>
            <div class="col-md-12 text-danger">
                <?= Arr::get($errors, 'image'); ?>
            </div>
            <p class="container-account-prompt col-md-12 text-muted">Ваше виртуальное лицо или картинка. Максимальные размеры <em>1080х1920</em> и объем <em>5120</em> Кб. По умолчанию отображается аватар, полученный при авторизации из соцсети. Минимальные размеры <em>500х500</em>.</p>
        </div>

        <div id="container-account-buttons" class="form-group">
            <a href="<?= URL::get_user_default_url('profile', 'index', $user_id); ?>" class="btn btn-default">Отменить</a>
            <input class="btn btn-default" type="submit" value="Сохранить" name="">
        </div>
    </form>
</div>