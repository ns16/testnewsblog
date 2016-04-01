<div id="article-title-favorite">
    <button id="article-title-favorite-button" class="btn btn-default" data-article_id="<?= $article_id; ?>">
        <?= View::factory('widget/favorite/_icon')->set(array('current_user_id' => $current_user_id, 'user_ids' => $user_ids)); ?>
    </button>
</div>