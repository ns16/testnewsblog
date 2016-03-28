<h3>Список статей</h3>
<div class="list-group">
    <?php foreach($articles as $article): ?>
        <?= HTML::anchor('/articles/'.$article->id, $article->title, array(
            'class' => 'list-group-item',
        )); ?>
    <?php endforeach; ?>
</div>