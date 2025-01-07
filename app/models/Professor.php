<?php
class Professor {

    public function cadastrar($nome) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO professores (nome) VALUES (?)");
        return $stmt->execute([$nome]);
    }

    public function editar($id, $nome) {
        global $conn;
        $stmt = $conn->prepare("UPDATE professores SET nome = ? WHERE id = ?");
        return $stmt->execute([$nome, $id]);
    }

    public function excluir($id) {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM professores WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function listar() {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM professores");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>