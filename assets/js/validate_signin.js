$(document).ready(function() {
    var username_login_state = false;
    var password_login_state = false;

    $('#username-login').blur(function() {
        var username = $('#username-login').val();
        if (username == '') {
            alert('Username cannot be blank.');
            username_login_state = false;
            // document.getElementById('username-login').focus();
            return false;
        } else {
            username_login_state = true;
            return false;
        }
    });

    $('#password-field-login').blur(function() {
        var password = $('#password-field-login').val();
        if (password == "") {
            alert('Password cannot be blank.');
            password_login_state = false;
            password.focus();
            return false;
        } else {
            password_login_state = true;
            return false;
        }
    });

    $('#login-home').click(function(e) {
        e.preventDefault();
        var username = $('#username-login').val();
        var password = $('#password-field-login').val();

        if (username_login_state != false && password_login_state != false) {
            $.ajax({
                type: 'post',
                url: '/api/controller/UsersController.php',
                data: {
                    'login': 1,
                    'username': username,
                    'password': password,
                },
                success: function(login) {
                    if (login != 'Unallowed') {
                        $("#msg").html('<div class="alert alert-warning alert-dismissible" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="Close">&times;</a><strong>Login successfull.<div class="loader"></div></strong></div>');
                        window.setTimeout(function() { 
                            window.location.href = login;
                            }, 250);
                    } else {
                        alert('Username or Password wrong.');
                        return false;
                    }
                }
            });
        } else {
            alert("Fill in blank the form login first.");
            return false;
        }
    });
});