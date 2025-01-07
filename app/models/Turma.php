<?php
class Turma {

    public function cadastrar($id_escola, $nome, $turno) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO turmas (id_escola, nome, turno) VALUES (?, ?, ?)");
        return $stmt->execute([$id_escola, $nome, $turno]);
    }

    public function editar($id, $id_escola, $nome, $turno) {
        global $conn;
        $stmt = $conn->prepare("UPDATE turmas SET id_escola = ?, nome = ?, turno = ? WHERE id = ?");
        return $stmt->execute([$id_escola, $nome, $turno, $id]);
    }

    public function excluir($id) {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM turmas WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function listar() {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM turmas");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>