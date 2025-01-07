<?php
class Escola {
    
    public function cadastrar($nome,$endereco) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO escolas (nome, endereco) VALUES (?, ?)");
        return $stmt->execute([$nome, $endereco]);
    }

    public function editar($id, $nome, $endereco) {
        global $conn;
        $stmt = $conn->prepare("UPDATE escolas SET nome = ?, endereco = ? WHERE id = ?");
        return $stmt->execute([$nome, $endereco, $id]);
    }

    public function excluir($id) {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM escolas WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function listar() {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM escolas");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>