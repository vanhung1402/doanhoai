<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Đấu giá online Chilin</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicons -->
    <link href="dist/templates/public/img/favicon.png" rel="icon">
    <link href="dist/templates/public/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,500,600,700,700i|Montserrat:300,400,500,600,700"
        rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="dist/templates/public/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="dist/templates/public/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="dist/templates/public/lib/animate/animate.min.css" rel="stylesheet">
    <link href="dist/templates/public/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="dist/templates/public/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="dist/templates/public/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="dist/templates/public/css/style.css" rel="stylesheet">
    <!-- Custom Stylesheet File -->
    <link href="dist/custom/public/css/main.css" rel="stylesheet">
    <link href="dist/custom/public/css/login.css" rel="stylesheet">
</head>

<body>
    <header id="header">
        <div id="topbar">
            <div class="container">
                <div class="social-links">
                    <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                    <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
                    <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="logo float-left">
                <!-- Uncomment below if you prefer to use an image logo -->
                <h1 class="text-light"><a href="#intro" class="scrollto"><span>Chilin</span></a></h1>
                <!-- <a href="#header" class="scrollto"><img src="img/logo.png" alt="" class="img-fluid"></a> -->
            </div>

            <nav class="main-nav float-right d-none d-lg-block">
                <ul>
                    <li class="active"><a href="#intro">Home</a></li>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#portfolio">Portfolio</a></li>
                    <li><a href="#team">Team</a></li>
                    <li class="drop-down"><a href="">Drop Down</a>
                        <ul>
                            <li><a href="#">Drop Down 1</a></li>
                            <li class="drop-down"><a href="#">Drop Down 2</a>
                                <ul>
                                    <li><a href="#">Deep Drop Down 1</a></li>
                                    <li><a href="#">Deep Drop Down 2</a></li>
                                    <li><a href="#">Deep Drop Down 3</a></li>
                                    <li><a href="#">Deep Drop Down 4</a></li>
                                    <li><a href="#">Deep Drop Down 5</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Drop Down 3</a></li>
                            <li><a href="#">Drop Down 4</a></li>
                            <li><a href="#">Drop Down 5</a></li>
                        </ul>
                    </li>
                    <li>
                        {if empty($user)}
                        <a href="#0">Đăng nhập</a>
                        {else}
                        <a href="#">{$user.username}</a>
                        {/if}
                    </li>
                </ul>
            </nav><!-- .main-nav -->

            <div class="cd-user-modal">
                <!-- this is the entire modal form, including the background -->
                <div class="cd-user-modal-container">
                    <!-- this is the container wrapper -->
                    <ul class="cd-switcher">
                        <li><a href="#0">Sign in</a></li>
                        <li><a href="#0">New account</a></li>
                    </ul>

                    <div id="cd-login">
                        <!-- log in form -->
                        <form method="post" action="{$url}login" class="cd-form">
                            <p class="fieldset">
                                <label class="image-replace cd-email" for="signin-email">Username / E-mail</label>
                                <input class="full-width has-padding has-border" id="signin-email" name="username" type="text"
                                    placeholder="Username / E-mail">
                                <span class="cd-error-message">Không được bỏ trống!</span>
                            </p>

                            <p class="fieldset">
                                <label class="image-replace cd-password" for="signin-password">Password</label>
                                <input class="full-width has-padding has-border" id="signin-password" type="text" placeholder="Password" name="password">
                                <a href="#0" class="hide-password">Hide</a>
                                <span class="cd-error-message">Không được bỏ trống!</span>
                            </p>

                            <p class="fieldset flex align-middle">
                                <input type="checkbox" id="remember-me" checked>
                                <label class="m-0" for="remember-me">&emsp; Remember me</label>
                            </p>

                            <p class="fieldset">
                                <input class="full-width" type="submit" value="Login">
                            </p>
                        </form>

                        <p class="cd-form-bottom-message"><a href="#0">Forgot your password?</a></p>
                        <!-- <a href="#0" class="cd-close-form">Close</a> -->
                    </div> <!-- cd-login -->

                    <div id="cd-signup">
                        <!-- sign up form -->
                        <form method="post" action="{$url}signup" class="cd-form">
                            <p class="fieldset">
                                <label class="image-replace cd-username" for="signup-username">Username</label>
                                <input class="full-width has-padding has-border" id="signup-username" type="text"
                                    placeholder="Username">
                                <span class="cd-error-message">Error message here!</span>
                            </p>

                            <p class="fieldset">
                                <label class="image-replace cd-email" for="signup-email">E-mail</label>
                                <input class="full-width has-padding has-border" id="signup-email" type="email"
                                    placeholder="E-mail">
                                <span class="cd-error-message">Error message here!</span>
                            </p>

                            <p class="fieldset">
                                <label class="image-replace cd-password" for="signup-password">Password</label>
                                <input class="full-width has-padding has-border" id="signup-password" type="text"
                                    placeholder="Password">
                                <a href="#0" class="hide-password">Hide</a>
                                <span class="cd-error-message">Error message here!</span>
                            </p>

                            <p class="fieldset flex align-middle">
                                <input type="checkbox" id="accept-terms">
                                <label class="m-0" for="accept-terms">&emsp;I agree to create account</label>
                            </p>

                            <p class="fieldset">
                                <input class="full-width has-padding" type="submit" value="Create account">
                            </p>
                        </form>

                        <!-- <a href="#0" class="cd-close-form">Close</a> -->
                    </div> <!-- cd-signup -->

                    <div id="cd-reset-password">
                        <!-- reset password form -->
                        <p class="cd-form-message">Lost your password? Please enter your email address. You will receive a link
                            to create a new password.</p>

                        <form class="cd-form">
                            <p class="fieldset">
                                <label class="image-replace cd-email" for="reset-email">E-mail</label>
                                <input class="full-width has-padding has-border" id="reset-email" type="email"
                                    placeholder="E-mail">
                                <span class="cd-error-message">Error message here!</span>
                            </p>

                            <p class="fieldset">
                                <input class="full-width has-padding" type="submit" value="Reset password">
                            </p>
                        </form>

                        <p class="cd-form-bottom-message"><a href="#0">Back to log-in</a></p>
                    </div> <!-- cd-reset-password -->
                    <a href="#0" class="cd-close-form">Close</a>
                </div> <!-- cd-user-modal-container -->
            </div> <!-- cd-user-modal -->
        </div>
    </header><!-- #header -->
    <section id="intro" class="clearfix">
        <div class="container d-flex h-100">
            <div class="row justify-content-center align-self-center">
                <div class="col-md-6 intro-info order-md-first order-last">
                    <h2>Rapid Solutions<br>for Your <span>Business!</span></h2>
                    <div>
                        <a href="#about" class="btn-get-started scrollto">Get Started</a>
                    </div>
                </div>

                <div class="col-md-6 intro-img order-md-last order-first">
                    <img src="dist/templates/public/img/intro-img.svg" alt="" class="img-fluid">
                </div>
            </div>

        </div>
    </section><!-- #intro -->
    <main id="main">