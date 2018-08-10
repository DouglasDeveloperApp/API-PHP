<?php
    // Conecte-se ao banco de dados
    // Database - arquivo usado para conectar ao banco de dados.
class Database{
 
    // especificar suas próprias credenciais de banco de dados
    private $host = "localhost";
    private $db_name = "api_db";
    private $username = "root";
    private $password = "00";
    public $conn;
 
    // obter a conexão com o banco de dados
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>
