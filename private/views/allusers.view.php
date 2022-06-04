<?php $this->view('include/header') ?>
<?php $this->view('include/nav') ?>

<div class="user-box">
    <?php
    echo "<div class='user row'>";
    echo "<div class='name fw-bold m-2 p-4 col-4 border-0'>";
    echo "Current User: " . explode(',', $_COOKIE['logged'])[0];
    echo "</div>";
    echo "</div>";
    for ($i = 0; $i < count(array_keys($data)); $i++) {
        if (!($data[$i]['username'] === explode(',', $_COOKIE['logged'])[0])){
            echo "<div class='user row'>";
            echo "<div class='icon col-2'>";
            if (!empty($data[$i]['filename'])){
                echo "<img class='pic' src='public/assets/usericon/" . $data[$i]['filename'] . "' alt=''>";
            } else {
                echo "<img class='pic' src='public/assets/defaulticon.png' alt=''>";
            }
            echo "</div>";
            echo "<div class='name fw-bold m-2 p-4 col-4'>";
            echo $data[$i]['firstname'] . ' ' . $data[$i]['lastname'];
            echo "</div>";
            echo "<div class='fw-bold m-2 p-4 col-2'>";
            echo "<a href='profile" . "?nickname=" . $data[$i]['nickname'] . "'>";
            echo "View";
            echo "</a>";
            echo "</div>";
            echo "<div class='col-2 status-dot". $data[$i]['status'] . "'>"; 
            echo "<i class='fas fa-circle'></i></div>";
            echo "</div>";
        }
    }
    ?>
</div>

<?php $this->view('include/footer') ?>