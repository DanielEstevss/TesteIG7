<?php
require_once 'app/controllers/EscolaController.php';
require_once 'app/controllers/ProfessorController.php';
require_once 'app/controllers/TurmaController.php';
require_once 'app/controllers/VinculoController.php';
require_once 'app/config/ConnectionDb.php';

// Cria a instância da classe Database para obter a conexão
$database = new Database();
$conn = $database->getConnection();  // Obtenha a conexão

// Instancia os controladores e passa a conexão para eles
$escolaController = new EscolaController($conn);
$professorController = new ProfessorController($conn);
$turmaController = new TurmaController($conn);
$vinculoController = new VinculoController($conn);

$action = $_GET['action'] ?? null;

// Detecta o método HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Se não houver ação, exibe a interface HTML
if ($method == 'GET' && !$action) {
    include 'index.html';  // Exibe o arquivo HTML da interface
    exit;  // Garante que o código abaixo não seja executado
}

header('Content-Type: application/json');

// Ação para listar escolas
if ($action === 'listarEscolas' && $method === 'GET') {
    echo json_encode($escolaController->listar());
}

// Ação para cadastrar escola
elseif ($action === 'cadastrarEscola' && $method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $nome = $data['nome'] ?? null;
    $endereco = $data['endereco'] ?? null;

    if ($nome && $endereco) {
        $result = $escolaController->cadastrar($nome, $endereco);
        echo json_encode(['success' => $result, 'message' => $result ? 'Escola cadastrada com sucesso!' : 'Erro ao cadastrar escola!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Dados insuficientes para cadastrar escola!']);
    }
}

// Ação para editar escola
elseif ($action === 'editarEscola' && $method === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'] ?? null;
    $nome = $data['nome'] ?? null;
    $endereco = $data['endereco'] ?? null;

    if ($id && $nome && $endereco) {
        $result = $escolaController->editar($id, $nome, $endereco);
        echo json_encode(['success' => $result, 'message' => $result ? 'Escola editada com sucesso!' : 'Erro ao editar escola!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Dados insuficientes para editar escola!']);
    }
}

// Ação para excluir escola
elseif ($action === 'excluirEscola' && $method === 'DELETE') {
    $id = $_GET['id'] ?? null;
    if ($id) {
        $result = $escolaController->excluir($id);
        echo json_encode(['success' => $result, 'message' => $result ? 'Escola excluída com sucesso!' : 'Erro ao excluir escola!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'ID da escola não fornecido!']);
    }
}

// Ação para listar professores
elseif ($action === 'listarProfessores' && $method === 'GET') {
    echo json_encode($professorController->listar());
}

// Ação para cadastrar professor
elseif ($action === 'cadastrarProfessor' && $method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $nome = $data['nome'] ?? null;

    if ($nome) {
        $result = $professorController->cadastrar($nome);
        echo json_encode(['success' => $result, 'message' => $result ? 'Professor cadastrado com sucesso!' : 'Erro ao cadastrar professor!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Nome do professor não fornecido!']);
    }
}

// Ação para editar professor
elseif ($action === 'editarProfessor' && $method === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'] ?? null;
    $nome = $data['nome'] ?? null;

    if ($id && $nome) {
        $result = $professorController->editar($id, $nome);
        echo json_encode(['success' => $result, 'message' => $result ? 'Professor editado com sucesso!' : 'Erro ao editar professor!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Dados insuficientes para editar professor!']);
    }
}

// Ação para excluir professor
elseif ($action === 'excluirProfessor' && $method === 'DELETE') {
    $id = $_GET['id'] ?? null;
    if ($id) {
        $result = $professorController->excluir($id);
        echo json_encode(['success' => $result, 'message' => $result ? 'Professor excluído com sucesso!' : 'Erro ao excluir professor!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'ID do professor não fornecido!']);
    }
}

// Ação para listar turmas
elseif ($action === 'listarTurmas' && $method === 'GET') {
    echo json_encode($turmaController->listar());
}

// Ação para cadastrar turma
elseif ($action === 'cadastrarTurma' && $method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id_escola = $data['id_escola'] ?? null;
    $nome = $data['nome'] ?? null;
    $turno = $data['turno'] ?? null;

    if ($id_escola && $nome && $turno) {
        $result = $turmaController->cadastrar($id_escola, $nome, $turno);
        echo json_encode(['success' => $result, 'message' => $result ? 'Turma cadastrada com sucesso!' : 'Erro ao cadastrar turma!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Dados insuficientes para cadastrar turma!']);
    }
}

// Ação para editar turma
elseif ($action === 'editarTurma' && $method === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'] ?? null;
    $id_escola = $data['id_escola'] ?? null;
    $nome = $data['nome'] ?? null;
    $turno = $data['turno'] ?? null;

    if ($id && $id_escola && $nome && $turno) {
        $result = $turmaController->editar($id, $id_escola, $nome, $turno);
        echo json_encode(['success' => $result, 'message' => $result ? 'Turma editada com sucesso!' : 'Erro ao editar turma!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Dados insuficientes para editar turma!']);
    }
}

// Ação para excluir turma
elseif ($action === 'excluirTurma' && $method === 'DELETE') {
    $id = $_GET['id'] ?? null;
    if ($id) {
        $result = $turmaController->excluir($id);
        echo json_encode(['success' => $result, 'message' => $result ? 'Turma excluída com sucesso!' : 'Erro ao excluir turma!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'ID da turma não fornecido!']);
    }
}

// Ação para vincular professor a turma
elseif ($action === 'vincular' && $method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id_professor = $data['id_professor'] ?? null;
    $id_turma = $data['id_turma'] ?? null;

    if ($id_professor && $id_turma) {
        $result = $vinculoController->vincular($id_professor, $id_turma);
        echo json_encode(['success' => $result, 'message' => $result ? 'Vinculação realizada com sucesso!' : 'Erro ao vincular professor à turma!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Dados insuficientes para vinculação!']);
    }
}

// Ação para desvincular professor de turma
elseif ($action === 'desvincular' && $method === 'DELETE') {
    $id_professor = $_GET['id_professor'] ?? null;
    $id_turma = $_GET['id_turma'] ?? null;

    if ($id_professor && $id_turma) {
        $result = $vinculoController->desvincular($id_professor, $id_turma);
        echo json_encode(['success' => $result, 'message' => $result ? 'Desvinculação realizada com sucesso!' : 'Erro ao desvincular professor de turma!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Dados insuficientes para desvinculação!']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Ação não encontrada ou método HTTP incorreto!']);
}
?>