<!--https://getbootstrap.com/docs/5.0/components/navbar/-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark p-1">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="<?= assets ?>/chatting.png" style="width:60px;">
            Online Date
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="allusers">Chat</a>
                </li>
                <?php if (isset($_COOKIE['logged'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login/leave">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile">Profile</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>