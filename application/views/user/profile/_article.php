<div class="article">
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