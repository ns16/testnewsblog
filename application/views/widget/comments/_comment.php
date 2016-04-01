<div class="comment">
    <div class="comment-username">
        <strong><?= $comment->user->username; ?></strong> /
        <em><?= Date::rus_date_format($comment->date); ?></em>
    </div>
    <div class="comment-content">
        <?= Text::wrap_in_p($comment->content); ?>
    </div>
    <?= Widget::factory('votes', array('comment' => $comment)); ?>
</div>