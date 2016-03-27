<div class="comment-votes"
    data-comment_id="<?= $comment->id; ?>"
    data-user_id="<?= $comment->user_id; ?>"
>
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
        <span class="comment-votes-button glyphicon glyphicon-thumbs-up"
            data-value="<?= Model_Article_Comment_Vote::VOTE_UP; ?>"
        ></span>
        <span class="comment-votes-button glyphicon glyphicon-thumbs-down"
            data-value="<?= Model_Article_Comment_Vote::VOTE_DOWN; ?>"
        ></span>
    <? endif; ?>
</div>