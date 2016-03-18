<span id="content-article-title-favorite">
    <a href="<?= URL::get_default_url('articles', 'favorite', $article_id); ?>" class="btn btn-default">
        <span class="glyphicon
        <? if (in_array($current_user_id, $user_ids)): ?>
            glyphicon-star
        <? else: ?>
            glyphicon-star-empty
        <? endif; ?>
        "></span>
    </a>
</span>