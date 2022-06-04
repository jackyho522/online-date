<?php

class Profile extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        if ($this->userModel->checkcookie()) { 
            if (!isset($_GET['nickname'])){
                $data = $this->userModel->findusers(explode(',', $_COOKIE['logged'])[0]);
                if (!$data) {
                    http_response_code(404);
                    die("Database Error");
                }
                $this->view('profile', $data);
            } else {    
                if ($this->userModel->checkregistered_bynickname($_GET['nickname'])) {
                    $data = $this->userModel->findusersbynickname($_GET['nickname']);
                    setcookie('private', $_GET['nickname'], time() + 3600, '/');
                    if (!$data) {
                        http_response_code(404);
                        die("Database Error");
                    }
                    $this->view('profile', $data);
                } else if (!$this->userModel->checkregistered_bynickname($_GET['nickname'])) {
                    http_response_code(404);
                    die("HTTP Error " . 404 . ": " . "The user does not exist.");
                }        
            }
        } else {
            http_response_code(404);
            die("HTTP Error " . 404 . ": " . "You have tampered with your session or you have been logged out.");
        }
    }
}
