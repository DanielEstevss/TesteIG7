// Função para listar as turmas
fetch('index.php?action=listarTurmas')
    .then(response => response.json())
    .then(data => {
        const turmasTable = document.getElementById('turmasTable').getElementsByTagName('tbody')[0];
        turmasTable.innerHTML = ''; // Limpa a tabela
        data.forEach(turma => {
            const row = turmasTable.insertRow();
            row.innerHTML = `
                <td>${turma.id}</td>
                <td>${turma.nome}</td>
                <td>${turma.turno}</td>
                <td>${turma.id_escola}</td>
                <td>
                    <button class="editar" onclick="editarTurma(${turma.id})">Editar</button>
                    <button class="excluir" onclick="excluirTurma(${turma.id})">Excluir</button>
                </td>
            `;
        });
    })
    .catch(error => {
        console.error('Erro ao listar as turmas:', error);
        alert('Erro ao carregar as turmas');
    });

// Função para cadastrar uma nova turma
document.getElementById('formCadastrarTurma').addEventListener('submit', function (e) {
    e.preventDefault();

    const nome = document.getElementById('nomeTurma').value;
    const turno = document.getElementById('turnoTurma').value;
    const id_escola = document.getElementById('idEscolaTurma').value;

    const data = { nome, turno, id_escola };

    fetch('index.php?action=cadastrarTurma', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            alert('Turma cadastrada com sucesso!');
            listarTurmas(); // Recarrega a lista de turmas
            document.getElementById('modalCadastrarTurma').style.display = 'none'; // Fecha o modal
        } else {
            alert('Erro ao cadastrar turma');
        }
    });
});

// Função para excluir uma turma
function excluirTurma(id) {
    fetch(`index.php?action=excluirTurma&id=${id}`, { method: 'DELETE' })
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
    const nome = prompt("Digite o novo nome da turma:");
    const turno = prompt("Digite o novo turno da turma:");
    const id_escola = prompt("Digite o ID da nova escola:");

    if (nome && turno && id_escola) {
        fetch('index.php?action=editarTurma', {
            method: 'PUT',  // Usando PUT para editar
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                id: id,
                nome: nome,
                turno: turno,
                id_escola: id_escola
            })
        })
        .then(response => response.json())  // Converte a resposta para JSON
        .then(result => {
            if (result.success) {
                alert('Turma editada com sucesso!');
                listarTurmas(); // Recarrega a lista de turmas
            } else {
                alert('Erro ao editar turma');
            }
        })
        .catch(error => {
            console.error('Erro ao editar a turma:', error);
        });
    } else {
        alert('Nome, turno ou ID da escola não informado.');
    }
}

// Carrega a lista de turmas ao iniciar a página
window.onload = function () {
    listarTurmas();
};