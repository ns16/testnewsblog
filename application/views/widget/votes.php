<div class="comment-votes"
    data-comment_id="<?= $comment->id; ?>"
    data-user_id="<?= $comment->user_id; ?>"
>
    <span class="comment-votes-count
        <?php if ($sum_votes > 0): ?>
            text-success
        <?php elseif ($sum_votes < 0): ?>
            text-danger
        <?php endif; ?>
    ">
        <?= $sum_votes; ?>
    </span>
    <?php if ($current_user_id !== $comment->user_id): ?>
        <span class="comment-votes-button glyphicon glyphicon-thumbs-up"
            data-value="<?= Model_Article_Comment_Vote::VOTE_UP; ?>"
        ></span>
        <span class="comment-votes-button glyphicon glyphicon-thumbs-down"
            data-value="<?= Model_Article_Comment_Vote::VOTE_DOWN; ?>"
        ></span>
    <?php endif; ?>
</div>