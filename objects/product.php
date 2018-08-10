<?php
    // Leia os produtos
    // Product - contém propriedades e métodos para consultas de banco de dados "produto".
class Product{
 
    // conexão de banco de dados e nome da tabela
    private $conn;
    private $table_name = "products";
 
    // propriedades do objeto.
    public $id;
    public $name;
    public $description;
    public $price;
    public $category_id;
    public $category_name;
    public $created;
 
    // construtor com $ db como conexão de banco de dados
    public function __construct($db){
        $this->conn = $db;
    }

        // Leia produtos
    function read(){
     
        // selecionar toda a consulta
        $query = "SELECT
                    c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
                FROM
                    " . $this->table_name . " p
                    LEFT JOIN
                        categories c
                            ON p.category_id = c.id
                ORDER BY
                    p.created DESC";
     
        // preparar instrução de consulta
        $stmt = $this->conn->prepare($query);
     
        // executar consulta
        $stmt->execute();
     
        return $stmt;
    }

}
