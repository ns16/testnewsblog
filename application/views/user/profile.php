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
                <div class="comment">
                    <div class="thumbnail">
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
                    </div>
                    <a class="comment-remove" href="<?= URL::get_default_url('comments', 'delete').URL::query(
                        array(
                            'comment_id' => $comment->id,
                            'user_id'    => $user_id,
                        )); ?>">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div id="comments-message">У вас нет комментариев к статьям</div>
        <?php endif; ?>
    </div>
    <div id="articles" class="block">
        <h4>Избранные статьи</h4>
        <?php if ($articles_count): ?>
        <?php foreach($articles as $article): ?>
            <div class="article">
                <div class="thumbnail">
                    <img src="http://fakeimg.pl/260x180/EEEEEE/AAA/?text=260x180" alt="">
                    <div class="article-caption">
                        <div class="article-caption-title">
                            <?= $article->title; ?>
                        </div>
                        <div class="article-caption-buttons">
                            <a href="<?= URL::get_default_url('articles', '', $article->id); ?>" class="btn btn-default">Подробнее</a>
                            <a href="<?= URL::get_url('favorites_default', 'profile', 'index', $article->id, 'favorites'); ?>" class="btn btn-default">Удалить</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <?php else: ?>
            <div id="articles-message">У вас нет избранных статей</div>
        <?php endif; ?>
    </div>
</div>