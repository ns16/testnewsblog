<span id="content-article-favorite">
    <a href="<?= URL::get_default_url('articles', 'favorite', $article_id); ?>" class="btn btn-default">
        <span class="glyphicon
        <? if (in_array($current_user_id, $user_ids)): ?>
            glyphicon-star
        <? else: ?>
            glyphicon-star-empty
        <? endif; ?>
        "></span>
    </a>
</span>
<script>

//    var buttons = document.getElementsByClassName("btn");

//    var comment_id = <?//= $comment->id; ?>//;
//    var user_id = <?//= $comment->user_id; ?>//;
//    var vote = null;

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

//    function send_vote()
//    {
//        $.ajax({
//                url: "/votes/addition",
//                type: "post",
//                data: {
//                    comment_id: comment_id,
//                    id_user: user_id,
//                    vote: vote,
//                },
//                dataType: "json"
//            })
//            .done(function(json) {
//
//                console.log(json);
////                document.getElementById("comment-rating-count").innerHTML = html;
//
//            });
//    }

</script>