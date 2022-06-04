$(document).ready(function() {
    $('#register-form').submit(function(e) {
        e.preventDefault();
        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var nickname = $('#nickname').val();
        var username = $('#username').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var confirmpassword = $('#confirmpassword').val();
        var gender = $("input[type=radio][name=gender]:checked").val();
        var token =  $('#token').val();
        if ($( "input[type=checkbox][name=confirm]:checked" ).val() == null){
            var confirm = 0;
        } else {
            var confirm = $( "input[type=checkbox][name=confirm]:checked" ).val();
        }
        
        // do ajax now
        $.ajax({
            url: "/online-date/register/checkerror",
            method: "POST",
            data: {
                action: 'renew',
                firstname: firstname,
                lastname: lastname,
                nickname: nickname,
                username: username,
                email: email,
                password: password,
                confirmpassword: confirmpassword,
                gender: gender,
                confirm: confirm,
                token: token
            },
            success: function(data) {
                var response = JSON.parse(data);
                if (response.status == 1) {
                    console.log('success');
                    document.getElementById("nameError").innerHTML =  response.nameError;
                    document.getElementById("nicknameError").innerHTML = response.nicknameError;
                    document.getElementById("usernameError").innerHTML = response.usernameError;
                    document.getElementById("emailError").innerHTML = response.emailError;
                    document.getElementById("passwordError").innerHTML = response.passwordError;
                    document.getElementById("confirmpasswordError").innerHTML = response.confirmpasswordError;
                    document.getElementById("buttonError").innerHTML = response.buttonError;
                    document.getElementById("confirmError").innerHTML = response.confirmError;
                    document.getElementById("tokenError").innerHTML = response.tokenError;
                    document.getElementById("token").value= response.token;
                } else if (response.status == 99) {
                    location = 'login';
                }
            }
        })
    });
});