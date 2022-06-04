<?php
use Hackzilla\PasswordGenerator\Generator\RequirementPasswordGenerator;
use Ramsey\Uuid\Uuid;

class User
{
    private $db;
    public function __construct()
    {
        $this->db = new database;
    }

    public function randpass()
    {
        $generator = new RequirementPasswordGenerator();
        $generator
        ->setLength(16)
        ->setOptionValue(RequirementPasswordGenerator::OPTION_UPPER_CASE, true)
        ->setOptionValue(RequirementPasswordGenerator::OPTION_LOWER_CASE, true)
        ->setOptionValue(RequirementPasswordGenerator::OPTION_NUMBERS, true)
        ->setOptionValue(RequirementPasswordGenerator::OPTION_SYMBOLS, true)
        ->setMinimumCount(RequirementPasswordGenerator::OPTION_UPPER_CASE, 2)
        ->setMinimumCount(RequirementPasswordGenerator::OPTION_LOWER_CASE, 2)
        ->setMinimumCount(RequirementPasswordGenerator::OPTION_NUMBERS, 2)
        ->setMinimumCount(RequirementPasswordGenerator::OPTION_SYMBOLS, 2)
        ->setMaximumCount(RequirementPasswordGenerator::OPTION_UPPER_CASE, 8)
        ->setMaximumCount(RequirementPasswordGenerator::OPTION_LOWER_CASE, 8)
        ->setMaximumCount(RequirementPasswordGenerator::OPTION_NUMBERS, 8)
        ->setMaximumCount(RequirementPasswordGenerator::OPTION_SYMBOLS, 8)
        ;
        $password = $generator->generatePassword();
        return $password;
    }

    public function login($username, $password)
    {
        $row = $this->findusers($username);
        if (isset($row['password'])) {
            $hashed = $row['password'];
            /* verify bcrypt */
            if (password_verify($password, $hashed)) {
                $cookies =  $username . ',' . password_hash($username . $this->randpass(), PASSWORD_BCRYPT);
                if (!isset($_COOKIE['logged'])) {
                    setcookie('logged', $cookies, time() + 3600, '/');
                    $this->db->query('UPDATE users SET cookies = :cookies WHERE username = :username');
                    $this->db->bind(':cookies', $cookies);
                    $this->db->bind(':username', $username);
                    $this->db->execute();
                    return ($this->db->execute() > 0);
                }
            }
        } else {
            return false;
        }
    }

    public function status($number, $username){
        $this->db->query('UPDATE users SET status = :status WHERE username = :username');
        $this->db->bind(':status', $number);
        $this->db->bind(':username', $username);
        return ($this->db->execute() > 0);
    }

    public function register($data)
    {
        $uuid = Uuid::uuid4();
        $this->db->query('INSERT INTO users (id, uuid, firstname, lastname, gender, email, username, password, nickname, status) VALUES(DEFAULT, :uuid, :firstname, :lastname, :gender, :email, :username, :password, :nickname, DEFAULT)');
        $this->db->bind(':firstname', $data['firstname']);
        $this->db->bind(':lastname', $data['lastname']);
        $this->db->bind(':gender', $data['gender']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':nickname', $data['nickname']);
        $this->db->bind(':uuid', $uuid);
        return ($this->db->execute() > 0); /*if larger than zero, return true */
    }

