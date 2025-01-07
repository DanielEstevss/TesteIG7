<?php
require_once __DIR__ . '/../config/ConnectionDb.php'; 

class Vinculo {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function vincular($id_professor, $id_turma) {
        $stmt = $this->conn->prepare("INSERT INTO vinculos (id_professor, id_turma) VALUES (?, ?)");
        return $stmt->execute([$id_professor, $id_turma]);
    }

    public function desvincular($id_professor, $id_turma) {
        $stmt = $this->conn->prepare("DELETE FROM vinculos WHERE id_professor = ? AND id_turma = ?");
        return $stmt->execute([$id_professor, $id_turma]);
    }

    public function listarProfessoresPorTurma($id_turma) {
        $stmt = $this->conn->prepare("SELECT * FROM vinculos WHERE id_turma = ?");
        $stmt->execute([$id_turma]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarTurmasPorProfessor($id_professor) {
        $stmt = $this->conn->prepare("SELECT * FROM vinculos WHERE id_professor = ?");
        $stmt->execute([$id_professor]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>