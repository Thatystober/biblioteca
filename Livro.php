<?php

class Livro{

    public $id, $isbn, $nome, $autor, $editora, $ano;

    function __construct($id, $isbn, $nome, $autor, $editora, $ano) {

        $this->id       = $id;
        $this->isbn     = $isbn;
        $this->nome     = $nome;
        $this->autor    = $autor;
        $this->editora  = $editora;
        $this->ano      = $ano;
    }
}
?>