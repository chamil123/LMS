<?php
class MySQLDatabase {

    public $connection;
    function __construct() {
        $this->open_connection();
    }

    private function open_connection() {
        $this->connection =new  mysqli("localhost", "root", "","seminko");
        if (!$this->connection) {
            die("databe connection failed" . mysql_error());
        } 
    }
    public function close_connection(){
        if(isset($this->connection)){
           $this->connection->close();
            unset($this->connection);
        }
    }
    public function query($sql){
        $result=$this->connection->query($sql);
        if(!$result){
            die("Databse query failed bnbvn: ".$this-> connection->connect_error);
        }
        return $result;
    }public function lastInsertID(){
        $last_id = $this->connection->insert_id;
        return $last_id;
    }
   

}
?>
