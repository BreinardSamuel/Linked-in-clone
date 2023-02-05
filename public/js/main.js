
$(document).ready(function () {
    var url = window.location.href;
//    var emailv = document.getElementById('email');
//    var passwordv = document.getElementById('password');
//    var base_url =$("[data-Base_url]").val() ;
//    var base_url = $('#the_id').data('original-title')
//    alert(window.location.href);
//    alert(base_url+"/home");
//

//Login

    $("#login_btn").on("click", function () {
//        alert("login");
        var email = $('#email').val();
        var password = $('#password').val();
        var base_url = $(this).attr("data-Base_url");

        $.ajax({
            url: base_url + "/login-user",
            method: "POST",
            data: {
                "email": email,
                "password": password
            },
            success: function (data) {
//                alert('ok seems');

//                instead of this used session data
//                
//                localStorage.setItem('id', data.details[0].user_id);
//                    var user_id = localStorage.getItem('id');
//                                        alert(user_id);

                if (data.status === "success") {
//                    window.location.href = base_url + "/home";
//                    localStorage.setItem('id', data.details[0].user_id);
//                    var user_id = localStorage.getItem('id');
//                     alert(user_id);

                    window.location.href = base_url + "/home";

//                        $.ajax({
//                           url : base_url + "/home",
//                           method : 'GET',
//                           success : function(res){
//                               alert("got it");
//                           }
//                        });


                } else {
//                    $('#login_alert').html('<div class="alert alert-${type} alert-dismissible" role="alert">   <div>${message}</div> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>');
                    window.location.href = base_url + "/login";
                }
            },
            error: function (d) {
                alert('?');
            }
        });

    });


//Register 

    $("#register_btn").click(function () {

        var name = $("#name").val();
        var email = $("#email").val();
        var address = $("#address").val();
        var mobilenumber = $("#mobilenumber").val();
        var password = $("#password").val();
        var base_url = $(this).attr("data-Base_url");

//        validation for ajax

        var nameclass = $('#name').hasClass('is-valid');
        var emailclass = $('#email').hasClass('is-valid');
        var mobileNumberClass = $('#mobilenumber').hasClass('is-valid');
        var addressClass = $('#address').hasClass('is-valid');
        var passwordClass = $('#password').hasClass('is-valid');


        if (nameclass === true) {
            $('#name').addClass('is-valid');
        } else {
            $('#name').removeClass('is-valid');
            $('#name').addClass('is-invalid');
        }


        if (emailclass === true) {
            $('#email').addClass('is-valid');
        } else {
            $('#email').removeClass('is-valid');
            $('#email').addClass('is-invalid');
        }

        if (addressClass === true) {
            $('#address').addClass('is-valid');
        } else {
            $('#address').removeClass('is-valid');
            $('#address').addClass('is-invalid');
        }
        if (mobileNumberClass === true) {
            $('#mobilenumber').addClass('is-valid');
        } else {
            $('#mobilenumber').removeClass('is-valid');
            $('#mobilenumber').addClass('is-invalid');
        }
        if (passwordClass === true) {
            $('#password').addClass('is-valid');
        } else {
            $('#password').removeClass('is-valid');
            $('#password').addClass('is-invalid');
        }
        if (nameclass && emailclass && mobileNumberClass && addressClass && passwordClass) {

            $.ajax({
                url: base_url + "/register-user",
                method: "POST",
                data: {
                    "name": name,
                    "email": email,
                    "address": address,
                    "mobilenumber": mobilenumber,
                    "password": password
                },
                success: function (d) {
//                alert(d.status);
                    if (d.status === "success") {
                        window.location.href = base_url + "/login";

                        var subject = 'Registration Successful';
                        var message = 'Thankyou for registering in my App!!!';

                        $.ajax({
                            url: '/send-mail',
                            method: 'POST',
                            data: {
                                'subject': subject,
                                'msg': message,
                                'email': email
                            }
                        });

                    } else {
                        alert("sothappal");
                    }
                },
                error: function (e) {
                    alert('error encountered');
                }
            });
        }
    });



//    Admin login


    $("#admin_login_btn").click(function () {

        var email = $("#email").val();
        var password = $("#password").val();
        var base_url = $(this).attr("data-Base_url");

        $.ajax({
            url: base_url + "/admin_login_verify",
            type: "POST",
            data: {
                'email': $("#email").val(),
                'password': $('#password').val()
            },
            success: function (a) {
                if (a.status == "success") {
                    alert("Welcome admin");
                    window.location.href = base_url + "/admin-home";
                    localStorage.setItem('id', a.id);
//                    alert(a.id);
//                   you are supposed to be in admin home page so u want to fetch the details of the user inorder to get ennough details for the dashboard

                    var user_id = localStorage.getItem('user_id');

//                    $.ajax({
//                        url : base_url+"/adminDashboard",
//                        type : 'GET',
//                       success : function (dashDetails){
//                           alert("dashboard Details Added");
//                       }
//                    });
                }
            }
        });
    });



//Admin Dashboard


    if (window.location.href == (base_url + "/admin-home")) {

            $('#myTable').DataTable();
    }




});