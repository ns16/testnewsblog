<div id="container">
    <div class="block">
        <div id="container-avatar" class="col-md-3">
            <?= Files::display($user_id); ?>
        </div>
        <div id="container-personal" class="col-md-6">
            <div class="col-md-12">
                <h3><?= $username; ?></h3>
            </div>
            <? foreach ($personal_data as $key => $value): ?>
                <div class="container-personal-item col-md-12">
                    <span class="col-md-3">
                        <?= $key; ?>:
                    </span>
                    <span class="col-md-9">
                        <?= $value; ?>
                    </span>
                </div>
            <? endforeach; ?>
        </div>
        <div id="container-social" class="col-md-3">
            <div id="container-social-block">
                <a href="<?= URL::get_user_default_url('settings', 'personal', $user_id); ?>" id="container-social-button" class="btn btn-default">Настройки</a>
                <? foreach ($social_data as $key => $value): ?>
                    <? if ($value): ?>
                        <a href="<?= $value; ?>" class="container-social-icons btn btn-default">
                            <span class="<?= $key; ?>"></span>
                        </a>
                    <? endif; ?>
                <? endforeach; ?>
            </div>
        </div>
    </div>
    <div class="block">
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
    <div class="block">
        <h4>Комментарии к статьям</h4>
        <? foreach($comments as $comment): ?>
            <div class="comment">
                <div class="comment-date"><?= $comment->date; ?></div>
                <div class="comment-votes"><?= $comment->votes->get_sum_votes_comment(); ?></div>
                <div class="comment-content"><?= $comment->content; ?></div>
                <div class="comment-article">К статье: <a href="<?= URL::get_default_url('articles', 'index', $comment->article->id); ?>"><?= $comment->article->title; ?></a></div>
            </div>
        <? endforeach; ?>
    </div>
    <div class="block">
        <h4>Избранные статьи</h4>
        <? foreach($articles as $article): ?>
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail">
                    <img src="http://fakeimg.pl/260x180/EEEEEE/AAA/?text=260x180" alt="">
                    <div class="caption">
                        <p><?= $article->title; ?></p>
                        <p>
                            <a href="<?= URL::get_default_url('articles', 'index', $article->id) ?>" class="btn btn-default">Подробнее</a>
                        </p>
                    </div>
                </div>
            </div>
        <? endforeach; ?>
    </div>
</div>