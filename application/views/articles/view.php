<div id="article">
    <div id="article-title">
        <h3>
            <?= $article->title; ?>
        </h3>
        <?= Widget::factory('favorite', array('article' => $article)); ?>
    </div>
    <div id="article-date">
        <?= Date::rus_date_format($article->date); ?>
    </div>
    <div id="article-content">
        <?= Text::wrap_in_p($article->content); ?>
    </div>
</div>

<?= Widget::factory('comments', array('article' => $article)); ?>