$(document).ready(function() {
    $('#login-form').submit(function(e) {
        e.preventDefault();
        var username = $('#username').val();
        var password = $('#password').val();
        var token =  $('#token').val();          
        // do ajax now
        $.ajax({
            url: "/online-date/login/checkerror",
            method: "POST",
            data: {
                action: 'renew',
                username: username,
                password: password,
                token: token
            },
            success: function(data) {
                var response = JSON.parse(data);
                if (response.status == 1) {
                    console.log('success');
                    document.getElementById("usernameError").innerHTML = response.usernameError;
                    document.getElementById("passwordError").innerHTML = response.passwordError;
                    document.getElementById("tokenError").innerHTML = response.tokenError;
                    document.getElementById("token").value= response.token;
                } else if (response.status == 99) {
                    location = 'home';
                }
            }
        })
    });
});