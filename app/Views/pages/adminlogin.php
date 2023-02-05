<!DOCTYPE html>

<html>

    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <!-- <link rel="stylesheet" href="../css/bootstrap5/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/main.css"> -->
        <link rel="stylesheet" href="<?php echo base_url("/public/css/main.css") ?>">
        <link rel="stylesheet" href="<?php echo base_url("/public/css/bootstrap5/css/bootstrap.min.css") ?>">
        <link rel="stylesheet" href="<?php echo base_url("/public/js/vendor/alertify/css/alertify.min.css") ?>">
        <link rel="stylesheet" href="<?php echo base_url("/public/js/vendor/animate/animate.min.css") ?>">
    </head>

    <body data-Base_url="<?php echo base_url('/public') ?>">

        <nav class="navbar navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">User Login</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title display-5" id="offcanvasDarkNavbarLabel">Menu</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <!--for register-->
                        <div>
                            <p class="lead">If you are new to our site please register here</p>
                            <div>
                                <a href="<?php echo base_url('/register') ?>"
                                   class="btn btn-light">Register</a></span>
                            </div>
                        </div>
                        <hr>

                        <!--for user login-->
                        <div>
                            <p class="lead">If you already a member please sign in here</p>
                            <div>
                                <a href="<?php echo base_url('/login') ?>"
                                   class="btn btn-light">sign in</a></span>
                            </div>
                        </div>
                        <hr>


                        <!--for forgot password-->
                        <div>
                            <p class="lead">You can change your password here if you forgot your password !!!</p>
                            <div>
                                <a href="<?php echo base_url('/forgot-password') ?>" class="btn btn-light ">Forgot Password</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>



        <div class=" container text-center sign-in-center">

            <main class="form-signin w-100 m-auto">
                <form autocomplete="off">
                    <img class="mb-4" src="<?php echo base_url("/writable/defaults/admin-icon.png") ?>" alt="" width="72" height="72">
                    <h1 class="h3 mb-3 fw-normal">Admin Login</h1>

                    <div id="login_alert">

                    </div>

                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                        <label for="floatingInput">Email address</label>
                    </div>


                    <div class="form-floating">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>

                    <button class="w-100 btn btn-lg btn-dark" data-Base_url="<?php echo base_url() ?>"  id="admin_login_btn" type="button">Enter</button>

                </form>

            </main>



        </div>


        <script src="<?php echo base_url('/public/js/vendor/alertify/alertify.min.js') ?>"></script>
        <script src="<?php echo base_url('/public/js/vendor/jquery.min.js') ?>"></script>
        <script src="<?php echo base_url('/public/css/bootstrap5/js/bootstrap.bundle.js') ?>"></script>

    </body>
    <script src="<?php echo base_url('/public/js/main.js') ?>"></script>



</html>
   