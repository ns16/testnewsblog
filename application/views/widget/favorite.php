<div id="article-title-favorite">
    <!--<a href="<?/*= URL::get_default_url('favorites', 'index', $article_id); */?>" class="btn btn-default">-->
    <a id="article-title-favorite-button" class="btn btn-default">
        <span class="glyphicon
        <? if (in_array($current_user_id, $user_ids)): ?>
            glyphicon-star
        <? else: ?>
            glyphicon-star-empty
        <? endif; ?>
        "></span>
    </a>
</div>
<script>

    var button = document.getElementById("article-title-favorite-button");
    var span   = button.firstElementChild;

    var article_id = <?= $article_id; ?>;
    var user_id    = <?= isset($current_user_id) ? $current_user_id : 'null'; ?>;

    button.onclick = function()
    {
        toggle_favorite();
    }

    function toggle_favorite()
    {
        $.ajax({
            url: "<?= URL::get_default_url('favorites', 'index'); ?>",
            type: "POST",
            data: {
                article_id: article_id,
                user_id: user_id
            },
            dataType: "json"
        })
        .done(function(json) {

//            span.classList.toggle(json.class);

            $(span).toggleClass(json.class);
            alert(json.message);

        });
    }

</script>