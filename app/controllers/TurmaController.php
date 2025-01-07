<?php
require_once __DIR__ . '/../models/Turma.php';

class TurmaController {

    public function listar() {
        $turma = new Turma();
        return $turma->listar();
    }

    public function cadastrar($id_escola, $nome, $turno) {
        $turma = new Turma();
        return $turma->cadastrar($id_escola, $nome, $turno);
    }

    public function editar($id, $id_escola, $nome, $turno) {
        $turma = new Turma();
        return $turma->editar($id, $id_escola, $nome, $turno);
    }

    public function excluir($id) {
        $turma = new Turma();
        return $turma->excluir($id);
    }
}
?>