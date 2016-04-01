<span
    <?php if ($sum_votes > 0): ?>
        class="text-success"
    <?php elseif ($sum_votes < 0): ?>
        class="text-danger"
    <?php endif; ?>
>
    <?= $sum_votes; ?>
</span>