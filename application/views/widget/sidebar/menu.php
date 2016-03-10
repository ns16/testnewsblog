<h3>Список статей</h3>
<div class="list-group">
    <? foreach($articles as $article): ?>
        <?= HTML::anchor('/articles/'.$article->id, $article->title,
            array(
                'class' => 'list-group-item',
            )
        ); ?>
    <? endforeach; ?>
</div>