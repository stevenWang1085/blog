$(document).ready(function () {
    getAllBoard();
});

function getAllBoard() {
    $.ajax({
        url: 'api/board',
        type: "GET",
        data: {
        },
        success: function (success) {
            let board_list = '';
            $.each(success.return_data.data, function (key, value) {
                $('#board_select').append('<option value="'+value.id+'">'+value.name+'</option>');
            });
            $.each(success.return_data.data, function (key, value) {
                if (key === 0) $('#board_list').append('<a href="javascript:void(0)" onclick="getAllArticle()" class="nav-link nav-link-faded has-icon" style="">全部</a>');
                $('#board_list').append('<a href="javascript:void(0)" onclick="getAllArticle(null, null, '+value.id+')" class="nav-link nav-link-faded has-icon" style="">'+value.name+'</a>');
            });
        },
        error: function (error) {
            alert(error.responseJSON.status_message);
            console.log(error);
        }
    })
}


