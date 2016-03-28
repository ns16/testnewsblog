<div id="article-title-favorite">
    <button id="article-title-favorite-button" class="btn btn-default">
        <span class="glyphicon
        <?php if (in_array($current_user_id, $user_ids)): ?>
            glyphicon-star
        <?php else: ?>
            glyphicon-star-empty
        <?php endif; ?>
        "></span>
    </button>
</div>
<script>

    var favorite_button = document.getElementById("article-title-favorite-button");
    var favorite_span   = favorite_button.firstElementChild;

    var article_id = <?= $article_id; ?>;
    var user_id    = <?= isset($current_user_id) ? $current_user_id : 'null'; ?>;

    favorite_button.onclick = function()
    {
        favorite_button_handler();
    }

    function favorite_button_handler()
    {
        $.ajax({
            url: "/favorites/index",
            type: "POST",
            data: {
                article_id: article_id,
                user_id: user_id
            },
            dataType: "json",
            success: function(data) {
                $(favorite_span).toggleClass(data.class);
                alert(data.message);
            },
            error: function(jqXHR) {
                console.log(
                    'Error: ' + jqXHR.status +
                    ', Message: ' + jqXHR.statusText
                );
            }
        });
    }

</script>