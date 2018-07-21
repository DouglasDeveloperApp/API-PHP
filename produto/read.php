<?php

// Read ------ read.php - arquivo que produzirá dados JSON baseados em registros de banco de dados de "produtos".

// cabeçalhos obrigatórios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// incluir arquivos de banco de dados e objetos
include_once '../config/database.php';
include_once '../objects/product.php';
 
// instanciar banco de dados e objeto de produto
$database = new Database();
$db = $database->getConnection();
 
// inicializar objeto
$product = new Product($db);
 
// produtos de consulta
$stmt = $product->read();
$num = $stmt->rowCount();
 
// verifique se mais de 0 registro foi encontrado
if($num>0){
 
    // matriz de produtos
    $products_arr=array();
    $products_arr["records"]=array();
 
    // recuperar o conteúdo da tabela
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extrair linha
        // isso fará $ row ['name']
        // apenas $name apenas
        extract($row);
 
        $product_item=array(
            "id" => $id,
            "name" => $name,
            "description" => html_entity_decode($description),
            "price" => $price,
            "category_id" => $category_id,
            "category_name" => $category_name
        );
 
        array_push($products_arr["records"], $product_item);
    }
 
    echo json_encode($products_arr);
}
 
else{
    echo json_encode(
        array("message" => "Nenhum produto encontrado.")
    );
}
?>