<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/html.html to edit this template
-->
<html>

    <head>
        <title>Register</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo base_url("/public/css/main.css") ?>">
        <link rel="stylesheet" href="<?php echo base_url("/public/css/bootstrap5/css/bootstrap.min.css") ?>">
        <!-- <link rel="stylesheet" href="../css/bootstrap5/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/main.css"> -->

    </head>


    <body id="registration_page" class="modal modal-signin position-static d-block bg-secondary py-5">

        <nav class="navbar navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Register Here For Free</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title display-5" id="offcanvasDarkNavbarLabel">Menu</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div>
                            <p class="lead">If you already a member please sign in here</p>
                            <div>
                                <a href="<?php echo base_url('/login') ?>"
                                   class="btn btn-light">sign in</a></span>
                            </div>
                        </div>

                        <div>
                            <p class="lead">If you are an Admin please login here !!!</p>
                            <div>
                                <a href="<?php echo base_url('/admin-login') ?>" class="btn btn-light ">Admin Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>


        <div  tabindex="-1" class="mt-6p" role="dialog" id="modalSignin">
            <div class="modal-dialog" role="document">
                <div class="modal-content rounded-4 shadow">
                    <div class="modal-header p-5 pb-4 border-bottom-0 text-center">
                        <!-- <h1 class="modal-title fs-5" >Modal title</h1> -->
                        <h1 class="fw-bold mb-0 fs-2">Register</h1>
                    </div>

                    <div class="modal-body p-5 pt-0">
                        <form autocomplete="off" >


                            <div class="form-floating mb-3">
                                <input type="text" class="form-control rounded-3" name="name" id="name" onkeyup="lettersonly(this)" placeholder ="name@example.com">
                                <label for="floatingInput">Name</label>
                                <div class="invalid-feedback">
                                    Your Name must be above Five characters
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control rounded-3" id="email" name="email" placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                                <div class="invalid-feedback">
                                    Enter a valid Email address
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control rounded-3" id="mobilenumber" name="mobilenumber" onkeyup="numbersonly(this)" maxlength="10" placeholder="name@example.com">
                                <label for="floatingInput">Mobile Number</label>
                                <div class="invalid-feedback">
                                    Your Mobile number must be Ten digits
                                </div>
                            </div> 
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Enter your address here" name="address" id="address" style="height: 100px"></textarea>
                                <label for="floatingTextarea2">Address</label>
                                <div class="invalid-feedback">
                                    Your Address must be above Five characters
                                </div>
                            </div>


                            <div class="form-floating mb-3">
                                <input type="password" class="form-control rounded-3" placeholder="Password"  name="password" id="password" required>
                                <label for="floatingPassword">Password</label>
                                <div class="invalid-feedback">
                                    Your Password Must Contain 1 Uppercase 1 lower case 1 special character and is must be above 8 characters in length
                                </div>
                            </div>
                            <button class="w-100 py-2 mb-2 btn btn-dark rounded-3" data-Base_url="<?php echo base_url() ?>" id="register_btn" type="button">REGISTER</button>
                            <small class="text-muted">By clicking Sign up, you agree to the terms of use.</small>


                        </form>
                    </div>
                </div>
            </div>
        </div>


        <script src=" <?php echo base_url('/public/js/vendor/jquery.min.js') ?>"></script>
        <script src=" <?php echo base_url('/public/css/bootstrap5/js/bootstrap.bundle.js') ?>"></script>
    </body>
    <script src="<?php echo base_url('/public/js/main.js') ?>"></script>
    <script src="<?php echo base_url('/public/js/customeffects.js') ?>"></script>

</html>