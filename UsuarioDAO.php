<?php

include_once 'Usuario.php';
include_once 'Conexao.php';

class UsuarioDAO{
    public function inserir(Usuario $usuario){
        try{
            $inserir = "INSERT INTO usuarios(matricula, nome, email, senha) VALUES (:matricula,:nome,:email,:senha)";
            $pdo = Conexao::getConexao();
    
            $c = $pdo->prepare($inserir);
            $c-> bindParam(":matricula",$usuario->matricula);
            $c-> bindParam(":nome",$usuario->nome);
            $c-> bindParam(":email",$usuario->email);
            $c-> bindParam(":senha",$usuario->senha);
    
            $c->execute();
        }
        catch(PDOException $e)
        {
            echo "Statement failed: " . $e->getMessage();
        }
    }

    public function listar(){
        $listaClientes = array();
        try{
            $select = 'SELECT * FROM usuarios';
            $pdo = Conexao::getConexao();
    
            $c = $pdo->prepare($select);
            $c->execute();

            $listaClientes = $c->fetchAll(
                PDO::FETCH_ASSOC|PDO::FETCH_PROPS_LATE);
            return $listaClientes;
        }
        catch(PDOException $e)
        {
            echo "Statement failed: " . $e->getMessage();
        }
    }

    public function atualizar(Usuario $usuario){
        $atualizar = 'UPDATE usuarios SET matricula=:matricula, nome=:nome, email=:email, senha=:senha WHERE id=:id';
        
        $pdo = Conexao::getConexao();
        $c = $pdo->prepare($atualizar);

        $c->bindParam(":matricula",$usuario->matricula);
        $c->bindParam(":nome",$usuario->nome);
        $c->bindParam(":email",$usuario->email);
        $c->bindParam(":senha",$usuario->senha);
        $c->bindParam(":ano",$usuario->ano);
        $c->execute();  

    }

    public function buscarPorId($id){

        $selectId = 'SELECT * FROM usuarios WHERE id=:id';	

        $pdo = Conexao::getConexao();

        $c = $pdo->prepare($selectId);
        $c->bindParam ('id', $id);
        $c->execute();
        $c->setFetchMode(PDO::FETCH_ASSOC|PDO::FETCH_PROPS_LATE);
        
        $obj = $c->fetch();

        return($obj);
    }


    public function deletar($id){
        $deletar = "DELETE from usuarios WHERE id=:id";   

        $livro = $this->buscarPorId($id);
        $pdo = Conexao::getConexao();

        $c = $pdo->prepare($deletar);
        $c->bindParam(":id",$id);
        $c->execute();
    }

    public function buscarPorEmail($email){
        $selectEmail = 'SELECT * FROM usuarios WHERE email=:email';
        $pdo = Conexao::getConexao();

        $c = $pdo->prepare($selectEmail);
        $c->bindParam ('email', $email);
        $c->execute();
        $c->setFetchMode(PDO::FETCH_ASSOC|PDO::FETCH_PROPS_LATE);
        
        $obj = $c->fetch();

        return($obj);
    }
}

?>