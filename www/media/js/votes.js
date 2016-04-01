// Получить кнопки голосования для каждого комментария
var buttons = document.getElementsByClassName("comment-votes-button");

// Для каждой кнопки голосования назначить обработчик события "клик левой клавишей
// мыши"
for (var i = 0; i < buttons.length; i++)
{
    buttons[i].onclick = function() {
        buttons_handler(this)
    }
}

function buttons_handler(elem)
{
    // Получить идентификатор комментария, идентификатор пользователя, который
    // оставил этот комментарий, и значение голоса, которое может быть равно 1
    // или -1
    var comment_id = elem.parentElement.dataset.comment_id;
    var user_id    = elem.parentElement.dataset.user_id;
    var vote       = elem.dataset.vote;

    $.ajax({
        url: "/votes/index",
        type: "post",
        data: {
            comment_id: comment_id,
            user_id: user_id,
            vote: vote
        },
        dataType: "json",
        success: function(data)
        {
            if (data.status) {
                var votes = elem.parentElement.firstElementChild;
                votes.innerHTML = data.body;
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