<div id="comments-form">
    <?php if (Auth::instance()->logged_in()): ?>
        <div id="comments-form-main">
            <textarea id="comments-form-main-textarea" class="form-control" placeholder="Введите текст сообщения..." cols="50" rows="3" name="content"></textarea>
            <input id="comments-form-main-submit" class="btn btn-default" data-article_id="<?= $article_id; ?>" type="submit" value="Отправить" name="">
        </div>
    <?php else: ?>
        <div id="comments-form-prompt">
            <?= HTML::anchor(URL::get_default_url('auth', 'login'), 'Авторизуйтесь'); ?> на сайте или <?= HTML::anchor(URL::get_default_url('user', 'form'), 'зарегистрируйтесь'); ?>, <br>чтобы можно было оставлять комментарии.
        </div>
    <?php endif; ?>
</div>