<?php

include_once 'Livro.php';
include_once 'Conexao.php';

class LivroDAO{
    public function inserir(Livro $livro){
        try{
            $inserir = "INSERT INTO livros(isbn, nome, autor, editora, ano) VALUES (:isbn,:nome,:autor,:editora,:ano)";
            $pdo = Conexao::getConexao();
    
            $c = $pdo->prepare($inserir);
            $c-> bindParam(":isbn",$livro->isbn);
            $c-> bindParam(":nome",$livro->nome);
            $c-> bindParam(":autor",$livro->autor);
            $c-> bindParam(":editora",$livro->editora);
            $c-> bindParam(":ano",$livro->ano);
    
            $c->execute();
        }
        catch(PDOException $e)
        {
            echo "Statement failed: " . $e->getMessage();
        }
    }

    public function listar(){
        $listaLivros = array();
        try{
            $select = 'SELECT * FROM livros';
            $pdo = Conexao::getConexao();
    
            $c = $pdo->prepare($select);
            $c->execute();

            $listaLivros = $c->fetchAll(
                PDO::FETCH_ASSOC|PDO::FETCH_PROPS_LATE);
            return $listaLivros;
        }
        catch(PDOException $e)
        {
            echo "Statement failed: " . $e->getMessage();
        }
    }

    public function atualizar(Livro $livro){
        $atualizar = 'UPDATE livros SET isbn=:isbn, nome=:nome, autor=:autor, editora=:editora, ano=:ano WHERE id=:id';
        
        $pdo = Conexao::getConexao();
        $c = $pdo->prepare($atualizar);

        $c->bindParam(":isbn",$livro->isbn);
        $c->bindParam(":nome",$livro->nome);
        $c->bindParam(":autor",$livro->autor);
        $c->bindParam(":editora",$livro->editora);
        $c->bindParam(":ano",$livro->ano);
        $c->bindParam(":id",$livro->id);
        $c->execute();  

    }

    public function buscarPorId($id){

        $selectId = 'SELECT * FROM livros WHERE id=:id';	

        $pdo = Conexao::getConexao();

        $c = $pdo->prepare($selectId);
        $c->bindParam ('id', $id);
        $c->execute();
        $c->setFetchMode(PDO::FETCH_ASSOC|PDO::FETCH_PROPS_LATE);
        
        $obj = $c->fetch();

        return($obj);
    }


    public function deletar($id){
        $deletar = "DELETE from livros WHERE id=:id";   

        $livro = $this->buscarPorId($id);
        $pdo = Conexao::getConexao();

        $c = $pdo->prepare($deletar);
        $c->bindParam(":id",$id);
        $c->execute();
    }
}

?>