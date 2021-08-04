$(document).ready(function () {
    getChangeSelectValueFromForum();
    getAllArticle();

    $('#article_post').click(function () {
        articlePost();
    });

    $('#confirm_edit_article').click(function () {
        confirmEditArticle();
    });
    homeBarActive();
    $('#article_detail_close').click(function () {
        getAllArticle($('#search_article_title').val());
    });
    changePerPage();
    searchArticleTitleContent();
});

function searchArticleTitleContent() {
    $('#search_article_title').change(function () {
        getAllArticle($('#search_article_title').val());
    });
}

function articlePost() {
    let title = $('#article_title').val();
    let content = $('#article_content').val();
    let board = $('#board_select').val();

    $.ajax({
        url: 'api/v1/article',
        type: "POST",
        data: {
            board_id: board,
            title: title,
            content: content,
        },
        success: function (success) {
            location.reload();
            console.log(success);
        },
        error: function (error) {
            alert(error.responseJSON.status_message);
            console.log(error);
        }
    })
}

function homeBarActive() {

    $('#home').click(function () {
        sessionStorage.setItem('my_article', 0);
        $('.from_bar').removeClass('active');
        $('#home').addClass('active');
        sessionStorage.setItem('board_id', null);
        sessionStorage.setItem('has_back', 'false');
        window.location.href = '/forum';
    });
    $('#my_article').click(function () {
        sessionStorage.setItem('my_article', 1);
        $('.from_bar').removeClass('active');
        $('#my_article').addClass('active');
        $('#search_article_title').val('');
        getAllArticle();
    });
    $('#my_friend').click(function () {
        $('.from_bar').removeClass('active');
        $('#my_friend').addClass('active');
    });
    $('#my_notify').click(function () {
        $('.from_bar').removeClass('active');
        $('#my_notify').addClass('active');
        sessionStorage.setItem('my_article', 0);
    });
    if (sessionStorage.getItem('my_article') === '1') {
        $('.from_bar').removeClass('active');
        $('#my_article').addClass('active');
    }
}

function getChangeSelectValueFromForum() {

    sessionStorage.setItem('order_column', $('#select_forum_list').val());
    sessionStorage.setItem('order_column_by', $('#select_forum_type').val());

    $('#select_forum_list').on('change', function () {
        sessionStorage.setItem('order_column', $('#select_forum_list').val());
        getAllArticle();
    })

    $('#select_forum_type').on('change', function () {
        sessionStorage.setItem('order_column_by', $('#select_forum_type').val());
        getAllArticle();
    })
}

function getAllArticle(title = null, contents = null, board_id = null) {

    let page_button_num = $('#current_page').val();
    let per_page = $('#per_page').val();

    $.ajax({
        url: 'api/v1/article',
        type: "GET",
        data: {
            title: title,
            contents: contents,
            board_id: sessionStorage.getItem('board_id'),
            order_column: sessionStorage.getItem('order_column'),
            order_column_by: sessionStorage.getItem('order_column_by'),
            edited_user_id: sessionStorage.getItem('my_article'),
            page: page_button_num,
            per_page: per_page,
        },
        success: function (success) {
            $('#article_body').empty();
            let body = "";
            if (success.return_data === null) {
                $('#total_data_num').html(0);
                $('#article_body').append('<div class="card mb-2">尚無文章</div>');
                return;
            }
            $('#total_data_num').html(success.return_data.total);
            $.each(success.return_data.data, function (key, val) {
            body += '                    <div class="card mb-2">\n' +
                '                        <div class="card-body p-2 p-sm-3">\n' +
                '                            <div class="media forum-item">\n' +
                '                                <a><img src="/images/forum_man.png" class="mr-3 rounded-circle" width="50" alt="User" /></a>\n' +
                '                                <div class="media-body">\n' +
                '                                    <h6><a href="javascript:void(0)" class="text-body" data-toggle="modal" data-target="#exampleModalLong" onclick="getArticleDetail('+val.id+')">['+val.board_name+'] '+val.title+'</a></h6>\n' +
                '                                    <p class="text-secondary" style="overflow: hidden; text-overflow: ellipsis; width: 7em; height: 3em" >\n' +
                '                                        '+val.content+' </p>\n' +
                '                                    <p class="text-muted"><a style="color: blue">'+val.username+'</a> 發表於 <span class="text-secondary font-weight-bold">'+val.created_at+'</span></p>\n' +
                '                                </div>\n' +
                '                                <div class="text-muted small text-center align-self-center">\n' +
                '                                    <span class="d-none d-sm-inline-block"><i class="fas fa-thumbs-up" style="color: cornflowerblue"></i> '+val.favor+'</span>\n' +
                '                                    <span><i class="far fa-comment ml-2" style="color: orangered"></i>'+val.comments+'</span>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                        </div>\n' +
                '                    </div>';

            });
            $('#article_body').append(body);
            buildPageButtons(success.return_data, 'getAllArticle');
            $('#page_button_' + page_button_num).addClass('active');

        },
        error: function (error) {
            alert(error.responseJSON.status_message);
            console.log(error);
        }
    })
}

function changePerPage() {
    $('#per_page').change(function () {
        sessionStorage.setItem('per_page', 'true');
        getAllArticle();
    });
}









function removeArticle(article_id) {
    if (confirm('確定要刪除文章嗎？')) {
        $.ajax({
            url: 'api/v1/article/'+article_id,
            type: "DELETE",
            data: {
            },
            success: function (success) {
                alert(success.status_message);
                $('#article_detail_close').click();
            },
            error: function (error) {
                alert(error.responseJSON.status_message);
                console.log(error);
            }
        })
    }
}

function showEditArticleData(article_id) {
    sessionStorage.setItem('confirm_edit_article_id', article_id);
    $.ajax({
        url: 'api/v1/article/'+article_id,
        type: "GET",
        data: {
        },
        success: function (success) {
            let data = success.return_data;
            $('#edit_article_title').val(data.title);
            $('#edit_article_content').val(data.content);
        },
        error: function (error) {
            alert(error.responseJSON.status_message);
            console.log(error);
        }
    })
}

function confirmEditArticle() {
    let article_id = sessionStorage.getItem('confirm_edit_article_id');
    $.ajax({
        url: 'api/v1/article/'+article_id,
        type: "PATCH",
        data: {
            title: $('#edit_article_title').val(),
            content: $('#edit_article_content').val()
        },
        success: function (success) {
           alert(success.status_message);
           getOneArticle(article_id);
        },
        error: function (error) {
            alert(error.responseJSON.status_message);
            console.log(error);
        }
    })
}
