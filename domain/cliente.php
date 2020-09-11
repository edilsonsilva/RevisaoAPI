<?php

class Cliente{

    public $idcliente;
    public $nome;
    public $email;
    public $sexo;
    public $usuario;
    public $senha;


    public function __construct($db){
        $this->conexao = $db;
    }

    public function listar(){
        $consulta = "select * from cliente";

        $stmt=$this->conexao->prepare($consulta);

        $stmt->execute();

        return $stmt;
    }

    public function cadastro(){
        $consulta = "insert into cliente set nome=:n, email=:e, sexo=:s, usuario=:u, senha=:sh";

        $stmt=$this->conexao->prepare($consulta);

        $this->senha = md5($this->senha);

        $stmt->bindParam(":n",$this->nome);
        $stmt->bindParam(":e",$this->email);
        $stmt->bindParam(":s",$this->sexo);
        $stmt->bindParam(":u",$this->usuario);
        $stmt->bindParam(":sh",$this->senha);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }

    }

    public function atualizar(){
        $consulta = "update cliente set nome=:n, email=:e, sexo=:s, usuario=:u, senha=:sh where idcliente=:id";

        $stmt=$this->conexao->prepare($consulta);

        $stmt->bindParam(":n",$this->nome);
        $stmt->bindParam(":e",$this->email);
        $stmt->bindParam(":s",$this->sexo);
        $stmt->bindParam(":u",$this->usuario);
        $stmt->bindParam(":sh",$this->senha);
        $stmt->bindParam(":id",$this->idcliente);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }

    }

    public function delete(){
        $consulta = "delete from cliente where idcliente=:id";

        $stmt=$this->conexao->prepare($consulta);

     
        $stmt->bindParam(":id",$this->idcliente);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }

    }
}




?>