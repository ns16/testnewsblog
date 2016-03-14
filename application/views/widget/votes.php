<div class="comment-votes">
    <span class="comment-votes-count
        <? if ($sum_votes > 0): ?>
            text-success
        <? elseif ($sum_votes < 0): ?>
            text-danger
        <? endif; ?>
    ">
        <?= $sum_votes; ?>
    </span>
    <? if ($current_user_id !== $comment->user_id): ?>
        <a href="<?= URL::get_default_url('votes', 'up').URL::query(
            array(
                'article_id' => $comment->article_id,
                'comment_id' => $comment->id,
                'user_id'    => $comment->user_id,
            )); ?>" class="comment-votes-up btn btn-default">
            <span class="glyphicon glyphicon-thumbs-up"></span>
        </a>
        <a href="<?= URL::get_default_url('votes', 'down').URL::query(
            array(
                'article_id' => $comment->article_id,
                'comment_id' => $comment->id,
                'user_id'    => $comment->user_id,
            )); ?>" class="comment-votes-down btn btn-default">
            <span class="glyphicon glyphicon-thumbs-down"></span>
        </a>
    <? endif; ?>
</div>
<script>

    var buttons = document.getElementsByClassName("btn");

    var comment_id = <?= $comment->id; ?>;
    var user_id = <?= $comment->user_id; ?>;
    var vote = null;

//    for(var i = 0; i < buttons.length; i++)
//    {
//        buttons[i].onclick = function()
//        {
//            if(this.class == "comment-votes-up")
//            {
//                vote = 1;
//            }
//            else
//            {
//                vote = -1;
//            }
//
////            send_vote();
//        }
//    }

    function send_vote()
    {
        $.ajax({
                url: "/votes/addition",
                type: "post",
                data: {
                    comment_id: comment_id,
                    id_user: user_id,
                    vote: vote,
                },
                dataType: "json"
            })
            .done(function(json) {

                console.log(json);
//                document.getElementById("comment-rating-count").innerHTML = html;

            });
    }

</script>