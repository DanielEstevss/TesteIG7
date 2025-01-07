<?php
require_once __DIR__ . '/../models/Professor.php';

class ProfessorController {

    public function listar() {
        $professor = new Professor();
        return $professor->listar();
    }

    public function cadastrar($nome) {
        $professor = new Professor();
        return $professor->cadastrar($nome);
    }

    public function editar($id, $nome) {
        $professor = new Professor();
        return $professor->editar($id, $nome);
    }

    public function excluir($id) {
        $professor = new Professor();
        return $professor->excluir($id);
    }  
}
?>