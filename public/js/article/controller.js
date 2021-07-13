$(document).ready(function () {
    getChangeSelectValueFromForum();
    getAllArticle();

    $('#article_post').click(function () {
        articlePost();
    });

    $('#reply_comment').click(function () {
        postReplyComment(sessionStorage.getItem('comment_id'), sessionStorage.getItem('article_id'));
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
        url: 'api/article',
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
        url: 'api/article',
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
                $('#article_body').append('<div class="card mb-2">尚無文章</div>');
                return;
            }
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

function getOneArticle(article_id) {
    sessionStorage.setItem('has_back', "true");
    $.ajax({
        url: 'api/article/'+article_id,
        type: "GET",
        data: {
        },
        success: function (success) {
            $('#article_detail').empty();
            $('#post_comment_aria').empty();
            $('#article_operation').empty();
            let data = success.return_data;
            let color = 'black';
            if (data.current_favor >= 1) color = 'blue';
            $('#article_detail').append('<div class="media forum-item">\n' +
                '                                <a class="card-link">\n' +
                '                                    <img src="/images/forum_man.png" class="rounded-circle" width="50" alt="User" />\n' +
                '                                </a>\n' +
                '                                <div class="media-body ml-3">\n' +
                '                                    <a style="color: blue" class="text-secondary">'+data.username+'</a>\n' +
                '                                    <small class="text-muted ml-2">'+data.created_at+'</small>\n' +
                '                                    <h5 class="mt-1">['+data.board_name+'] '+data.title+'</h5>\n' +
                '                                    <div class="mt-3 font-size-sm">\n' +
                                                        data.content+
                '                                    </div>\n' +
                '                                </div>\n' +
                '                                <div class="text-muted small text-center">\n' +
                '                                    <span class="d-none d-sm-inline-block"><i class="fas fa-thumbs-up"></i>'+data.favor+'</span>\n' +
                '                                    <span><i class="far fa-comment ml-2"></i>'+data.comments+'</span>\n' +
                '                                </div>\n' +
                '                            </div>');
            $('#post_comment_aria').append('<button class="btn btn-primary btn-sm shadow-none" type="button" id="post_comment" onclick="postComment('+data.id+')">Post comment</button>');
            $('#article_operation').append('<div class="like p-2 cursor"><span class="ml-1" onclick="updateArticleFavor('+data.id+')"><i class="fas fa-thumbs-up" style="color: '+color+'"></i> Like</span></div>\n' +
                '                                <div class="like p-2 cursor action-collapse" data-toggle="collapse" aria-expanded="true" aria-controls="collapse-1" href="#collapse-1"><i class="far fa-comment"></i><span class="ml-1" id="comment_span">Comment</span></div>');
            if (sessionStorage.getItem('my_article') == 1) {
                $('#article_operation').append('<div class="like p-2 cursor"><span class="ml-1" onclick="showEditArticleData('+article_id+')" data-toggle="modal" data-target="#editArticleModal"><i class="fas fa-pencil-alt" style="color: darkorange"></i> Edit</span></div>');
                $('#article_operation').append('<div class="like p-2 cursor"><span class="ml-1" onclick="removeArticle('+article_id+')"><i class="fas fa-trash-alt" style="color: red"></i> Remove</span></div>');
            }
        },
        error: function (error) {
            alert(error.responseJSON.status_message);
            console.log(error);
        }
    })
}

function updateArticleFavor(article_id) {
    $.ajax({
        url: 'api/article/'+article_id+'/favor',
        type: "PATCH",
        data: {
        },
        success: function (success) {
            console.log(success);
            getOneArticle(article_id);
        },
        error: function (error) {
            alert(error.responseJSON.status_message);
            console.log(error);
        }
    })
}

function getCommentByOneArticle(article_id) {
    $.ajax({
        url: 'api/article/'+article_id+'/comment',
        type: "GET",
        data: {
        },
        success: function (success) {
            console.log(success);
            $('#all_comment').empty();
            let comment = "";
            let reply_comment = "";
            if (success.code === '1202') {
                comment = "尚無留言";
            } else {
                $.each(success.return_data.data, function (key, val) {
                    reply_comment = "";
                    $.each(val.reply_comment, function (reply_key, reply_val) {
                        reply_comment +=' <div class="card-body">' +
                            ' <div class="media forum-item">\n' +
                            '                                <a  class="card-link">\n' +
                            '                                    <img src="/images/forum_man.png" class="rounded-circle" width="50" alt="User" />\n' +
                            '                                </a>\n' +
                            '                                <div class="media-body ml-3">\n' +
                            '                                    <a class="text-secondary">'+reply_val.username+'</a>\n' +
                            '                                    <small class="text-muted ml-2">'+reply_val.updated_at+'</small>\n' +
                            '                                    <div class="mt-3 font-size-sm">\n' +
                                                                    reply_val.comment+
                            '                                    </div>\n' +
                            '                                </div>\n' +
                            '                            </div>' +
                            '</div>';
                    });

                    comment += ' <div class="card-body">' +
                        ' <div class="media forum-item">\n' +
                        '                                <a  class="card-link">\n' +
                        '                                    <img src="/images/forum_women.png" class="rounded-circle" width="50" alt="User" />\n' +
                        '                                </a>\n' +
                        '                                <div class="media-body ml-3">\n' +
                        '                                    <a class="text-secondary">'+val.username+'</a>\n' +
                        '                                    <small class="text-muted ml-2">'+val.updated_at+'</small>\n' +
                        '                                    <div class="mt-3 font-size-sm">\n' +
                                                                val.comment+'\n'+reply_comment+
                        '                                    </div>\n' +
                        '                                </div>\n' +
                        '                                <small><a id="reply_btn" onclick="setData('+val.id+', '+article_id+')" href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal"><span><i class="fa fa-reply"></i> reply</span></a href="javascript:void(0)" ></small>\n' +
                        '                            </div>' +
                        '</div>';
                });
            }
            $('#all_comment').append(comment);
        },
        error: function (error) {
            alert(error.responseJSON.status_message);
            console.log(error);
        }
    })
}

function getArticleDetail(article_id) {
    getOneArticle(article_id);
    getCommentByOneArticle(article_id);
}

function postComment(article_id) {
    let comment = $('#comment_detail').val();
    $.ajax({
        url: 'api/article/'+article_id+'/comment',
        type: "POST",
        data: {
            comment: comment
        },
        success: function (success) {
            console.log(success);
            $('#comment_span').click();
            $('#comment_detail').val("");
            getCommentByOneArticle(article_id);
            getOneArticle(article_id);
        },
        error: function (error) {
            alert(error.responseJSON.status_message);
            console.log(error);
        }
    })

}

function postReplyComment(comment_id, article_id) {
    let comment = $('#reply_comment_detail').val();
    $.ajax({
        url: 'api/comment/'+comment_id+'/reply',
        type: "POST",
        data: {
            comment: comment,
            article_id: article_id
        },
        success: function (success) {
            console.log(success);
            $('#reply_comment_detail').val("");
            getCommentByOneArticle(article_id);
            getOneArticle(article_id);
        },
        error: function (error) {
            alert(error.responseJSON.status_message);
            console.log(error);
        }
    })

}

function setData(comment_id, article_id) {
    sessionStorage.setItem('comment_id', comment_id);
    sessionStorage.setItem('article_id', article_id);
}

function removeArticle(article_id) {
    if (confirm('確定要刪除文章嗎？')) {
        $.ajax({
            url: 'api/article/'+article_id,
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
        url: 'api/article/'+article_id,
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
        url: 'api/article/'+article_id,
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
