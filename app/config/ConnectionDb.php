<?php
// Arquivo para gerenciar a conexão com o banco de dados
class Database {
    private $host = 'localhost';
    private $db_name = 'gestao_escolar';
    private $username = 'root';  // ou outro usuário
    private $password = '';      // ou a senha correspondente
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name}",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Erro de conexão: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>