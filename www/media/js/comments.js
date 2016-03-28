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