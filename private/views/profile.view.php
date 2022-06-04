<?php $this->view('include/header') ?>
<?php $this->view('include/nav') ?>
<!--https://getbootstrap.com/docs/4.0/layout/grid/-->
<div class="container-fluid shadow p-3 bg-white">
    <?php if (isset($_COOKIE['logged'])) : ?>
        <?php $this->view('include/crumbs') ?>
    <?php endif; ?>
    <h1>Profile</h1>
    <div class="profile mx-auto">
        <form class="profile-form" action="profile">
            <div class="profilepic">
                <div class="text-info display-5 fw-bold m-2">
                    Profile Picture:
                </div>
                <div class="pic">
                    <?php
                    echo "<img src='";
                    if (isset($data['filename'])) {
                        echo assets . 'usericon/' . $data['filename'];
                    } else {
                        echo assets . 'defaulticon.png';
                    }
                    echo "' class='rounded m-5 d-block border-3 img-thumbnail'";
                    echo "style='width:400px'>";
                    ?>
                </div>
            </div>
            <!--https://getbootstrap.com/docs/4.0/components/card/-->
            <div class="card mx-auto border border-5 border-info solid 10px">
                <div class="card-body">
                    <div class="userinfo">
                        <div>
                            <h6 class="mb-0">Full Name</h6>
                        </div>
                        <div class="text-success fw-bold m-2">
                            <?php echo $data['firstname'] . ' ' . $data['lastname']; ?>
                        </div>
                    </div>
                    <hr>
                    <div class="userinfo">
                        <div>
                            <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="text-success fw-bold m-2">
                            <?php echo $data['email']; ?>
                        </div>
                    </div>
                    <hr>
                    <div class="userinfo">
                        <div>
                            <h6 class="mb-0">Nickname</h6>
                        </div>
                        <div class="text-success fw-bold m-2">
                            <?php echo $data['nickname']; ?>
                        </div>
                    </div>
                    <hr>
                    <div class="userinfo">
                        <div>
                            <h6 class="mb-0">Age</h6>
                        </div>
                        <div class="text-success fw-bold m-2">
                            <?php echo $data['age']; ?>
                        </div>
                    </div>
                    <hr>
                    <div class="userinfo">
                        <div>
                            <h6 class="mb-0">Gender</h6>
                        </div>
                        <div class="text-success fw-bold m-2">
                            <?php echo $data['gender']; ?>
                        </div>
                    </div>
                    <hr>
                    <div class="userinfo">
                        <div>
                            <h6 class="mb-0">Self Short Description</h6>
                        </div>
                        <div class="text-success fw-bold m-2">
                            <?php echo $data['description']; ?>
                        </div>
                    </div>
                    <hr>
                    <?php if (isset($_GET['nickname'])) : ?>
                        <div class="userinfo">
                            <div>
                                <h6 class="mb-0">Private Message</h6>
                            </div>
                            <div class="form-button mt-3">
                                <a href="pm"><input type='button' class='pm btn btn-primary' name='pm' id='pm' value='Private Message' /></a>
                            </div>
                        </div>
                    <?php endif; ?>



                </div>
            </div>
        </form>

    </div>

</div>

<?php $this->view('includes/footer') ?>