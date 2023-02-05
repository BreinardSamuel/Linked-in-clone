var parent = document.getElementsByTagName('html');
var email = document.getElementById('email');
var password = document.getElementById('password');
var userName = document.getElementById("name");
var mobilenumber = document.getElementById('mobilenumber');
var address = document.getElementById('address');
var validRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
var passwordRegEx = /^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*\d)(?=\S*[^\w\s])\S{8,}$/;
var mobilenumberRegEx = /@"^\d{10}$"/ ;


//validation effect for name

userName.addEventListener('blur', function () {
    userName.addEventListener('keyup', function () {
        if (userName.value.length < 4 || userName.value.trim() === "") {
            userName.classList.add('is-invalid');
        } else {
            userName.classList.remove('is-invalid');
            userName.classList.add('is-valid');
        }
    })
    if (userName.value.length < 4 || userName.value.trim() === "") {
        userName.classList.add('is-invalid');
    } else {
        userName.classList.remove('is-invalid');
        userName.classList.add('is-valid');
    }
});

//validation effect for email

email.addEventListener('blur', function () {
    email.addEventListener('keyup', function () {
        if (!(email.value.match(validRegex))) {
            email.classList.add('is-invalid');
        } else {
            email.classList.remove('is-invalid');
            email.classList.add('is-valid');
        }
    })
    if (!(email.value.match(validRegex))) {
        email.classList.add('is-invalid');
    } else {
        email.classList.remove('is-invalid');
        email.classList.add('is-valid');
    }
});
//
//function emailonly(input) {
//
//    email.addEventListener('blur', function () {
//        email.addEventListener('keyup', function () {
//            if (email.value.match(validRegex)) {
//                email.classList.add('is-valid');
//            } else {
//                email.classList.remove('is-valid');
//                email.classList.add('is-invalid');
//            }
//        })
//        if (email.value.match(validRegex)) {
//            email.classList.add('is-valid');
//        } else {
//            email.classList.remove('is-valid');
//            email.classList.add('is-invalid');
//        }
//    });
//}
//;

//validation effect for mobilenumber


mobilenumber.addEventListener('blur', function () {
    mobilenumber.addEventListener('keyup', function () {
        if (!(mobilenumber.value.match(mobilenumberRegEx)) && mobilenumber.value.length < 10 || mobilenumber.value.trim() === "") {
            mobilenumber.classList.add('is-invalid');
        } else {
            mobilenumber.classList.remove('is-invalid');
            mobilenumber.classList.add('is-valid');
        }
    })
    if (!(mobilenumber.value.match(mobilenumberRegEx)) && mobilenumber.value.length < 10 || mobilenumber.value.trim() === "") {
        mobilenumber.classList.add('is-invalid');
    } else {
        mobilenumber.classList.remove('is-invalid');
        mobilenumber.classList.add('is-valid');
    }
});


//validation effect for address


address.addEventListener('blur', function () {
    address.addEventListener('keyup', function () {
        if (address.value.length < 5 || address.value.trim() === "") {
            address.classList.add('is-invalid');
        } else {
            address.classList.remove('is-invalid');
            address.classList.add('is-valid');
        }
    })
    if (address.value.length < 5 || address.value.trim() === "") {
        address.classList.add('is-invalid');
    } else {
        address.classList.remove('is-invalid');
        address.classList.add('is-valid');
    }
});

//validation for letters only

function lettersonly(input) {
    var regex = /[^a-z\s]/gi;
    input.value = input.value.replace(regex, "");
};


//validation for numbers only in mobilenumber input

function numbersonly(input) {
    var regex = /[^0-9\s]/gi;
    input.value = input.value.replace(regex, "");
}
;

// validation for password to have atleast one uppercase one numeric value and one special char


password.addEventListener('blur', function () {
    password.addEventListener('keyup', function () {
        if (!(password.value.match(passwordRegEx))) {
            password.classList.add('is-invalid');
        } else {
            password.classList.remove('is-invalid');
            password.classList.add('is-valid');
        }
    })
    if (!(password.value.match(passwordRegEx))) {
        password.classList.add('is-invalid');
    } else {
        password.classList.remove('is-invalid');
        password.classList.add('is-valid');
    }
});