// Получить кнопки удаления статей из избранного
var article_buttons = document.getElementsByClassName("article-caption-button-delete");

// Для каждой кнопки удаления статьи из избранного назначить обработчик события
// "клик левой клавишей мыши"
for (var i = 0; i < article_buttons.length; i++)
{
    article_buttons[i].onclick = function() {
        article_buttons_handler(this);
    }
}

function article_buttons_handler(elem)
{
    // Получить идентификатор статьи
    var article_id = elem.dataset.article_id;

    $.ajax({
        url: "/favorites/index",
        type: "post",
        data: {
            article_id: article_id
        },
        dataType: "json",
        success: function(data)
        {
            if (data.status) {
                var article = elem.closest(".article");
                article.remove();
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