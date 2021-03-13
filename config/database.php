<?php
class Database
{
    private $host      = "216.172.172.220";
    private $db_name   = "mar47368_easywatch";
    private $username  = "mar47368_mar4736";
    private $password  = "vSqXUDV68EU;";
    public $conn;

    public function getConnection()
    {
        $this->conn = null;

        try
        {
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name,$this->username,$this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        }
        catch(PDOException $exception)
        {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
