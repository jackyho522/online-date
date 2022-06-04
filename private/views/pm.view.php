<?php $this->view('include/header') ?>
<?php $this->view('include/nav') ?>
<!--https://getbootstrap.com/docs/4.0/layout/grid/-->
<div class="container-fluid shadow p-3 bg-white border solid 5px">
    <div class="row">
        <div class="message-box card col-10 mx-auto border border-5 border-info solid 10px">
            <div class="card-body" id="msg_area">
                <?php
                echo "<h2 class='mb-0 text-info fw-bold'>Messages:</h2>";
                for ($i = 0; $i < count(array_keys($data)); $i++) {
                    if ($data[$i]['sender'] === $_COOKIE['private']) {
                        echo "<div class='row justify-content-end'>";
                        echo "<div class='col-sm-8'>";
                        echo "<div class='shadow-sm alert alert-primary text-dark border solid 5px'>";
                        echo "<b>" . $data[$i]['sender'] . ": </b>" . $data[$i]['msg'];
                        echo "<div class='text-success'>";
                        echo "<small class='text-muted'>" . "Send To: " . $data[$i]['receiver'] . "<br>" . "Created on: " . $data[$i]['created_on'] . "</small>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    } else {
                        echo "<div class='row justify-content-start'>";
                        echo "<div class='col-sm-8'>";
                        echo "<div class='shadow-sm alert alert-success text-dark border solid 5px'>";
                        echo "<b>Me: </b>" . $data[$i]['msg'];
                        echo "<div class='text-success'>";
                        echo "<small class='text-muted'>" . "Send To: " . $data[$i]['receiver'] . "<br>" . "Created on: " . $data[$i]['created_on'] . "</small>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                    /* Users are only allowed to send message when logged in */
                }
                echo "</div>";
                echo "<form class='chat_room' name='chat_room' id='chat_form' method='POST'>";
                echo "<div class='input-group mb-3'>";
                echo "<textarea class='form-control' id='chat_msg' name='chat_msg' placeholder='Send a New Message Here'></textarea>";
                echo "<div class='input-group-append'>";
                echo "<button type='submit' name='send' id='send' class='btn btn-primary' onclick='privatemessage()'><i class='fa-solid fa-paper-plane'></i></button>";
                echo "</div>";
                echo "</div>";
                echo "</form>";
                ?>
                <span class="invalidFeedback" id="invalidFeedback">
                </span>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function privatemessage() {
            /* send chat form, when submitted, this block of code will be executed */
            event.preventDefault(); /* stop refresh the web page */
            var id = event.srcElement.id;
            var message = $('#chat_msg').val();
            var date = new Date();
            $.ajax({
                url: "/online-date/pm/private",
                method: "POST",
                data: {
                    msg: message,
                    created_on: date.toISOString().slice(0, 19).replace('T', ' '),
                    action: 'pm'
                },
                success: function(data) {
                    var response = JSON.parse(data);
                    if (response.status == 99) {
                        /*alert(data.msg);*/
                        document.getElementById("invalidFeedback").innerHTML = response.error;
                    } else if (response.status == 1) {
                        /*alert(data.msg);*/
                        document.getElementById("invalidFeedback").innerHTML = "Ok! No Error";
                        var htmldata = "<div class='row justify-content-start'>" +
                            "<div class='col-sm-8'>" +
                            "<div class='shadow-sm alert alert-success text-dark border solid 5px'>" +
                            "<b>" + 'Me: ' + "</b>" + response.msg +
                            "<div class='text-success'>" +
                            "<small class='text-muted'>" + "Send To: " + response.sendto + "<br>" + "Created on: " + response.created_on + "</small>" +
                            "</div>" +
                            "</div>" +
                            "</div>" +
                            "</div>";
                        $('#msg_area').append(htmldata);
                        $("#chat_msg").val("");
                    }
                }
            })
        };
    </script>
    <?php $this->view('includes/footer') ?>