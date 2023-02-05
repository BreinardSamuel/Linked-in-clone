/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/javascript.js to edit this template
 */

$(document).ready(function(){
    
    
//Forgot Password

    $('#confirm_password_btn').click(function () {

        var email = $('#frgtEmail').val();
        var newpass = $('#newPassword').val();

        $.ajax({
            url: '/change-password',
            method: 'POST',
            cache: false,
            data: {
                'email': email,
                'newPass': newpass
            },
            success: function (res) {
                if (res == email) {
                    alert('password changed successfully !!!');

                    var subject = 'Password';
                    var message = 'Your Password Has been changed successfully !!!';

                    $.ajax({
                        url: '/send-mail',
                        method: 'POST',
                        cache: false,
                        data: {
                            'subject': subject,
                            'msg': message,
                            'email': email
                        }
                    });

                } else {
                    alert('Enter a valid Email ID !!!');
                }
            }
        });
    });
});
