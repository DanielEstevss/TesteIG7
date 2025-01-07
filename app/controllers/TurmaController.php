<?php
require_once __DIR__ . '/../models/Turma.php';
require_once __DIR__ . '/../config/ConnectionDb.php';

class TurmaController {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function listar() {
        $turma = new Turma($this->conn);  // Passa a conexão para o modelo 
        return $turma->listar();
    }

    public function cadastrar($id_escola, $nome, $turno) {
        $turma = new Turma($this->conn);  // Passa a conexão para o modelo
        return $turma->cadastrar($id_escola, $nome, $turno);
    }

    public function editar($id, $id_escola, $nome, $turno) {
        $turma = new Turma($this->conn);  // Passa a conexão para o modelo
        return $turma->editar($id, $id_escola, $nome, $turno);
    }

    public function excluir($id) {
        $turma = new Turma($this->conn);  // Passa a conexão para o modelo
        return $turma->excluir($id);
    }
}
?>