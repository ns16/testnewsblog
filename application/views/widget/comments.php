<div id="comments">
    <?php if ($comments->count()): ?>
        <h4>Комментарии</h4>
        <?php foreach ($comments as $comment): ?>
            <div class="comment">
                <div class="comment-info">
                    <strong><?= $comment->user->username; ?></strong> /
                    <em><?= Date::rus_date_format($comment->date); ?></em>
                </div>
                <div class="comment-content">
                    <?= Text::wrap_in_p($comment->content); ?>
                </div>
                <?= Widget::factory('votes', array('comment' => $comment)); ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<?= Widget::factory('comments_form', array('article' => $article)); ?>
<script>

    var submit   = document.getElementById("comments-form-main-submit");
    var textarea = document.getElementById("comments-form-main-textarea");

    submit.onclick = function()
    {
        var article_id = this.dataset.article_id;
        var content    = textarea.value;

        $.ajax({
            url: "/comments/form",
            type: "post",
            data: {
                article_id: article_id,
                content: content
            },
            dataType: "json",
            success: function(data)
            {
                if (data.message)
                {
                    alert(data.message);
                }

                if (content)
                {
                    var comments = document.getElementById("comments");

                    var comment_html =
                        "<div class='comment'>" +
                            "<div class='comment-info'>" +
                                "<strong>" + data.username + "</strong> / " +
                                "<em>" + data.date + "</em>" +
                            "</div>" +
                            "<div class='comment-content'>" +
                                content +
                            "</div>" +
                            data.widget +
                        "</div>";

                    comments.innerHTML += comment_html;

                    textarea.value = '';
                }
            },
            error: function(jqXHR)
            {
                console.log(
                    'Error: ' + jqXHR.status +
                    ', Message: ' + jqXHR.statusText
                );
            }
        });
    }

</script>