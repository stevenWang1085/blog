$(document).ready(function () {

    $('#btn-login').click(function () {
        let email = $('#login-username').val();
        let password = $('#login-password').val();

        $.ajax({
            url: 'api/user/login',
            type: "POST",
            data: {
                email: email,
                password: password
            },
            success: function (success) {
                alert(success.status_message);
                window.location.href = '/forum.html';
                console.log(success);
            },
            error: function (error) {
                alert(error.responseJSON.status_message);
                console.log(error);
            }
        })

    });

    $('#btn-signup').click(function () {
        let email = $('#sign_email').val();
        let name = $('#sign_username').val();
        let password = $('#sign_password').val();
        let confirm_password = $('#sign_confirm_password').val();

        $.ajax({
            url: 'api/user',
            type: "POST",
            data: {
                name: name,
                email: email,
                password: password
            },
            success: function (success) {
                alert(success.status_message);
                window.location.href = '/login.html';
                console.log(success);
            },
            error: function (error) {
                alert(error.responseJSON.status_message);
                console.log(error);
            }
        })

    });

    $('#btn-forgot').click(function () {
        let email = $('#forgot_email').val();
        $.ajax({
            url: 'api/user/forget_password/send',
            type: "POST",
            data: {
                email: email,
            },
            success: function (success) {
                alert(success.status_message);
                window.location.href = '/login.html';
                console.log(success);
            },
            error: function (error) {
                alert(error.responseJSON.status_message);
                console.log(error);
            }
        })
    });

    $('#btn-reset').click(function () {
        let reset_code = $('#reset_code').val();
        $.ajax({
            url: 'api/user/reset_code/check',
            type: "POST",
            data: {
                reset_password_code: reset_code,
            },
            success: function (success) {
                alert(success.status_message);
                window.location.href = '/check_reset_password.html';
                console.log(success);
            },
            error: function (error) {
                alert(error.responseJSON.status_message);
                console.log(error);
            }
        })
    });

    $('#btn-reset_confirm').click(function () {
        let reset_code = $('#check_reset_code').val();
        let email = $('#reset_email').val();
        let password = $('#reset_password').val();
        let confirm_password = $('#reset_confirm_password').val();
        $.ajax({
            url: 'api/user/forget_password/check',
            type: "POST",
            data: {
                reset_password_code: reset_code,
                reset_password: password,
                confirm_reset_password: confirm_password,
                email: email
            },
            success: function (success) {
                alert(success.status_message);
                window.location.href = '/login.html';
                console.log(success);
            },
            error: function (error) {
                alert(error.responseJSON.status_message);
                console.log(error);
            }
        })
    });
});
