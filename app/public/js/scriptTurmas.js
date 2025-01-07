function listarTurmas() {
    fetch('/api/getTurmas.php')
        .then(response => response.json())
        .then(data => {
            const turmasTable = document.getElementById('turmasTable').getElementsByTagName('tbody')[0];
            turmasTable.innerHTML = ''; // Limpa a tabela
            data.forEach(turma => {
                const row = turmasTable.insertRow();
                row.innerHTML = `
                    <td>${turma.id}</td>
                    <td>${turma.escola_nome}</td>
                    <td>${turma.turno}</td>
                    <td>${turma.nome}</td>
                    <td>
                        <button class="btn btn-warning" onclick="editarTurma(${turma.id})">Editar</button>
                        <button class="btn btn-danger" onclick="excluirTurma(${turma.id})">Excluir</button>
                    </td>
                `;
            });
        });
}

// Função para cadastrar uma nova turma
document.getElementById('formCadastrarTurma').addEventListener('submit', function (e) {
    e.preventDefault();

    const escola = document.getElementById('escolaTurma').value;
    const nome = document.getElementById('nomeTurma').value;
    const turno = document.getElementById('turnoTurma').value;

    const data = { escola, nome, turno };

    fetch('/api/cadastrarTurma.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                alert('Turma cadastrada com sucesso!');
                listarTurmas(); // Recarrega a lista de turmas
                $('#modalCadastrarTurma').modal('hide'); // Fecha o modal
            } else {
                alert('Erro ao cadastrar turma');
            }
        });
});

// Função para excluir uma turma
function excluirTurma(id) {
    fetch(`/api/excluirTurma.php?id=${id}`, { method: 'DELETE' })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                alert('Turma excluída com sucesso!');
                listarTurmas(); // Recarrega a lista de turmas
            } else {
                alert('Erro ao excluir turma');
            }
        });
}

// Função para editar uma turma
function editarTurma(id) {
    // Implementar a lógica para editar turma
}

// Carrega a lista de turmas ao iniciar a página
window.onload = function () {
    listarTurmas();
};