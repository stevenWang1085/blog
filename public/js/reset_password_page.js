$(document).ready(function () {
    let url = window.location.toString();
    let email = '';
    if (url.indexOf("?") != -1) {
        let ary = url.split("?")[1].split("&");
        for (var i in ary) {
            str=ary[i].split("=")[0];
            str_value = decodeURI(ary[i].split("=")[1]);
            if (str === "email") {
                email = str_value;
            }
        }
    }
    $.ajax({
        url: 'api/user/reset_code_page/check',
        type: "GET",
        data: {
            email: email,
        },
        success: function (success) {
        },
        error: function (error) {
            alert(error.responseJSON.status_message);
            console.log(error);
        }
    })

});
