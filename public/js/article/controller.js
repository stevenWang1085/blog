$(document).ready(function () {
    getChangeSelectValueFromForum();
    getAllArticle();

    $('#article_post').click(function () {
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
    });
    $('#article_back').click(
        function () {
            getAllArticle();
        }
    );

});

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
    $.ajax({
        url: 'api/article',
        type: "GET",
        data: {
            title: title,
            contents: contents,
            board_id: board_id,
            order_column: sessionStorage.getItem('order_column'),
            order_column_by: sessionStorage.getItem('order_column_by')
        },
        success: function (success) {
            console.log(success);
            $('#article_body').empty();
            let body = "";
            $.each(success.return_data.data, function (key, val) {
            body += '                    <div class="card mb-2">\n' +
                '                        <div class="card-body p-2 p-sm-3">\n' +
                '                            <div class="media forum-item">\n' +
                '                                <a href="#" data-toggle="collapse" data-target=".forum-content"><img src="/images/forum_man.png" class="mr-3 rounded-circle" width="50" alt="User" /></a>\n' +
                '                                <div class="media-body">\n' +
                '                                    <h6><a href="javascript:void(0)" data-toggle="collapse" data-target=".forum-content" class="text-body" onclick="getArticleDetail('+val.id+')">'+val.title+'</a></h6>\n' +
                '                                    <p class="text-secondary" style="overflow: hidden; text-overflow: ellipsis; width: 7em; height: 3em" >\n' +
                '                                        '+val.content+' </p>\n' +
                '                                    <p class="text-muted"><a href="javascript:void(0)">'+val.username+'</a> 發表於 <span class="text-secondary font-weight-bold">'+val.created_at+'</span></p>\n' +
                '                                </div>\n' +
                '                                <div class="text-muted small text-center align-self-center">\n' +
                '                                    <span class="d-none d-sm-inline-block"><i class="fas fa-thumbs-up"></i> '+val.favor+'</span>\n' +
                '                                    <span><i class="far fa-comment ml-2"></i>'+val.comments+'</span>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                        </div>\n' +
                '                    </div>';

            });
            $('#article_body').append(body);

        },
        error: function (error) {
            alert(error.responseJSON.status_message);
            console.log(error);
        }
    })
}

function getOneArticle(article_id) {
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
                '                                <a href="javascript:void(0)" class="card-link">\n' +
                '                                    <img src="/images/forum_man.png" class="rounded-circle" width="50" alt="User" />\n' +
                '                                    <small class="d-block text-center text-muted">Newbie</small>\n' +
                '                                </a>\n' +
                '                                <div class="media-body ml-3">\n' +
                '                                    <a href="javascript:void(0)" class="text-secondary">'+data.username+'</a>\n' +
                '                                    <small class="text-muted ml-2">'+data.created_at+'</small>\n' +
                '                                    <h5 class="mt-1">'+data.title+'</h5>\n' +
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
            if (success.code === '1202') {
                comment = "尚無留言";
            } else {
                $.each(success.return_data.data, function (key, val) {
                    comment += ' <div class="card-body">' +
                        ' <div class="media forum-item">\n' +
                        '                                <a href="javascript:void(0)" class="card-link">\n' +
                        '                                    <img src="/images/forum_women.png" class="rounded-circle" width="50" alt="User" />\n' +
                        '                                    <small class="d-block text-center text-muted">Pro</small>\n' +
                        '                                </a>\n' +
                        '                                <div class="media-body ml-3">\n' +
                        '                                    <a href="javascript:void(0)" class="text-secondary">'+val.username+'</a>\n' +
                        '                                    <small class="text-muted ml-2">'+val.updated_at+'</small>\n' +
                        '                                    <div class="mt-3 font-size-sm">\n' +
                                                                val.comment+
                        '                                    </div>\n' +
                        '                                </div>\n' +
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
