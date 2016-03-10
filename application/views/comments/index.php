<div id="content-comments">
    <? if($comments->count()): ?>
        <h4>Комментарии</h4>
        <? foreach($comments as $comment): ?>
            <div class="comment">
                <div class="comment-info">
                    <strong><?= $comment->user->username; ?></strong> / <em><?= Date::russian_months(strftime('%H:%M, %d %B %Y', strtotime($comment->date))); ?></em>
                </div>
                <div class="comment-content">
                    <?= Text::wrap_in_p($comment->content); ?>
                </div>
                <?= Widget::factory('votes', array('comment' => $comment)); ?>
            </div>
        <? endforeach; ?>
    <? endif; ?>
</div>
