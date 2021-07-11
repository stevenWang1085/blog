$(document).ready(function () {
    getNotifications(0);

});

function getNotifications (status=null) {
    $.ajax({
        url: 'api/notification',
        type: "GET",
        data: {
            status: status
        },
        success: function (success) {
            let notify_content = "";
            $('#notify_body').empty();
            notify_content = '<nav class="navbar navbar-expand-lg navbar-light bg-light">\n' +
                '  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">\n' +
                '    <span class="navbar-toggler-icon"></span>\n' +
                '  </button>\n' +
                '  <div class="collapse navbar-collapse" id="navbarNav">\n' +
                '    <ul class="navbar-nav">\n' +
                '      <li class="nav-item">\n' +
                '        <a class="nav-link" href="javascript:void(0)" onclick="getNotifications(0)">未讀通知</a>\n' +
                '      </li>\n' +
                '      <li class="nav-item">\n' +
                '        <a class="nav-link" href="javascript:void(0)" onclick="getNotifications(1)">已讀通知</a>\n' +
                '      </li>\n' +
                '      <li class="nav-item">\n' +
                '        <a class="nav-link" href="javascript:void(0)" onclick="getNotifications(-1)">清除全部通知</a>\n' +
                '      </li>\n' +
                '    </ul>\n' +
                '  </div>\n' +
                '</nav>';
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
                        '                            <div class="text-truncate">'+value.message+'</div>\n' +
                        '                            <div class="small">'+value.time+'</div>\n' +
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
