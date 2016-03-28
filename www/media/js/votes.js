// Получить кнопки голосования для каждого из комментариев
var votes_buttons = document.getElementsByClassName("comment-votes-button");
var votes_count   = null;

// Для каждой из кнопок голосования назначить обработчик события "клик
// левой клавишей мыши"
for (var i = 0; i < votes_buttons.length; i++)
{
    votes_buttons[i].onclick = function()
    {
        votes_buttons_handler(this)
    }
}

function votes_buttons_handler(elem)
{
    // Получить элемент, в который нужно будет записать сумму голосов
    votes_count    = elem.parentElement.firstElementChild;

    // Получить идентификаторы комментария и пользователя, который этот
    // комментарий оставил, а также значение голоса, которое может быть
    // равно 1 или -1
    var comment_id = elem.parentElement.dataset.comment_id;
    var user_id    = elem.parentElement.dataset.user_id;
    var vote       = elem.dataset.value;

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
            // Вывести модальное окно с сообщением, если пользователь не
            // авторизован или если пользователь уже проголосовал за данный
            // комментарий
            if (data.message)
            {
                alert(data.message);
            }

            // Вывести сумму голосов, учитывая голос, оставленный данным
            // пользователем
            if (data.sum_votes)
            {
                var sum_votes_class = null;

                if (data.sum_votes > 0) {
                    sum_votes_class = "text-success";
                } else if (data.sum_votes < 0) {
                    sum_votes_class = "text-danger";
                } else {
                    sum_votes_class = "";
                }

                var sum_votes_html =
                    "<span class='comment-votes-count " +
                    sum_votes_class + "'>" + data.sum_votes + "</span>";

                votes_count.innerHTML = sum_votes_html;
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