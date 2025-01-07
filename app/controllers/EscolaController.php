<?php
require_once __DIR__ . '/../models/Escola.php';

class EscolaController {

    public function listar() {
        $escola = new Escola();
        return $escola->listar();
    }

    public function cadastrar($nome, $endereco) {
        $escola = new Escola();
        return $escola->cadastrar($nome, $endereco);
    }

    public function editar($id, $nome, $endereco) {
        $escola = new Escola();
        return $escola->editar($id, $nome, $endereco);
    }

    public function excluir($id) {
        $escola = new Escola();
        return $escola->excluir($id);
    }   
}
?>