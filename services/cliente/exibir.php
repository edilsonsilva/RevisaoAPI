<?php

header("Access-Control-Allow-Origin:*");

header("Content-Type:application/json;charset=utf-8");

include_once "../../config/database.php";
include_once "../../domain/cliente.php";

$database = new Database();

$db=$database->getConnection();

$cliente = new Cliente($db);

$resultado = $cliente->listar();

if($resultado->rowCount()>0){
    $cliente_arr["dados"] = array();

    while($linha = $resultado->fetch(PDO::FETCH_ASSOC)){

        extract($linha);
        
        $array_item=array(
            "idcliente"=>$idcliente,
            "nome"=>$nome,
            "email"=>$email,
            "sexo"=>$sexo,
            "usuario"=>$usuario
        );

        array_push($cliente_arr["dados"],$array_item);
    }

    header("HTTP/1.0 200");
    echo json_encode($cliente_arr);
}
else{
header("HTTP/1.0 400");
echo json_encode(array("mensagem"=>"Não foi possível listar os clientes"));
}
?>