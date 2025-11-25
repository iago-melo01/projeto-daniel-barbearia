<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
?>

<h1>Agendamentos</h1>
<a href="?query=admin/agendamento/cadastro-agendamento">Novo Agendamento</a> | 
<a href="?query=admin/agendamento/painel-admin-agendamento">Voltar ao Painel</a>
<hr>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Barbeiro</th>
            <th>Corte</th>
            <th>Data/Horário</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
<?php
    // JOIN para pegar o nome do barbeiro
    $sql = "SELECT a.*, b.nome as nome_barbeiro 
            FROM agendamento a 
            LEFT JOIN barbeiros b ON a.barbeiro = b.id 
            ORDER BY a.horario DESC";
    $resultado = mysqli_query($connect, $sql);

    if(mysqli_num_rows($resultado) > 0) {
        while($dados = mysqli_fetch_array($resultado)) {
            echo "<tr>";
            echo "<td>" . $dados['id'] . "</td>";
            echo "<td>" . ($dados['nome_barbeiro'] ? $dados['nome_barbeiro'] : 'Barbeiro #' . $dados['barbeiro']) . "</td>";
            echo "<td>" . $dados['corte'] . "</td>";
            echo "<td>" . date('d/m/Y H:i', strtotime($dados['horario'])) . "</td>";
            echo "<td>
                    <a href='?query=admin/agendamento/agendamento-form-editar&id=" . $dados['id'] . "'>Editar</a> |
                    <a href='?query=admin/agendamento/agendamento-excluir&id=" . $dados['id'] . "'>Excluir</a>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>Nenhum agendamento encontrado.</td></tr>";
    }
?>
    </tbody>
</table>
