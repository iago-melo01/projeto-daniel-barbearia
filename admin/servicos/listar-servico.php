<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<?php
require_once dirname(__DIR__, 2) . '/includes/admin/bootstrap.php';
adminHead('Serviços');
?>
</head>
<body class="admin-body">
<?php
adminTopBar('Serviços', array (
  0 => 
  array (
    'url' => '?query=admin/servicos/cadastro-servico',
    'label' => 'Novo serviço',
    'class' => 'admin-btn-primary',
  ),
  1 => 
  array (
    'url' => '?query=admin/servicos/painel-admin-servicos',
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
                    <th>Serviço</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Imagem</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
        <?php
            $sql = "SELECT * FROM servicos";
            $resultado = mysqli_query($connect, $sql);

            if(mysqli_num_rows($resultado) > 0) {
                while($dados = mysqli_fetch_array($resultado)) {
                    echo "<tr>";
                    echo "<td>" . $dados['id'] . "</td>";
                    echo "<td>" . htmlspecialchars($dados['servico']) . "</td>";
                    echo "<td>" . htmlspecialchars($dados['descricao']) . "</td>";
                    echo "<td class='price-cell'>R$ " . number_format($dados['preco'], 2, ',', '.') . "</td>";
                    echo "<td class='image-cell'>" . htmlspecialchars($dados['imagem']) . "</td>";
                    echo "<td class='actions-cell'>";
                    echo "<a href='?query=admin/servicos/servico-form-editar&id=" . $dados['id'] . "' class='btn-edit'>Editar</a>";
                    echo "<a href='?query=admin/servicos/servico-excluir&id=" . $dados['id'] . "' class='btn-delete'>Excluir</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='empty-message'>Nenhum serviço cadastrado.</td></tr>";
            }
        ?>
            </tbody>
        </table>
    </div>
<?php adminPageClose(); ?>
</body>
</html>
