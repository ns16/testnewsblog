// Получить кнопки удаления комментариев
var comment_buttons = document.getElementsByClassName("comment-button-delete");

// Для каждой кнопки удаления комментария назначить обработчик события "клик левой
// клавишей мыши"

for (var i = 0; i < comment_buttons.length; i++)
{
    comment_buttons[i].onclick = function() {
        comment_buttons_handler(this);
    }
}

function comment_buttons_handler(elem)
{
    // Получить идентификатор комментария
    var comment_id = elem.dataset.comment_id;

    $.ajax({
        url: "/comments/delete",
        type: "post",
        data: {
            comment_id: comment_id
        },
        dataType: "json",
        success: function(data)
        {
            if (data.status) {
                var comment = elem.closest(".comment");
                comment.remove();
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