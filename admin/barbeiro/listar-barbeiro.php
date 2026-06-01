<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<?php
require_once dirname(__DIR__, 2) . '/includes/admin/bootstrap.php';
adminHead('Barbeiros');
?>
</head>
<body class="admin-body">
<?php
adminTopBar('Barbeiros', array (
  0 => 
  array (
    'url' => '?query=admin/barbeiro/cadastro-barbeiro',
    'label' => 'Novo barbeiro',
    'class' => 'admin-btn-primary',
  ),
  1 => 
  array (
    'url' => '?query=admin/barbeiro/painel-admin-barbeiro',
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
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
        <?php
            $sql = "SELECT * FROM barbeiros";
            $resultado = mysqli_query($connect, $sql);

            if(mysqli_num_rows($resultado) > 0) {
                while($dados = mysqli_fetch_array($resultado)) {
                    echo "<tr>";
                    echo "<td>" . $dados['id'] . "</td>";
                    echo "<td>" . htmlspecialchars($dados['nome']) . "</td>";
                    echo "<td>" . htmlspecialchars($dados['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($dados['descricao']) . "</td>";
                    echo "<td class='actions-cell'>";
                    echo "<a href='?query=admin/barbeiro/barbeiro-form-editar&id=" . $dados['id'] . "' class='btn-edit'>Editar</a>";
                    echo "<a href='?query=admin/barbeiro/barbeiro-excluir&id=" . $dados['id'] . "' class='btn-delete'>Excluir</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='empty-message'>Nenhum barbeiro cadastrado.</td></tr>";
            }
        ?>
            </tbody>
        </table>
    </div>
<?php adminPageClose(); ?>
</body>
</html>
