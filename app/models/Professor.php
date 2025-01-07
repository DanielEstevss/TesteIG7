<?php
class Professor {

    private $conn;

    public function __construct($database) {
        $this->conn = $database;  // Atribui a conexão ao atributo da classe
    }

    public function cadastrar($nome) {
        $stmt = $this->conn->prepare("INSERT INTO professores (nome) VALUES (?)");
        return $stmt->execute([$nome]);
    }

    public function editar($id, $nome) {
        $stmt = $this->conn->prepare("UPDATE professores SET nome = ? WHERE id = ?");
        return $stmt->execute([$nome, $id]);
    }

    public function excluir($id) {
        $stmt = $this->conn->prepare("DELETE FROM professores WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function listar() {
        $stmt = $this->conn->prepare("SELECT * FROM professores");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>