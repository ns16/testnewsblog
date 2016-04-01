<div class="article">
    <img src="http://fakeimg.pl/260x180/EEEEEE/AAA/?text=260x180" alt="">
    <div class="article-caption">
        <div class="article-caption-title">
            <?= $article->title; ?>
        </div>
        <div class="article-caption-buttons">
            <a href="<?= URL::get_default_url('articles', '', $article->id); ?>" class="btn btn-default">Подробнее</a>
            <a class="article-caption-button-delete btn btn-default" data-article_id="<?= $article->id; ?>">Удалить</a>
        </div>
    </div>
</div>