$(document).ready(function () {
    $('#btn_logout').click(function () {
        $.ajax({
            url: 'api/user/logout',
            type: "POST",
            data: {
            },
            success: function (success) {
                window.location.href = '/';
                console.log(success);
            },
            error: function (error) {
                alert(error.responseJSON.status_message);
                console.log(error);
            }
        })
    });
    showLoginUser();
});


function showLoginUser() {
    $.ajax({
        url: 'api/user/get_current',
        type: "GET",
        data: {
        },
        success: function (success) {
            $("label[id='current_username']").html(success.return_data.name);
            if (success.return_data.notify_count > 0) {
                $('#notify_count').attr('data-count', success.return_data.notify_count);
            } else {
                $('#notify_count').removeAttr('data-count');
            }

        },
        error: function (error) {
            alert(error.responseJSON.status_message);
        }
    })
}

