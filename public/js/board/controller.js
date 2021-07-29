$(document).ready(function () {
    getAllBoard();
});

function getAllBoard() {
    $.ajax({
        url: 'api/v1/board',
        type: "GET",
        data: {
        },
        success: function (success) {
            let board_list = '';
            $.each(success.return_data.data, function (key, value) {
                $('#board_select').append('<option value="'+value.id+'">'+value.name+'</option>');
            });
            $.each(success.return_data.data, function (key, value) {
                if (key === 0) $('#board_list').append('<a href="javascript:void(0)" onclick="getArticle(null)" id="board_all" class="nav-link nav-link-faded has-icon from_board active" style="">全部</a>');
                $('#board_list').append('<a href="javascript:void(0)" onclick="getArticle('+value.id+')" id="board_'+value.id+'" class="nav-link nav-link-faded has-icon from_board" style="">'+value.name+'</a>');
            });
        },
        error: function (error) {
            alert(error.responseJSON.status_message);
            console.log(error);
        }
    })
}

function getArticle(board_id) {

    if (sessionStorage.getItem('has_back') === 'true') {
        $('#article_back').click();
    }

    $('.from_board').removeClass('active');
    sessionStorage.setItem('board_id', board_id);
    getAllArticle(null, null, board_id);
    if (board_id === null) {
        $('#board_all').addClass('active');
    } else {
        $('#board_'+board_id).addClass('active');
    }

}


