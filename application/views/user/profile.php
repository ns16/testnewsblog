<div id="container">
    <div id="information" class="block">
        <div id="information-avatar" class="col-md-3">
            <?= Files::display($user_id); ?>
        </div>
        <div id="information-personal" class="col-md-6">
            <div class="col-md-12">
                <h3><?= $username; ?></h3>
            </div>
            <? foreach ($personal_data as $key => $value): ?>
                <div class="information-personal-item col-md-12">
                    <span class="col-md-3">
                        <?= $key; ?>:
                    </span>
                    <span class="col-md-9">
                        <?= $value; ?>
                    </span>
                </div>
            <? endforeach; ?>
        </div>
        <div id="information-social" class="col-md-3">
            <div id="information-social-block">
                <a href="<?= URL::get_user_default_url('settings', 'personal', $user_id); ?>" id="information-social-button" class="btn btn-default">Настройки</a>
                <? foreach ($social_data as $key => $value): ?>
                    <? if ($value): ?>
                        <a href="<?= $value; ?>" class="information-social-icons btn btn-default">
                            <span class="<?= $key; ?>"></span>
                        </a>
                    <? endif; ?>
                <? endforeach; ?>
            </div>
        </div>
    </div>
    <div id="statistic" class="block">
        <div class="col-md-4">
            <span class="glyphicon glyphicon-flash"></span>
            <span>Рейтинг:</span>
            <span id="conteiner-votes">
                <?= $sum_votes; ?>
            </span>
        </div>
        <div class="col-md-4">
            <span class="glyphicon glyphicon-comment"></span>
            <span>Комментарии:</span>
            <span id="conteiner-comments">
                <?= $comments_count; ?>
            </span>
        </div>
        <div class="col-md-4">
            <span class="glyphicon glyphicon-star"></span>
            <span>Избранные статьи:</span>
            <span id="conteiner-articles">
                <?= $articles_count; ?>
            </span>
        </div>
    </div>
    <div id="comments" class="block col-md-12">
        <h4>Комментарии к статьям</h4>
        <? foreach($comments as $comment): ?>
            <? $sum_votes = $comment->votes->get_sum_votes_comment(); ?>
            <div class="comment">
                <div class="thumbnail">
                    <div class="comment-info">
                        <div class="comment-info-date">
                            <?= $comment->date; ?>
                        </div>
                        <div class="comment-info-votes
                            <? if ($sum_votes > 0): ?>
                                text-success
                            <? elseif ($sum_votes < 0): ?>
                                text-danger
                            <? endif; ?>
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
                        <a href="<?= URL::get_default_url('articles', 'index', $comment->article->id); ?>"><?= $comment->article->title; ?></a>
                    </div>
                </div>
            </div>
        <? endforeach; ?>
    </div>
    <div id="articles" class="block col-md-12">
        <h4>Избранные статьи</h4>
        <? foreach($articles as $article): ?>
            <div class="article">
                <div class="thumbnail">
                    <img src="http://fakeimg.pl/260x180/EEEEEE/AAA/?text=260x180" alt="">
                    <div class="article-caption">
                        <div class="article-caption-title">
                            <?= $article->title; ?>
                        </div>
                        <div class="article-caption-buttons">
                            <a href="<?= URL::get_default_url('articles', 'index', $article->id) ?>" class="btn btn-default">Подробнее</a>
                            <a href="<?= URL::get_default_url('articles', 'index', $article->id) ?>" class="btn btn-default">Удалить</a>
                        </div>
                    </div>
                </div>
            </div>
        <? endforeach; ?>
    </div>
</div>