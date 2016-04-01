<div id="container">
    <div id="information" class="block">
        <div id="information-avatar">
            <?= Files::display($user_id, TRUE); ?>
        </div>
        <div id="information-personal">
            <div id="information-personal-title">
                <h3><?= $username; ?></h3>
            </div>
            <?php foreach ($personal_data as $key => $value): ?>
                <?php if ($value): ?>
                    <div class="information-personal-item">
                        <span><?= $key; ?>:</span>
                        <span><?= $value; ?></span>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div id="information-social">
            <div id="information-social-button">
                <a href="<?= URL::get_user_default_url('settings', 'personal', $user_id); ?>" id="information-social-button" class="btn btn-default">Настройки</a>
            </div>
            <div id="information-social-icons">
                <?php foreach ($social_data as $key => $value): ?>
                    <?php if ($value): ?>
                        <a href="<?= $value; ?>" class="information-social-icon btn btn-default">
                            <span class="<?= $key; ?>"></span>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div id="statistic" class="block">
        <div class="statistic-item">
            <span class="glyphicon glyphicon-flash"></span>
            <span>Рейтинг:</span>
            <span><?= $sum_votes; ?></span>
        </div>
        <div class="statistic-item">
            <span class="glyphicon glyphicon-comment"></span>
            <span>Комментарии:</span>
            <span><?= $comments_count; ?></span>
        </div>
        <div class="statistic-item">
            <span class="glyphicon glyphicon-star"></span>
            <span>Избранные статьи:</span>
            <span><?= $articles_count; ?></span>
        </div>
    </div>
    <div id="comments" class="block">
        <h4>Комментарии к статьям</h4>
        <?php if ($comments_count): ?>
            <?php foreach($comments as $comment): ?>
                <?php $sum_votes = $comment->votes->get_sum_votes_comment(); ?>
                <?= View::factory('user/profile/_comment')->set(array('user_id' => $user_id, 'comment' => $comment, 'sum_votes' => $sum_votes)); ?>
            <?php endforeach; ?>
        <?php else: ?>
            <div id="comments-message">У вас нет комментариев к статьям</div>
        <?php endif; ?>
    </div>
    <div id="articles" class="block">
        <h4>Избранные статьи</h4>
        <?php if ($articles_count): ?>
            <?php foreach($articles as $article): ?>
                <?= View::factory('user/profile/_article')->set('article', $article); ?>
            <?php endforeach; ?>
        <?php else: ?>
            <div id="articles-message">У вас нет избранных статей</div>
        <?php endif; ?>
    </div>
</div>