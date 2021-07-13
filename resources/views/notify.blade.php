<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/forum.css">
    <script src="js/home.js"></script>
    <script src="js/notification/controller.js"></script>
{{--    <script src="js/board/controller.js"></script>--}}
{{--    <script src="js/login.js"></script>--}}
    <title>Notification</title>
</head>
<body>

<div class="container">
    <div class="main-body p-0">

        <nav class="navbar navbar-expand-lg  navbar-dark bg-secondary">
            <a class="navbar-brand" >Welcome <label id="current_username"></label></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-item nav-link active from_bar" href="/forum" id="home" style="cursor: pointer"><i class="fas fa-home"></i>首頁</a>
                            <a class="nav-item nav-link from_bar" style="cursor: pointer" id="my_article" href="/forum"><i class="far fa-edit"></i>我的文章</a>
{{--                            <a class="nav-item nav-link from_bar" style="cursor: pointer" id="my_friend">我的好友</a>--}}
                            <a class="nav-item nav-link from_bar" style="cursor: pointer" id="my_notify"><i class="fas fa-bell" href="/notify" id="notify_count" ></i>&nbsp&nbsp通知</a>
                            <a class="nav-item nav-link from_bar" style="cursor: pointer" id="btn_logout"><i class="fas fa-sign-out-alt"></i>登出</a>
                        </div>
                    </div>
                </form>
            </div>
        </nav>

        <div class="col-lg-20">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">\n' +
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" id="unread_link" href="javascript:void(0)"
                               onclick="getNotifications(0)">未讀通知</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="read_link" href="javascript:void(0)"
                               onclick="getNotifications(1)">已讀通知</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0)" onclick="getNotifications(-1)">清除全部通知</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="box shadow-sm rounded bg-white mb-3" id="notify_body">
{{--                <div class="box-title border-bottom p-3">--}}
{{--                    <h6 class="m-0">Recent</h6>--}}
{{--                </div>--}}
{{--                <div class="box-body p-0">--}}
{{--                    <div class="p-3 d-flex align-items-center osahan-post-header">--}}
{{--                        <div class="dropdown-list-image mr-3">--}}
{{--                            <img src="/images/reply.png" class="img-fluid" alt="Responsive image" />--}}
{{--                        </div>--}}
{{--                        <div class="font-weight-bold mr-3">--}}
{{--                            <div class="text-truncate">DAILY RUNDOWN: WEDNESDAY</div>--}}
{{--                            <div class="small">Income tax sops on the cards, The bias in VC funding, and other top news for you</div>--}}
{{--                        </div>--}}
{{--                        <span class="ml-auto mb-auto">--}}
{{--                            <div class="btn-group">--}}
{{--                                <button type="button" class="btn btn-light btn-sm rounded" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                    <i class="mdi mdi-dots-vertical"></i>--}}
{{--                                </button>--}}
{{--                                <div class="dropdown-menu dropdown-menu-right">--}}
{{--                                    <button class="dropdown-item" type="button"><i class="mdi mdi-delete"></i> Delete</button>--}}
{{--                                    <button class="dropdown-item" type="button"><i class="mdi mdi-close"></i> Turn Off</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <br />--}}
{{--                            <div class="text-right text-muted pt-1">4d</div>--}}
{{--                        </span>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
</div>
</body>
</html>
