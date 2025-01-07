<?php
class Turma {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;  // Armazena a conexão no objeto
    }

    public function cadastrar($id_escola, $nome, $turno) {
        $stmt = $this->conn->prepare("INSERT INTO turmas (id_escola, nome, turno) VALUES (?, ?, ?)");
        return $stmt->execute([$id_escola, $nome, $turno]);
    }

    public function editar($id, $id_escola, $nome, $turno) {
        $stmt = $this->conn->prepare("UPDATE turmas SET id_escola = ?, nome = ?, turno = ? WHERE id = ?");
        return $stmt->execute([$id_escola, $nome, $turno, $id]);
    }

    public function excluir($id) {
        $stmt = $this->conn->prepare("DELETE FROM turmas WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function listar() {
        $stmt = $this->conn->prepare("SELECT * FROM turmas");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>