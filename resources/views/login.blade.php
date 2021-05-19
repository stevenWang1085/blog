<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="js/login.js"></script>
</head>

<div class="container">
    <div id="loginbox" style="margin-top: 50px;" class="mainbox col-lg-6 offset-md-3 col-md-8 offset-sm-2">
        <div class="card card-inverse card-info">
            <div class="card-header">
                <div class="card-title">Sign In</div>
                <div style="float: right; font-size: 80%; position: relative; top: -10px;"><a  href="javascript:void(0)" onclick="$('#loginbox').hide(); $('#forgotbox').show()">Forgot password?</a>
                </div>
            </div>
            <div style="padding-top: 30px;" class="card-block">
                <div style="display: none;" id="login-alert" class="alert alert-danger col-md-12"></div>
                <form id="loginform" class="" role="form">
                    <div style="margin-bottom: 25px;" class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input
                            id="login-username" type="text" class="form-control" name="username" value=""
                            placeholder="username or email" />
                    </div>
                    <div style="margin-bottom: 25px;" class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input
                            id="login-password" type="password" class="form-control" name="password"
                            placeholder="password" />
                    </div>
                    <div style="margin-top: 10px;" class="form-group">
                        <!-- Button -->
                        <div class="col-md-12 controls"> <a id="btn-login" href="javascript:void(0)" class="btn btn-success">Login  </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12 control">
                            <div style="padding-top: 15px; font-size: 85%;">Don't have an account! <a  href="javascript:void(0)" onclick="$('#loginbox').hide(); $('#signupbox').show(); $('#forgotbox').hide()">

                                    Sign Up Here

                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="signupbox" style="display: none; margin-top: 50px;" class="mainbox col-lg-6 offset-md-3 col-md-8 offset-sm-2">
        <div class="card card-inverse card-info">
            <div class="card-header">
                <div class="card-title">Sign Up</div>
                <div style="float: right; font-size: 85%; position: relative; top: -10px;"><a id="signinlink"  href="javascript:void(0)" onclick="$('#signupbox').hide(); $('#loginbox').show(); $('#forgotbox').hide()">Sign In</a>
                </div>
            </div>
            <div class="card-block">
                <form id="signupform" class="" role="form">
                    <div id="signupalert" style="display: none;" class="alert alert-danger">
                        <p>Error:</p> <span></span>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-lg-3 form-control-label">Email</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="sign_email" name="email" placeholder="Email Address"
                            />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="firstname" class="col-lg-3 form-control-label">Name</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="sign_username" name="username" placeholder="Name"
                            />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-lg-3 form-control-label">Password</label>
                        <div class="col-lg-9">
                            <input type="password" class="form-control" id="sign_password" name="passwd" placeholder="Password"
                            />
                        </div>
                    </div>
                    <!--                    <div class="form-group">-->
                    <!--                        <label for="password" class="col-lg-3 form-control-label">Confirm Password</label>-->
                    <!--                        <div class="col-lg-9">-->
                    <!--                            <input type="password" class="form-control" id="sign_confirm_password" name="passwd" placeholder="Password"-->
                    <!--                            />-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                    <div class="form-group">
                        <!-- Button -->
                        <div class="offset-md-3 col-lg-9">
                            <button id="btn-signup" type="button" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Sign Up</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="forgotbox" style="display: none; margin-top: 50px;" class="mainbox col-lg-6 offset-md-3 col-md-8 offset-sm-2">
        <div class="card card-inverse card-info">
            <div class="card-header">
                <div class="card-title">Forgot Password</div>
                <div style="float: right; font-size: 85%; position: relative; top: -10px;"><a id="forgot_link"  href="javascript:void(0)" onclick="$('#signupbox').hide(); $('#loginbox').show(); $('#forgotbox').hide()">Sign In</a>
                </div>
            </div>
            <div class="card-block">
                <form id="forgotform" class="" role="form">
                    <div class="form-group">
                        <label for="email" class="col-lg-3 form-control-label">Email</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="forgot_email" name="email" placeholder="Email Address"
                            />
                        </div>
                    </div>
                    <div class="form-group">
                        <!-- Button -->
                        <div class="offset-md-3 col-lg-9">
                            <button id="btn-forgot" type="button" class="btn btn-info"><i class="icon-hand-right"></i>Send Email</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
</div>
