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
    <script src="js/article/controller.js"></script>
    <script src="js/board/controller.js"></script>
    <script src="js/login.js"></script>
    <script src="js/page_button.js"></script>
    <script src="js/getArticleHelper.js"></script>
    <title>Forum</title>
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
                            <a class="nav-item nav-link active from_bar" id="home" style="cursor: pointer"><i class="fas fa-home"></i>首頁</a>
                            <a class="nav-item nav-link from_bar" style="cursor: pointer" id="my_article"><i class="far fa-edit"></i>我的文章</a>
{{--                            <a class="nav-item nav-link from_bar" style="cursor: pointer" id="my_friend">我的好友</a>--}}
                            <a class="nav-item nav-link from_bar" href="/notify" style="cursor: pointer" id="my_notify"><i class="fas fa-bell" id="notify_count"></i>&nbsp&nbsp通知</a>
                            <a class="nav-item nav-link from_bar" style="cursor: pointer" id="btn_logout"><i class="fas fa-sign-out-alt"></i>登出</a>
                        </div>
                    </div>
                </form>
            </div>
        </nav>

        <div class="inner-wrapper">
            <!-- Inner sidebar -->
            <div class="inner-sidebar">
                <!-- Inner sidebar header -->
                <div class="inner-sidebar-header justify-content-center">
                    <button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#threadModal" id="create_article">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus mr-2">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        新增文章
                    </button>
                </div>
                <!-- /Inner sidebar header -->

                <!-- Inner sidebar body -->
                <div class="inner-sidebar-body p-0">
                    <div class="p-3 h-100" data-simplebar="init">
                        <div class="simplebar-wrapper" style="margin: -16px;">
                            <div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div>
                            <div class="simplebar-mask">
                                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                    <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
                                        <div class="simplebar-content" style="padding: 16px;">
                                            <nav class="nav nav-pills nav-gap-y-1 flex-column" id="board_list">
                                                <!--                                                <a href="javascript:void(0)" class="nav-link nav-link-faded has-icon active">All Threads</a>-->
                                                <!--                                                <a href="javascript:void(0)" class="nav-link nav-link-faded has-icon">Popular this week</a>-->
                                                <!--                                                <a href="javascript:void(0)" class="nav-link nav-link-faded has-icon">Popular all time</a>-->
                                                <!--                                                <a href="javascript:void(0)" class="nav-link nav-link-faded has-icon">Solved</a>-->
                                                <!--                                                <a href="javascript:void(0)" class="nav-link nav-link-faded has-icon">Unsolved</a>-->
                                                <!--                                                <a href="javascript:void(0)" class="nav-link nav-link-faded has-icon">No replies yet</a>-->
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="simplebar-placeholder" style="width: 234px; height: 292px;"></div>
                        </div>
                        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div>
                        <div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 151px; display: block; transform: translate3d(0px, 0px, 0px);"></div></div>
                    </div>
                </div>
                <!-- /Inner sidebar body -->
            </div>
            <!-- /Inner sidebar -->

            <!-- Inner main -->
            <div class="inner-main">
                <!-- Inner main header -->
                <div class="inner-main-header">
                    <a class="nav-link nav-icon rounded-circle nav-link-faded mr-3 d-md-none" href="#" data-toggle="inner-sidebar"><i class="material-icons">arrow_forward_ios</i></a>
                    <select class="custom-select custom-select-sm w-auto mr-1" id="select_forum_list">
                        <option selected="" value="created_at">發表時間</option>
                        <option value="favor">按讚數</option>
                        <option value="comments">留言數</option>
                    </select>
                    <select class="custom-select custom-select-sm w-auto mr-1" id="select_forum_type">
                        <option selected="" value="desc">降冪</option>
                        <option value="asc">升冪</option>
                    </select>
                    <span class="input-icon input-icon-sm col-2">
                    <input type="text" id="search_article_title" class="form-control form-control-sm bg-gray-200 border-gray-200 shadow-none mb-4 mt-4" placeholder="標題或內容" />
                    </span>
                </div>
                <!-- /Inner main header -->

                <!-- Inner main body -->

                <!-- Forum List -->
                <div class="inner-main-body p-2 p-sm-3 collapse forum-content show" id="article_body">
                    <!--                    <div class="card mb-2">-->
                    <!--                        <div class="card-body p-2 p-sm-3">-->
                    <!--                            <div class="media forum-item">-->
                    <!--                                <a href="#" data-toggle="collapse" data-target=".forum-content"><img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="mr-3 rounded-circle" width="50" alt="User" /></a>-->
                    <!--                                <div class="media-body">-->
                    <!--                                    <h6><a href="#" data-toggle="collapse" data-target=".forum-content" class="text-body">Realtime fetching data</a></h6>-->
                    <!--                                    <p class="text-secondary" style="overflow: hidden; text-overflow: ellipsis; width: 7em; height: 3em" >-->
                    <!--                                        lorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet-->
                    <!--                                        lorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet-->
                    <!--                                        lorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet-->
                    <!--                                    </p>-->
                    <!--                                    <p class="text-muted"><a href="javascript:void(0)">drewdan</a> replied <span class="text-secondary font-weight-bold">13 minutes ago</span></p>-->
                    <!--                                </div>-->
                    <!--                                <div class="text-muted small text-center align-self-center">-->
                    <!--                                    <span class="d-none d-sm-inline-block"><i class="far fa-eye"></i> 19</span>-->
                    <!--                                    <span><i class="far fa-comment ml-2"></i> 3</span>-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                    </div>-->

                    <!--                    <ul class="pagination pagination-sm pagination-circle justify-content-center mb-0">-->
                    <!--                        <li class="page-item disabled">-->
                    <!--                            <span class="page-link has-icon"><i class="material-icons">chevron_left</i></span>-->
                    <!--                        </li>-->
                    <!--                        <li class="page-item"><a class="page-link" href="javascript:void(0)">1</a></li>-->
                    <!--                        <li class="page-item active"><span class="page-link">2</span></li>-->
                    <!--                        <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>-->
                    <!--                        <li class="page-item">-->
                    <!--                            <a class="page-link has-icon" href="javascript:void(0)"><i class="material-icons">chevron_right</i></a>-->
                    <!--                        </li>-->
                    <!--                    </ul>-->
                </div>
                <!-- /Forum List -->

                <!-- Forum Detail -->

                <!-- /Forum Detail -->

                <!-- /Inner main body -->
            </div>
            <!-- /Inner main -->
        </div>

        <div id="period_calculate_table_pagination" class=""
             style="margin-top: 1.5em; margin-left: 23em;" >
            <input type="hidden" id="current_page" value="1">
            <input type="hidden" id="last_page" value="1">
            <div style="float: left;">
                共<span id="total_data_num"></span>筆
                <select name="per_page" id="per_page" style="padding: 5px 5px; height: 35px; border-radius: 4px;">
                    <option value="10">10筆/頁</option>
                    <option value="30">30筆/頁</option>
                    <option value="50">50筆/頁</option>
                </select>
            </div>
            <div style="float: left">
                <input style="font-weight: bold" type="button" class="btn btn-outline-primary" id="btn_first_page"
                       onclick="clickChangePage('first', null, getAllArticle)" value="第一頁">
                <input style="font-weight: bold" type="button" class="btn btn-outline-primary" id="btn_previous_page"
                       onclick="clickChangePage('previous', null, getAllArticle)" value="上一頁">
            </div>
            <div id="page_buttons" style="float: left; margin-left: 3px; margin-right: 3px;">

            </div>
            <div style="float: left">
                <input style="font-weight: bold" type="button" class="btn btn-outline-primary" id="btn_next_page"
                       onclick="clickChangePage('next', null, getAllArticle)" value="下一頁">
                <input style="font-weight: bold" type="button" class="btn btn-outline-primary" id="btn_last_page"
                       onclick="clickChangePage('last', null, getAllArticle)" value="最末頁">
            </div>
        </div>


        {{-- article detail modal--}}

        <!-- New Thread Modal -->
        <div class="modal fade" id="threadModal" tabindex="-1" role="dialog" aria-labelledby="threadModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form>
                        <div class="modal-header d-flex align-items-center bg-primary text-white">
                            <h6 class="modal-title mb-0" id="threadModalLabel">New Discussion</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label >看板</label><br>
                                <select class="form-select" id="board_select" aria-label="Default select example">
                                    <option selected value="">請選擇看板</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label >Title</label>
                                <input type="text" class="form-control" id="article_title" placeholder="Enter title" autofocus="" />
                            </div>


                            <div class="form-group">
                                <label >Content</label>
                                <textarea class="form-control article_content" id="article_content"></textarea>
                            </div>
                            <!--                            <div class="custom-file form-control-sm mt-3" style="max-width: 300px;">-->
                            <!--                                <input type="file" class="custom-file-input" id="customFile" multiple="" />-->
                            <!--                                <label class="custom-file-label" for="customFile">Attachment</label>-->
                            <!--                            </div>-->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal" id="article_cancle">Cancel</button>
                            <button type="button" class="btn btn-primary" id="article_post">Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalLong" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h7 class="modal-title" id=""><i class="far fa-bookmark"></i>文章內容</h7>
                        <button type="button" class="close" id="article_detail_close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="inner-main-body p-2 p-sm-3 forum-content">
                        <div class="card mb-2">
                            <div class="card-body" id="article_detail">

                            </div>
                            <div class="bg-white p-2">
                                <div class="d-flex flex-row fs-12" id="article_operation">

                                </div>
                            </div>

                        </div>
                        <div id="collapse-1" class="bg-light p-2 collapse" data-parent="#article_detail">
                            <div class="d-flex flex-row align-items-start"><textarea class="form-control ml-1 shadow-none textarea" id="comment_detail"></textarea></div>
                            <div class="mt-2 text-right" id="post_comment_aria">
                                <!--                            <button class="btn btn-primary btn-sm shadow-none" type="button" id="">Post comment</button>-->
                            </div>
                        </div>
                        <div class="modal-header">
                            <h7 class="modal-title" id=""><i class="far fa-comment"></i>留言區</h7>
                        </div>
                        <div class="card mb-2" id="all_comment">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">回覆內容</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="reply_comment_detail"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" id="reply_comment" data-dismiss="modal">回覆</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editArticleModal" tabindex="-1" role="dialog" aria-labelledby="editArticleModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">文章</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">標題：</label>
                                <input type="text" class="form-control" id="edit_article_title">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">內容：</label>
                                <textarea class="form-control" id="edit_article_content"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" id="confirm_edit_article" data-dismiss="modal">修改</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
