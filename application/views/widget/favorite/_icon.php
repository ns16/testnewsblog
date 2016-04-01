<span id="article-title-favorite-button-icon"
    <?php if (in_array($current_user_id, $user_ids)): ?>
        class="glyphicon glyphicon-star"
    <?php else: ?>
        class="glyphicon glyphicon-star-empty"
    <?php endif; ?>
></span>