//far fa-eye
$(".toggle-password").click(function() {
    $(this).toggleClass("fa-eye-slash fa-eye");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});
$(".toggle-password-confirm").click(function() {
    $(this).toggleClass("fa-eye-slash fa-eye");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});
$(".toggle-password-login").click(function() {
    $(this).toggleClass("fa-eye-slash fa-eye");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});

// function showTextPasswd(location) {
//     switch (expression) {
//         case x:
//             // code block
//             break;
//         case y:
//             // code block
//             break;
//         default:
//             // code block
//     }
// }

function checkForm(form) {
    // if (form.username.value == "") {
    //     alert("Error: Username cannot be blank!");
    //     form.username.focus();
    //     return false;
    // }
    // re = /^\w+$/;
    // if (!re.test(form.username.value)) {
    //     alert("Error: Username must contain only letters, numbers and underscores!");
    //     form.username.focus();
    //     return false;
    // }
    if (form.password.value != "" && form.password.value == form.password_confirm.value) {
        if (form.password.value.length < 6) {
            alert("Error: Password must contain at least six characters!");
            form.password.focus();
            return false;
        }
        if (form.password.value == form.username.value) {
            alert("Error: Password must be different from Username!");
            form.password.focus();
            return false;
        }
        re = /[0-9]/;
        if (!re.test(form.password.value)) {
            alert("Error: password must contain at least one number (0-9)!");
            form.password.focus();
            return false;
        }
        re = /[a-z]/;
        if (!re.test(form.password.value)) {
            alert("Error: password must contain at least one lowercase letter (a-z)!");
            form.password.focus();
            return false;
        }
        re = /[A-Z]/;
        if (!re.test(form.password.value)) {
            alert("Error: password must contain at least one uppercase letter (A-Z)!");
            form.password.focus();
            return false;
        }
    } else {
        alert("Error: Please check that you've entered and confirmed your password!");
        form.password.focus();
        return false;
    }

}

$(document).ready(function() {
    var username_state = false;
    var password_state = false;

    $('#username-sign-up').blur(function() {
        var username = $('#username-sign-up').val();
        if (username != '') {
            re = /^\w+$/;
            if (!re.test(username)) {
                alert("Error: Username must contain only letters, numbers and underscores!");
                username.focus();
                username_state = false;
                return;
            }
        } else {
            alert("Error: Username cannot be blank!");
            username.focus();
            username_state = false;
            return;
        }

        $.ajax({
            type: 'post',
            url: '/GDIT/app/api/controller/UsersController.php', // put your real file name '/GDIT/app/assets/js/1.php'
            data: { username: username },
            success: function(response) {
                if (response == 'taken') {
                    username_state = false;
                    $('#username-sign-up').parent().removeClass();
                    $('#username-sign-up').parent().addClass("group form_error");
                    $('#username-sign-up').siblings("span").text('Username already exists.').css('display', 'inline').fadeOut(4500);
                    // return false;
                }
                if (response == 'not_taken') {
                    username_state = true;
                    $('#username-sign-up').parent().removeClass();
                    $('#username-sign-up').parent().addClass("group form_success");
                    $('#username-sign-up').siblings("span").text('Username available').css('display', 'inline').fadeOut(4500);
                    // return false;
                }
            }
        });
    });

    $('#password-field').blur(function() {
        var password = $('#password-field').val();
        var password_confirm = $('#password-field-confirm').val();
        if (password != '') {
            if (password.length < 6) {
                alert("Error: Password must contain at least six characters!");
                password.focus();
                password_state = false;
                return false;
            }
            if (password === username) {
                alert("Error: Password must be different from Username!");
                password.focus();
                password_state = false;
                return false;
            }
            re = /[0-9]/;
            if (!re.test(password)) {
                alert("Error: password must contain at least one number (0-9)!");
                password.focus();
                password_state = false;
                return false;
            }
            re = /[a-z]/;
            if (!re.test(password)) {
                alert("Error: password must contain at least one lowercase letter (a-z)!");
                password.focus();
                password_state = false;
                return false;
            }
            re = /[A-Z]/;
            if (!re.test(password)) {
                alert("Error: password must contain at least one uppercase letter (A-Z)!");
                password.focus();
                password_state = false;
                return false;
            }
        }
    });

    $('#password-field-confirm').blur(function() {
        var password = $('#password-field').val();
        var password_confirm = $('#password-field-confirm').val();
        if (password != password_confirm) {
            alert("Error: Please check that you've entered and confirmed your password!");
            password_confirm.focus();
            password_state = false;
            return false;
        }
    });


    $('#sign_up').click(function() {
        var username = $('#username-sign-up').val();
        var password = $('#password-field').val();
        var password_confirm = $('#password-field-confirm').val();

        if (username_state == false) {
            alert("Fix the errors in the form first");
            return false;
        } else {
            $.ajax({
                type: 'post',
                url: '/GDIT/app/api/controller/UsersController.php',
                data: {
                    'insert': 1,
                    'uname': username,
                    'passwd': password,
                    'passwd_confirm': password_confirm,
                },
                success: function(insertdb) {
                    if (insertdb == 'successed') {
                        alert('Create an user success. Now you can login with it.');
                        return false;
                    }
                    if (insertdb == 'failed') {
                        alert('An error happened when we trying create account for you.');
                        return false;
                    }
                }
            });
        }
    });
});
// $(document).ready(function() {
//     var username_state = false;
//     var email_state = false;
//     $('#username-sign-up').blur(function() {
//         var username = $('#username-sign-up').val();
//         // alert('thuan');
//         $.ajax({
//             url: '1.php',
//             type: 'post',
//             data: {
//                 'username_check': 1,
//                 'username': username,
//             },
//             success: function(response) {
//                 if (response == 'taken') {
//                     username_state = false;
//                     $('#username-sign-up').parent().removeClass();
//                     $('#username-sign-up').parent().addClass("form_error");
//                     $('#username-sign-up').siblings("span").text('Sorry... Username already taken');
//                     alert('Sorry... Username already taken');
//                 } else if (response == 'not_taken') {
//                     username_state = true;
//                     $('#username-sign-up').parent().removeClass();
//                     $('#username-sign-up').parent().addClass("form_success");
//                     $('#username-sign-up').siblings("span").text('Username available');
//                     alert('Username available');
//                 }
//             }
//         });
//     });

//     // $('#sign_up').on('click', function() {
//     //     var username = $('#username').val();
//     //     // var email = $('#email').val();
//     //     var password = $('#password').val();
//     //         // proceed with form submission
//     //         console.log('hello');
//     //     $.ajax({
//     //         // url: '/GDIT/app/api/controller/UsersController.php',
//     //         url: '/GDIT/app/api/controller/UsersController.php',
//     //         type: 'post',
//     //         data: {
//     //             'save': 1,
//     //             // 'email': email,
//     //             'username': username,
//     //             'password': password,
//     //         },
//     //         success: function(response) {
//     //             alert('Create an user success. Now you can login with it.');
//     //             $('#username').val('');
//     //             // $('#email').val('');
//     //             $('#password').val('');
//     //         }
//     //     });
//     // });

// });