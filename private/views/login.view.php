<?php $this->view('include/header') ?>
<?php $this->view('include/nav') ?>

<div class="form-box">
    <div class="form-top">
        <div class="form-top-left">
            <h3>Login to our site</h3>
            <p>Enter your username and password to log on:</p>
        </div>
        <div class="form-top-right">
            <i class="fa-solid fa-user-lock"></i>
        </div>
        <span class="invalidFeedback" id="tokenError">
            <?php echo $data['tokenError']; ?>
        </span>
    </div>
    <div class="form-bottom">
        <form id="login-form" class="login-form" action="login" method="POST">
            <input type="hidden" name="token" id="token" value="<?php echo $data['token']; ?>">
            <h5>Username: </h5>
            <input type="username" class="form-control" placeholder="Username" name="username" id="username" autofocus autocomplete="off">
            <span class="invalidFeedback" id="usernameError">
            </span>
            <input type="password" class="form-control" placeholder="Password" name="password" id="password">
            <span class="invalidFeedback"  id="passwordError">
            </span>
            <div class="form-button mt-5">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
            <p class="options">Not registered yet? <a href="register"> Create an account!</a></p>
        </form>
    </div>
</div>
<?php $this->view('include/footer') ?>