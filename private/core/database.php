<?php
class database
{  /*
    DB_HOST
    DB_USER
    DB_PASS
    DB_NAME
    */

    private $db_host = DB_HOST;
    private $db_user = DB_USER;
    private $db_pass = DB_PASS;
    private $db_name = DB_NAME;
    private $stat;
    private $error;
    private $db_handler;


    public function __construct()
    {
        $conn = 'mysql:host=' . $this->db_host . ';dbname=' . $this->db_name;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try {
            $this->db_handler = new PDO($conn, $this->db_user, $this->db_pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    /* parameter binding */
    /* prevent sql injection */
    /* tell engine the data is a str/number/char */
    /* https://www.w3schools.com/Php/php_switch.asp */
    /* https://www.php.net/manual/en/pdostatement.bindvalue.php */
    public function bind($param, $value, $type = null)
    {
        switch (is_null($type)) {
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            default:
                $type = PDO::PARAM_STR;
        }
        $this->stat->bindValue($param, $value, $type);
    }

    /* short version */
    public function query($sql)
    {
        $this->stat = $this->db_handler->prepare($sql);
    }

    public function execute()
    {
        return $this->stat->execute();
    }

    /*https://www.php.net/manual/en/pdostatement.fetch.php*/
    public function single()
    {
        $this->execute();
        return $this->stat->fetch(PDO::FETCH_ASSOC);
    }
    
    public function allresult()
    {
        $this->execute();
        return $this->stat->fetchAll(PDO::FETCH_ASSOC);
    }

    /*rowcount() function has unexpected behaviour */
    public function column(){
        $this->execute();
        return $this->stat->fetchColumn();
    }
}
