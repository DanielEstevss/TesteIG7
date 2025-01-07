<?php
require_once __DIR__ . '/../models/Escola.php';
require_once __DIR__ . '/../config/ConnectionDb.php'; // Importar a classe de conexão

class EscolaController {

    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();  // Obter a conexão
    }

    public function listar() {
        $escola = new Escola();
        return $escola->listar($this->conn);  // Passar a conexão ao método
    }

    public function cadastrar($nome, $endereco) {
        $escola = new Escola();
        return $escola->cadastrar($nome, $endereco, $this->conn);  // Passar a conexão
    }

    public function editar($id, $nome, $endereco) {
        $escola = new Escola();
        return $escola->editar($id, $nome, $endereco, $this->conn);  // Passar a conexão
    }

    public function excluir($id) {
        $escola = new Escola();
        return $escola->excluir($id, $this->conn);  // Passar a conexão
    }   
}
?>