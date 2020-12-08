<?php

class Usuario{

    public $id, $matricula, $nome, $email, $senha;

    function __construct($id, $matricula, $nome, $email, $senha) {

        $this->id           = $id;
        $this->matricula    = $matricula;
        $this->nome         = $nome;
        $this->email        = $email;
        $this->senha        = $senha;
    }
}
?>