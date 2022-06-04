<?php

use EasyCSRF\Exceptions\InvalidCsrfTokenException;

class Register extends Controller
{
	public function __construct()
	{
		$this->userModel = $this->model('User');
		$this->errorModel = $this->model('Formerror');
	}

	public function index()
	{
		$data = [
			'title' => 'register', /* tell formerror what page is it */
			'token' => ''
		];
		$sessionProvider = new EasyCSRF\NativeSessionProvider();
		$easyCSRF = new EasyCSRF\EasyCSRF($sessionProvider);
		$token = $easyCSRF->generate('regtoken');
		$data['token'] = $token;

		$this->view('register', $data);
	}

	public function checkerror()
	{
		if (isset($_SESSION['easycsrf_regtoken'])) {
			$data = [
				'title' => 'register', /* tell formerror what page is it */
				'firstname' => '',
				'lastname' => '',
				'email' => '',
				'nickname' => '',
				'username' => '',
				'password' => '',
				'confirmpassword' => '',
				'gender' => '',
				'confirm' => '',
				'nameError' => '',
				'nicknameError' => '',
				'usernameError' => '',
				'emailError' => '',
				'passwordError' => '',
				'confirmpasswordError' => '',
				'buttonError' => '',
				'confirmError' => '',
				'token' => '',
				'tokenError' => ''
			];

			$sessionProvider = new EasyCSRF\NativeSessionProvider();
			$easyCSRF = new EasyCSRF\EasyCSRF($sessionProvider);
			$data = $this->errorModel->checkerror($data);
			/* check no error as a function */
			if ($this->errorModel->checkerrorempty($data)) {
				try {
					$easyCSRF->check('regtoken', $_POST['token'], 5 * 60);
					$data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
					if ($this->userModel->register($data)) {
						echo json_encode(['status' => 99]);
					} else {
						http_response_code(404);
						die('Database Error. Register Failed');
					}
				} catch (InvalidCsrfTokenException $e) {
					$data['tokenError'] = $e->getMessage();
				}
			} else {
				$token = $easyCSRF->generate('regtoken');
				echo json_encode([
					'status' => 1,
					'token' => $token,
					'nameError' =>  $data['nameError'],
					'nicknameError' => $data['nicknameError'],
					'usernameError' => $data['usernameError'],
					'emailError' => $data['emailError'],
					'passwordError' =>  $data['passwordError'],
					'confirmpasswordError' => $data['confirmpasswordError'],
					'buttonError' => $data['buttonError'],
					'confirmError' => $data['confirmError'],
					'tokenError' => $data['tokenError']
				]);
			}
		}
	}
}
