<?php
require_once __DIR__ . '/../models/Vinculo.php';
require_once __DIR__ . '/../config/ConnectionDb.php';

class VinculoController {

    private $conn;

    public function __construct() {
        // Crie uma instância da classe Database
        $database = new Database();
        $this->conn = $database->getConnection();  // Obtenha a conexão
    }

    public function vincular($id_professor, $id_turma) {
        $vinculo = new Vinculo($this->conn);
        return $vinculo->vincular($id_professor, $id_turma);
    }

    public function desvincular($id_professor, $id_turma) {
        $vinculo = new Vinculo($this->conn);
        return $vinculo->desvincular($id_professor, $id_turma);
    }

    public function listarProfessoresPorTurma($id_turma) {
        $vinculo = new Vinculo($this->conn);
        return $vinculo->listarProfessoresPorTurma($id_turma);
    }

    public function listarTurmasPorProfessor($id_professor) {
        $vinculo = new Vinculo($this->conn);
        return $vinculo->listarTurmasPorProfessor($id_professor);
    }
}
?>