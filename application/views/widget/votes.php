<div class="comment-votes"
    data-comment_id="<?= $comment->id; ?>"
    data-user_id="<?= $comment->user_id; ?>"
>
    <span class="comment-votes-sum">
        <?= View::factory('widget/votes/_sum')->set('sum_votes', $sum_votes); ?>
    </span>

    <?php if ($current_user_id !== $comment->user_id): ?>
        <span class="comment-votes-button glyphicon glyphicon-thumbs-up"
            data-vote="<?= Model_Article_Comment_Vote::VOTE_UP; ?>"
        ></span>
        <span class="comment-votes-button glyphicon glyphicon-thumbs-down"
            data-vote="<?= Model_Article_Comment_Vote::VOTE_DOWN; ?>"
        ></span>
    <?php endif; ?>
</div>