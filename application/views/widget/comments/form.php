<div id="comments-form">
    <? if (Auth::instance()->logged_in()): ?>
        <form id="comments-form-main" action="<?= URL::get_default_url('comments', 'form', $article_id); ?>" method="post">
            <textarea class="form-control" placeholder="Введите текст сообщения..." cols="50" rows="3" name="comment"></textarea>
            <input class="btn btn-default" type="submit" value="Отправить" name="">
        </form>
    <? else: ?>
        <div id="comments-form-prompt">
            <?= HTML::anchor(URL::get_default_url('auth', 'login'), 'Авторизуйтесь'); ?> на сайте или <?= HTML::anchor(URL::get_default_url('user', 'form'), 'зарегистрируйтесь'); ?>, <br>чтобы можно было оставлять комментарии.
        </div>
    <? endif; ?>
</div>