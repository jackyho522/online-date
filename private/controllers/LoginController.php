<?php

use EasyCSRF\Exceptions\InvalidCsrfTokenException;

class Login extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->errorModel = $this->model('Formerror');
    }

    public function index()
    {
        $data = [
            'title' => 'login', /* tell formerror what page is it */
            'tokenError' => '',
            'token' => ''
        ];

        $sessionProvider = new EasyCSRF\NativeSessionProvider();
        $easyCSRF = new EasyCSRF\EasyCSRF($sessionProvider);
        $token = $easyCSRF->generate('logtoken');
        $data['token'] = $token;
        $this->view('login', $data);
    }

    public function leave()
    {
        if (isset($_COOKIE['logged'])) {
            $this->userModel->status(0, explode(',', $_COOKIE['logged'])[0]);
            setcookie('logged', null, -1, '/');
            unset($_COOKIE['logged']);
            redirect('/' . URLROOT . '/login');
        }
    }

    public function checkerror()
    {
        if (isset($_SESSION['easycsrf_logtoken'])) {
            $data = [
                'title' => 'login',  /* tell formerror what page is it */
                'username' => '',
                'password' => '',
                'usernameError' => '',
                'passwordError' => '',
                'token' => '',
                'tokenError' => ''
            ];

            $sessionProvider = new EasyCSRF\NativeSessionProvider();
            $easyCSRF = new EasyCSRF\EasyCSRF($sessionProvider);
            $data = $this->errorModel->checkerror($data);
            /* check no error as a function */
            if ($this->errorModel->checkerrorempty($data)) {
                $logging = $this->userModel->login($data['username'], $data['password']);
                try {
                    $easyCSRF->check('logtoken', $_POST['token'], 5 * 60);
                    if ($logging) {
                        $this->userModel->status(1, $data['username']);
                        echo json_encode(['status' => 99]);
                    } else {
                        $data['passwordError'] = 'Username or password is not correct. Please try again.';
                        $token = $easyCSRF->generate('logtoken');
                        echo json_encode([
                            'status' => 1,
                            'token' => $token,
                            'usernameError' => $data['usernameError'],
                            'passwordError' =>  $data['passwordError'],
                            'tokenError' => $data['tokenError']
                        ]);
                    }
                } catch (InvalidCsrfTokenException $e) {
                    $data['tokenError'] = $e->getMessage();
                }
            } else {
                $token = $easyCSRF->generate('logtoken');
                echo json_encode([
                    'status' => 1,
                    'token' => $token,
                    'usernameError' => $data['usernameError'],
                    'passwordError' =>  $data['passwordError'],
                    'tokenError' => $data['tokenError']
                ]);
            }
        }
    }
}
