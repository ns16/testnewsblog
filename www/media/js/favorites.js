// Получить кнопку добавления статьи в избранное
var button = document.getElementById("article-title-favorite-button");

// Для кнопки добавления статьи в избранное назначить обработчик события "клик
// левой клавишей мыши"
button.onclick = function()
{
    // Получить идентификатор статьи
    var article_id = this.dataset.article_id;

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
                button.innerHTML = data.body;
                alert(data.message);
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