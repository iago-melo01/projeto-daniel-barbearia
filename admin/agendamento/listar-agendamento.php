<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<?php
require_once dirname(__DIR__, 2) . '/includes/admin/bootstrap.php';
adminHead('Agendamentos');
?>
</head>
<body class="admin-body">
<?php
adminTopBar('Agendamentos', array (
  0 => 
  array (
    'url' => '?query=admin/agendamento/cadastro-agendamento',
    'label' => 'Novo agendamento',
    'class' => 'admin-btn-primary',
  ),
  1 => 
  array (
    'url' => '?query=admin/agendamento/painel-admin-agendamento',
    'label' => 'Voltar',
    'class' => 'admin-btn-secondary',
  ),
));
adminPageOpen();
?>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Barbeiro</th>
                    <th>Serviço</th>
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
                    echo "<td>" . $dados['nome_cliente'] . "</td>";
                    echo "<td>" . htmlspecialchars($dados['nome_barbeiro'] ? $dados['nome_barbeiro'] : 'Barbeiro #' . $dados['barbeiro']) . "</td>";
                    echo "<td>" . htmlspecialchars($dados['servico']) . "</td>";
                    echo "<td>" . date('d/m/Y H:i', strtotime($dados['horario'])) . "</td>";
                    echo "<td class='actions-cell'>";
                    echo "<a href='?query=admin/agendamento/agendamento-form-editar&id=" . $dados['id'] . "' class='btn-edit'>Editar</a>";
                    echo "<a href='?query=admin/agendamento/agendamento-excluir&id=" . $dados['id'] . "' class='btn-delete'>Excluir</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='empty-message'>Nenhum agendamento encontrado.</td></tr>";
            }
        ?>
            </tbody>
        </table>
    </div>
<?php adminPageClose(); ?>
</body>
</html>
