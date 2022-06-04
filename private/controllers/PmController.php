<?php

class Pm extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->errorModel = $this->model('Formerrors');
    }

    public function index()
    {
        if (isset($_COOKIE['private']) && $this->userModel->checkcookie()) {
            $username = explode(',', $_COOKIE['logged'])[0];
            $nickname = $this->userModel->findusers($username)['nickname'];
            $message = $this->userModel->getmessage($nickname, $_COOKIE['private']);
            $this->view('pm', $message);
        } else {
            http_response_code(404);
            die("HTTP Error " . 404 . ": " . "You have tampered with your session or you have been logged out.");
        }
    }


    public function private()
    {
        if (isset($_COOKIE['private']) && $this->userModel->checkcookie()) {
            $sendto = $_COOKIE['private'];
            $message = $_POST['msg'];
            $create = $_POST['created_on'];
            $error = $this->errorModel->message_error($message);
            $row = $this->userModel->findusers(explode(',', $_COOKIE['logged'])[0]);
            if ($_POST['action'] == 'pm' && empty($error)) {
                $this->userModel->sendmessage($row['uuid'], $row['nickname'], $sendto, $message);
                echo json_encode(['status' => 1, 'sendto' => $sendto, 'msg' => $message, 'created_on' => $create, 'error' => $error]);
            } else {
                echo json_encode(['status' => 99, 'created_on' => $create, 'error' => $error]);
            }
        } else {
            http_response_code(404);
            die("HTTP Error " . 404 . ": " . "You have tampered with your session or you have been logged out.");
        }
    }
    
}
