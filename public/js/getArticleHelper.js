$(document).ready(function () {
    $('#reply_comment').click(function () {
        postReplyComment(sessionStorage.getItem('comment_id'), sessionStorage.getItem('article_id'));
    });
});

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
function getArticleDetail(article_id) {
    getOneArticle(article_id);
    getCommentByOneArticle(article_id);
}
