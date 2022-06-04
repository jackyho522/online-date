<?php

class Allusers extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        if ($this->userModel->checkcookie()) {
            $data = $this->userModel->findallusers();
            $this->view('allusers', $data);
        } else {
            http_response_code(404);
            die("HTTP Error " . 404 . ": " . "You have tampered with your session or you have been logged out.");
        }
    }
}
