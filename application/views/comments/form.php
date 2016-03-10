<div id="content-form">
    <? if(Auth::instance()->logged_in()): ?>
        <form id="content-form-main" action="<?= '/comments/form/'.$article_id; ?>" method="post">
            <textarea class="form-control" placeholder="Введите текст сообщения..." cols="50" rows="3" name="comment"></textarea>
            <input class="btn btn-default" type="submit" value="Отправить" name="">
        </form>
    <? else: ?>
        <div id="content-form-prompt">
            <?= HTML::anchor('/auth/login', 'Авторизуйтесь'); ?> на сайте или <?= HTML::anchor('/user/form', 'зарегистрируйтесь'); ?>, <br>чтобы можно было оставлять комментарии.
        </div>
    <? endif; ?>
</div>