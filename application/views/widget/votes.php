<div class="comment-votes">
    <span class="comment-votes-count
        <? if ($sum_votes > 0): ?>
            text-success
        <? elseif ($sum_votes < 0): ?>
            text-danger
        <? endif; ?>
    ">
        <?= $sum_votes; ?>
    </span>
    <? if ($current_user_id !== $comment->user_id): ?>
        <a href="<?= URL::get_default_url('votes', 'up').URL::query(
            array(
                'article_id' => $comment->article_id,
                'comment_id' => $comment->id,
                'user_id'    => $comment->user_id,
            )); ?>" class="comment-votes-up btn btn-default">
            <span class="glyphicon glyphicon-thumbs-up"></span>
        </a>
        <a href="<?= URL::get_default_url('votes', 'down').URL::query(
            array(
                'article_id' => $comment->article_id,
                'comment_id' => $comment->id,
                'user_id'    => $comment->user_id,
            )); ?>" class="comment-votes-down btn btn-default">
            <span class="glyphicon glyphicon-thumbs-down"></span>
        </a>
    <? endif; ?>
</div>