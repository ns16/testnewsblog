// Получить кнопку отправки формы и текстовую область
var submit   = document.getElementById("comments-form-main-submit");
var textarea = document.getElementById("comments-form-main-textarea");

// Для кнопки отправки формы назначить обработчик события "клик левой клавишей мыши"
submit.onclick = function()
{
    // Получить идентификатор статьи, к которой пользователь оставил комментарий, и
    // содержание комментария
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
            if (data.status) {
                var comments = document.getElementById("comments");
                comments.innerHTML += data.body;
                textarea.value = "";
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