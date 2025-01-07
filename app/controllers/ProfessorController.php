<?php
require_once __DIR__ . '/../models/Professor.php';
require_once __DIR__ . '/../config/ConnectionDb.php';

class ProfessorController {

    private $conn;

    public function __construct($database) {
        $this->conn = $database;  // Passa a conexão para o controlador
    }

    public function listar() {
        $professor = new Professor($this->conn);  // Passa a conexão para o model
        return $professor->listar();
    }

    public function cadastrar($nome) {
        $professor = new Professor($this->conn);
        return $professor->cadastrar($nome);
    }

    public function editar($id, $nome) {
        $professor = new Professor($this->conn);
        return $professor->editar($id, $nome);
    }

    public function excluir($id) {
        $professor = new Professor($this->conn);
        return $professor->excluir($id);
    }
}
?>