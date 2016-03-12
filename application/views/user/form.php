<div id="container">
    <div id="container-form" class="col-md-4">
        <? if ($message): ?>
            <div id="container-form-message" class="bg-danger">
                <?= $message; ?>
            </div>
        <? endif; ?>
        <h3 id="container-form-title" class="text-center">Регистрация</h3>
        <form id="container-form-main" action="" method="post">
            <div class="form-group">
                <label for="username">Имя</label>
                <input id="username" class="form-control" type="text" name="username">
                <div class="text-danger">
                    <?= Arr::get($errors, 'username'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Адрес электронной почты</label>
                <input id="email" class="form-control" type="text" name="email">
                <div class="text-danger">
                    <?= Arr::get($errors, 'email'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Пароль</label>
                <input id="password" class="form-control" type="password" name="password">
                <div class="text-danger">
                    <?= Arr::get($errors, 'password'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirm">Повторите пароль</label>
                <input id="password-confirm" class="form-control" type="password" name="password_confirm">
                <div class="text-danger">
                    <?= Arr::get($errors, 'password_confirm'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="captcha">Введите в поле ответ на пример: <br><?= $task; ?></label>
                <input id="captcha" class="form-control" type="text" name="captcha">
                <div class="text-danger">
                    <?= Arr::get($errors, 'captcha'); ?>
                </div>
            </div>

            <input class="btn btn-default" type="submit" value="Регистрация" name="">
        </form>

        <div id="container-form-prompt" class="text-center">
            <span>Есть аккаунт? </span><?= HTML::anchor('/auth/login', 'Вход', array('class' => 'btn btn-default')); ?>
        </div>
    </div>
</div>