<?php
require_once __DIR__ . '/../models/Vinculo.php';

class VinculoController {

    public function vincular($id_professor, $id_turma) {
        $vinculo = new Vinculo();
        return $vinculo->vincular($id_professor, $id_turma);
    }

    public function desvincular($id_professor, $id_turma) {
        $vinculo = new Vinculo();
        return $vinculo->desvincular($id_professor, $id_turma);
    }

    public function listarProfessoresPorTurma($id_turma) {
        $vinculo = new Vinculo();
        return $vinculo->listarProfessoresPorTurma($id_turma);
    }

    public function listarTurmasPorProfessor($id_professor) {
        $vinculo = new Vinculo();
        return $vinculo->listarTurmasPorProfessor($id_professor);
    }
}
?>