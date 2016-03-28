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
            var comments = document.getElementById("comments");

            if (data.status) {
                comments.innerHTML += data.body;
            } else {
                alert(data.error);
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