    public function update($username, $password, $data)
    {
        /* need correct password to update profile successfully */
        $sql = '';
        for ($i = 1; $i < 9; $i++) {
            $dbfields[] = array_keys($data)[$i];
        }
        $row = $this->findusers($username);
        if (password_verify($password, $row['password'])) {
            foreach ($dbfields as $name) {
                if (!empty($data[$name])) {
                    if ($name === 'file') {
                        $filename = $data['file'];
                        $tempname = $data['tempname'];
                        $uploadfolder =  './assets/usericon/' . $filename;
                        $sql .= "filename = " . "'" . $filename . "'" . ", ";
                        if (move_uploaded_file($tempname, $uploadfolder)) {
                        } else {
                            return false;
                        }
                    } else if ($name === 'tempname') {
                        $sql .= "";
                    } else {
                        $sql .= "$name = '{$data[$name]}', ";
                    }
                }
            }
            $sql = rtrim($sql, ', ');
            /* trim the end space and comma */
            $updatedsql = 'UPDATE users SET ' . $sql . ' WHERE username = :username';
            $this->db->query($updatedsql);
            $this->db->bind(':username', $username);
            if ($this->db->execute() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function checkregistered($email)
    {
        $this->db->query('SELECT COUNT(*) FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        if ($this->db->column() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkregistered_byusername($username)
    {
        $this->db->query('SELECT COUNT(*) FROM users WHERE username = :username');
        $this->db->bind(':username', $username);
        if ($this->db->column() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkregistered_bynickname($nickname)
    {
        $this->db->query('SELECT COUNT(*) FROM users WHERE nickname = :nickname');
        $this->db->bind(':nickname', $nickname);
        if ($this->db->column() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkstrongpassword($password)
    {
        return (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()-_+=~\/\?\[\]{}+])[A-Za-z\d!@#$%^&*()-_+=~\/\?\[\]{}+]{0,}$/', $password));
        if ($password['title'] === 'otp'){
            return (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()-_+=~\/\?\[\]{}+])[A-Za-z\d!@#$%^&*()-_+=~\/\?\[\]{}+]{16}$/', $password));
        }
    }

    public function checkusername($username)
    {
        return (preg_match('/^[a-zA-Z](?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{0,}$/', $username));
    }

    public function checkname($firstname, $lastname)
    {
        return (preg_match("/^[a-z ,.'-]+$/i", $firstname) && preg_match("/^[a-z ,.'-]+$/i", $lastname));
        /* not case sensitive regex */
    }

    public function checknickname($nickname)
    {
        return (preg_match("/^[a-zA-Z](?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{0,}$/", $nickname));
        /* not case sensitive regex */
    }

    public function checktext($text)
    {   
        return (preg_match("/^[a-z ,.'\-!]+$/i", $text));
    }

    public function checkcookie()
    {
        if (isset($_COOKIE['logged'])) {
            $this->db->query('SELECT cookies FROM users WHERE username = :username');
            $this->db->bind(':username', explode(',', $_COOKIE['logged'])[0]);
            $row = $this->db->single();
            if (isset($row['cookies'])){
                return ($_COOKIE['logged'] === $row['cookies']);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function checkimage($file)
    {
        /* https://www.php.net/manual/en/function.finfo-open.php */
        /* only receive image type file */
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $filetype = finfo_file($finfo, $file);
        $filesize = filesize($file);
        finfo_close($finfo);
        $allowedTypes = [
            'image/png' => 'png',
            'image/jpeg' => 'jpg',
            'image/gif' => 'gif',
        ];
        if ((substr($filetype, 0, 5) === 'image') && (in_array($filetype, array_keys($allowedTypes))) && ($filesize < 1048576)) {
            return true;
        } else {
            return false;
        }
    }

    public function findusers($username)
    {
        $this->db->query('SELECT * FROM users WHERE username = :username');
        $this->db->bind(':username', $username);
        $row = $this->db->single();
        return $row;
    }

    public function findusersbynickname($nickname)
    {
        $this->db->query('SELECT * FROM users WHERE nickname = :nickname');
        $this->db->bind(':nickname', $nickname);
        $row = $this->db->single();
        return $row;
    }


    public function findallusers()
    {
        $this->db->query('SELECT * FROM users');
        $row = $this->db->allresult();
        return $row;
    }

    public function totalusers()
    {
        $this->db->query('SELECT COUNT(*) FROM users');
        $row = $this->db->column();
        return $row;
    }

    /* Message functions here below */
    public function sendmessage($uuid, $from, $to, $message)
    {
        $this->db->query('INSERT INTO privatemessage (id, uuid, sender, receiver, msg, created_on) VALUES(default, :uuid, :sender, :receiver, :msg, now())');
        $this->db->bind(':uuid', $uuid);
        $this->db->bind(':sender', $from);
        $this->db->bind(':receiver', $to);
        $this->db->bind(':msg', $message);
        return ($this->db->execute() > 0);
    }

    public function getmessage($from, $to)
    {
        $this->db->query('SELECT * FROM privatemessage WHERE (sender = :user_from and receiver = :user_to) or (receiver = :user_from and sender = :user_to) ORDER BY privatemessage.id, privatemessage.created_on ASC');
        $this->db->bind(':user_from', $from);
        $this->db->bind(':user_to', $to);
        $row = $this->db->allresult();
        return $row;
    }

    public function getallmessage($from)
    {
        $this->db->query('SELECT * FROM privatemessage WHERE sender = :user_from');
        $this->db->bind(':user_from', $from);
        $row = $this->db->allresult();
        return $row;
    }

    public function countmessage($nickname)
    {
        $this->db->query('SELECT COUNT(*) as c FROM privatemessage WHERE nickname = :nickname');
        $this->db->bind(':nickname', $nickname);
        $row = $this->db->column();
        return $row;
    }
}
