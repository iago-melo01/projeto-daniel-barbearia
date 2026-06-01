<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<?php
require_once dirname(__DIR__, 2) . '/includes/admin/bootstrap.php';
adminHead('Clientes');
?>
</head>
<body class="admin-body">
<?php
adminTopBar('Clientes', array (
  0 => 
  array (
    'url' => '?query=admin/cliente/cadastro-cliente',
    'label' => 'Novo cliente',
    'class' => 'admin-btn-primary',
  ),
  1 => 
  array (
    'url' => '?query=admin/cliente/painel-admin-cliente',
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
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
        <?php
            $sql = "SELECT * FROM usuarios";
            $resultado = mysqli_query($connect, $sql);

            if(mysqli_num_rows($resultado) > 0) {
                while($dados = mysqli_fetch_array($resultado)) {
                    echo "<tr>";
                    echo "<td>" . $dados['id'] . "</td>";
                    echo "<td>" . htmlspecialchars($dados['cliente']) . "</td>";
                    echo "<td>" . htmlspecialchars($dados['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($dados['telefone']) . "</td>";
                    echo "<td class='actions-cell'>";
                    echo "<a href='?query=admin/cliente/cliente-form-editar&id=" . $dados['id'] . "' class='btn-edit'>Editar</a>";
                    echo "<a href='?query=admin/cliente/cliente-excluir&id=" . $dados['id'] . "' class='btn-delete'>Excluir</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='empty-message'>Nenhum cliente cadastrado.</td></tr>";
            }
        ?>
            </tbody>
        </table>
    </div>
<?php adminPageClose(); ?>
</body>
</html>
