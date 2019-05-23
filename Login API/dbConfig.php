<?php
//namespace Model;
class dbConfig{

    protected $host = "localhost";
    protected $dbname = "plconnect";
    protected $user = "root";
    protected $pass = "55639191";
    protected $DBH;

    function __construct() {

        try {

            $this->DBH = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
            $this->DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }
        catch (PDOException $e) {

            echo $e->getMessage();
        }
    }

    public function connect(){

            $this->DBH->beginTransaction();
            $this->DBH->commit();
        return  $this->DBH;
    }
    
  public function closeConnection(){

        $this->DBH = null;
    }
    public function pdoObj(){
        $this->DBH = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
            $this->DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->DBH;
    }

}

?>
