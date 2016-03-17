<div id="content-article">
    <h3><?= $article->title; ?></h3>
    <?= Widget::factory('favorite', array('article' => $article)); ?>
    <h5><?= Date::russian_months(strftime('%H:%M, %d %B %Y', strtotime($article->date))); ?></h5>
    <?= Text::wrap_in_p($article->content); ?>
</div>