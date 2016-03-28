<div id="comments">
    <?php if ($comments->count()): ?>
        <h4>Комментарии</h4>
        <?php foreach ($comments as $comment): ?>
            <?= View::factory('widget/comments/_comment')->set('comment', $comment); ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?= Widget::factory('comments_form', array('article' => $article)); ?>