<?php $this->view('include/header') ?>
<?php $this->view('include/nav') ?>

<div class="form-box">
    <div class="form-items">
        <div class="form-top">
            <div class="form-top-left">
                <h3>Register to our site</h3>
                <p>Enter your information: </p>
            </div>
            <div class="form-top-right">
                <i class="fa-solid fa-user-lock"></i>
            </div>
            <span class="invalidFeedback" id="tokenError">
            </span>
        </div>
        <div class="form-bottom">
            <form id="register-form" class="register-form" action="register" method="POST">
                <input type="hidden" name="token" id="token" value="<?php echo $data['token']; ?>">
                <div>
                    <h6>Name: </h6>
                    <div class="m-1">
                        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name">
                    </div>
                    <div class="m-1">
                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name">
                    </div>
                    <span class="invalidFeedback" id="nameError">
                    </span>
                </div>
                <div class="m-1">
                    <h6>Nickname: </h6>
                    <input type="nickname" class="form-control" name="nickname" id="nickname" placeholder="Nickname">
                </div>
                <span class="invalidFeedback" id="nicknameError">
                </span>
                <div class="m-1">
                    <h6>Username: </h6>
                    <input type="username" class="form-control" name="username"  id="username" placeholder="Username">
                </div>
                <span class="invalidFeedback" id="usernameError">
                </span>
                <div class="m-1">
                    <h6>Email: </h6>
                    <input type="email" class="form-control" name="email" id="email" placeholder="E-mail Address">
                </div>
                <span class="invalidFeedback" id="emailError">
                </span>
                <div class="m-1">
                    <h6>Password: </h6>
                    <input type="password" class="form-control" name="password"  id="password" placeholder="Password">
                </div>
                <span class="invalidFeedback" id="passwordError">
                </span>
                <div class="m-1">
                    <input type="password" class="form-control" name="confirmpassword"  id="confirmpassword" placeholder="Confirm Password">
                </div>
                <span class="invalidFeedback" id="confirmpasswordError">
                </span>

                <div class="mt-1">
                    <label class="mb-3 mr-1" for="gender">Gender: </label>

                    <input class="btn-check" type="radio" name="gender" id="male" value="male" autocomplete="off">
                    <label class="btn btn-sm" for="male">Male</label>

                    <input class="btn-check" type="radio" name="gender" id="female" value="female" autocomplete="off">
                    <label class="btn btn-sm" for="female">Female</label>

                    <input class="btn-check" type="radio" name="gender" id="secret" value="secret" checked="checked" autocomplete="off">
                    <label class="btn btn-sm" for="secret">Secret</label>
                    <span class="invalidFeedback" id="buttonError">
                    </span>
                </div>
                <br>
                <div class="text form-check">
                    <input class="form-check-input" type="hidden" name="confirm" value="0">
                    <input class="form-check-input" type="checkbox" name="confirm" value="1">
                    <label class="form-check-label">I confirm that all data is correct</label>
                    <span class="invalidFeedback" id="confirmError">
                    </span>
                </div>

                <div class="form-button mt-3">
                    <button id="submit" type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->view('include/footer') ?>