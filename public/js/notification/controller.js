$(document).ready(function () {
    getNotifications('unread');

    $('#my_article').click(function () {
        sessionStorage.setItem('my_article', 1);
        $('.from_bar').removeClass('active');
        $('#my_article').addClass('active');
    });
    processActive();
});

function processActive() {
    $('.from_bar').removeClass('active');
    $('#my_notify').addClass('active');
    $('#unread_link').addClass('active');
    $('#unread_link').click(function () {
        $('#unread_link').addClass('active');
        $('#read_link').removeClass('active');
    });
    $('#read_link').click(function () {
        $('#unread_link').removeClass('active');
        $('#read_link').addClass('active');
    });
}

function getNotifications (status=null) {
    $.ajax({
        url: 'api/v1/notification',
        type: "GET",
        data: {
            status: status
        },
        success: function (success) {
            let notify_content = "";
            $('#notify_body').empty();
            if (success.return_data.length === 0) {
                notify_content += '<div class="box-body p-0">\n' +
                    '                    <div class="p-3 d-flex align-items-center osahan-post-header">\n' +
                    '                        <div class="dropdown-list-image mr-3">\n' +
                    '                        </div>\n' +
                    '                        <div class="font-weight-bold mr-3">\n' +
                    '                            <div class="text-truncate">無通知</div>\n' +
                    '                        </div>\n' +
                    // '                        <span class="ml-auto mb-auto">\n' +
                    // '                            <div class="btn-group">\n' +
                    // '                                <button type="button" class="btn btn-light btn-sm rounded" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\n' +
                    // '                                    <i class="mdi mdi-dots-vertical"></i>\n' +
                    // '                                </button>\n' +
                    // '                                <div class="dropdown-menu dropdown-menu-right">\n' +
                    // '                                    <button class="dropdown-item" type="button"><i class="mdi mdi-delete"></i> Delete</button>\n' +
                    // '                                    <button class="dropdown-item" type="button"><i class="mdi mdi-close"></i> Turn Off</button>\n' +
                    // '                                </div>\n' +
                    // '                            </div>\n' +
                    // '                            <br />\n' +
                    // '                            <div class="text-right text-muted pt-1">4d</div>\n' +
                    // '                        </span>\n' +
                    '                    </div>\n' +
                    '                </div>';
            } else {
                $.each(success.return_data, function (key, value) {
                    let img = '';
                    if (value.type !== 'favor') {
                        img = '/images/reply.png';
                    } else {
                        img = '/images/favor.png';
                    }

                    notify_content += '<div class="box-body p-0">\n' +
                        '                    <div class="p-3 d-flex align-items-center osahan-post-header">\n' +
                        '                        <div class="dropdown-list-image mr-3">\n' +
                        '                            <img src="'+img+'" class="img-fluid" alt="Responsive image" />\n' +
                        '                        </div>\n' +
                        '                        <div class="font-weight-bold mr-3">\n' +
                        '                            <div class="text-truncate"><a href="javascript:void(0)" style="color: #669bdf" data-toggle="modal" data-target="#exampleModalLong" onclick="getArticleDetail('+value.article_id+')">'+value.message+'</a></div>\n' +
                        '                            <div class="small">'+value.time+'</div>\n'+
                        '                        </div>\n' +
                        // '                        <span class="ml-auto mb-auto">\n' +
                        // '                            <div class="btn-group">\n' +
                        // '                                <button type="button" class="btn btn-light btn-sm rounded" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\n' +
                        // '                                    <i class="mdi mdi-dots-vertical"></i>\n' +
                        // '                                </button>\n' +
                        // '                                <div class="dropdown-menu dropdown-menu-right">\n' +
                        // '                                    <button class="dropdown-item" type="button"><i class="mdi mdi-delete"></i> Delete</button>\n' +
                        // '                                    <button class="dropdown-item" type="button"><i class="mdi mdi-close"></i> Turn Off</button>\n' +
                        // '                                </div>\n' +
                        // '                            </div>\n' +
                        // '                            <br />\n' +
                        // '                            <div class="text-right text-muted pt-1">4d</div>\n' +
                        // '                        </span>\n' +
                        '                    </div>\n' +
                        '                </div>';
                });
            }

            $('#notify_body').html(notify_content);
        },
        error: function (error) {
            alert(error.responseJSON.status_message);
        }
    })
}

function readAllNotifications() {
    if (!confirm('是否已讀全部通知?')) {
        return;
    }
    $.ajax({
        url: 'api/v1/notification/read/all',
        type: "PATCH",
        data: {
        },
        success: function (success) {
            alert(success.status_message);
            window.location.reload();
        },
        error: function (error) {
            alert(error.responseJSON.status_message);
        }
    });
}

function cleanAllNotifications() {
    if (!confirm('是否清除全部通知?')) {
        return;
    }
    $.ajax({
        url: 'api/v1/notification/clean/all',
        type: "DELETE",
        data: {
        },
        success: function (success) {
            alert(success.status_message);
            window.location.reload();
        },
        error: function (error) {
            alert(error.responseJSON.status_message);
        }
    });
}
