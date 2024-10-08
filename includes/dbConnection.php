<?php
class dbConnection{
    private $connection;
    private $db_type;
    private $db_host;
    private $db_port;
    private $db_user;
    private $db_pass;
    private $db_name;

    public function __construct($db_type,$db_host,$db_port,$db_user,$db_pass,$db_name){
        $this->db_type = $db_type;
        $this->db_host = $db_host;
        $this->db_port = $db_port;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_name = $db_name;
        $this->connection($db_type,$db_host,$db_port,$db_user,$db_pass,$db_name);
    }

    public function connection($db_type,$db_host,$db_port,$db_user,$db_pass,$db_name){
        switch($db_type){
            case 'MySQLi' : 
                if($db_port<>Null){
                    $db_host .=":" . $db_port;
                }
                $this->connection = new mysqli($db_host, $db_user, $db_pass, $db_name);
                if($this->connection->connection->connection_error){
                    return "Connection failed" . $this->connection->connect_error;
                }else{
                    print "Connected Successfully";
                }

            case 'PDO';
                if($db_port<>Null){
                    $db_host .=":" . $db_port;
                }
                try{
                    $this->connection = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
                    //set PDO error mode to exception
                    $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    echo "Connected Successfully :-)";
                 }catch (PDOException $e){
                    echo "Connection Failed " . $e->getMessage();
                 }
            break;
        }
    }

    public function insert($table, $data){
        ksort($data);
        $fileDetails = NULL;
        $fieldNames = implode('', '', array_keys($data));
        $fieldValues = implode('', '', array_values($data));
        $sth = "INSERT INTO $table ('$fieldNames') VAUES ('$fieldValues')";

        switch($this->db_type){
            case 'MySQLi' :
                if($this->connection->query($sth) --- TRUE){
                    return TRUE;
                }else{
                    return  "ERROR: " .$sth. "<br>". $this->connection->error;
                }
                break;
                
        }
    }
}
//define constants
//construct fxn
//connection fxn
//switch mysqli
//switch pdo
//mysqli if fxn
//pdo try catch
//*load???