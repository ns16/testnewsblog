<div class="comment">
    <div class="comment-info">
        <div class="comment-info-date">
            <?= $comment->date; ?>
        </div>
        <div class="comment-info-votes
            <?php if ($sum_votes > 0): ?>
                text-success
            <?php elseif ($sum_votes < 0): ?>
                text-danger
            <?php endif; ?>
        ">
            <span><?= $sum_votes; ?></span>
            <span class="glyphicon glyphicon-flash"></span>
        </div>
    </div>
    <div class="comment-content">
        <?= $comment->content; ?>
    </div>
    <div class="comment-article">
        <span>К статье: </span>
        <a href="<?= URL::get_default_url('articles', '', $comment->article->id); ?>"><?= $comment->article->title; ?></a>
    </div>

    <a class="comment-button-delete" data-comment_id="<?= $comment->id; ?>">
        <span class="glyphicon glyphicon-remove"></span>
    </a>
</div>