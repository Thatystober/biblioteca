<?php

include_once('Livro.php');
include_once('LivroDAO.php');

class LivrosController{

    public function listar($request, $response, $args){
        $dao= new LivroDAO;   

        $livros = $dao->listar();
    
        return $response->withJson($livros);
    }

    public function inserir($request, $response, $args) {
        $data = $request->getParsedBody();
        $livro = new Livro(0, $data['isbn'],$data['nome'],$data['autor'],$data['editora'],$data['ano']);
    
        $dao = new LivroDAO;
        $livro = $dao->inserir($livro);
    
        return $response->withJson($livro,201);
    }

    public function buscarPorId($request, $response, $args) {
        $id = $args['id'];
        
        $dao= new LivroDAO;    
        $livro = $dao->buscarPorId($id);
        
        return $response->withJson($livro);
    }

    public function atualizar($request, $response,  $args) {
        $id = $args['id'];
        $data = $request->getParsedBody();
        $livro = new Livro($id, $data['isbn'],$data['nome'],$data['autor'],$data['editora'],$data['ano']);
        $dao = new LivroDAO;
        $livro = $dao->atualizar($livro);
    
        return $response->withJson($livro);
    }

    public function deletar($request, $response, $args) {
        $id = $args['id'];
    
        $dao = new LivroDAO;
        $livro = $dao->deletar($id);
    
        return $response->withJson($livro);
    }
}

?>