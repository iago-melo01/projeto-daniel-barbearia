<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
    $sql = "SELECT * FROM fale_conosco ORDER BY data_envio DESC";
    $result = mysqli_query($connect, $sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<?php
require_once dirname(__DIR__, 2) . '/includes/admin/bootstrap.php';
adminHead('Mensagens');
?>
</head>
<body class="admin-body">
<?php
adminTopBar('Mensagens', array (
  0 => 
  array (
    'url' => '?query=admin/faleconosco/painel-admin-faleconosco',
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
                    <th>Assunto</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
            <?php if(mysqli_num_rows($result) > 0): ?>
                <?php while($f = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $f['id'] ?></td>
                        <td><?= htmlspecialchars($f['nome']) ?></td>
                        <td><?= htmlspecialchars($f['email']) ?></td>
                        <td><?= htmlspecialchars($f['assunto']) ?></td>
                        <td><?= htmlspecialchars($f['status']) ?></td>

                        <td class="actions-cell">
                            <a class="btn-view" href="?query=admin/faleconosco/visualizar&id=<?= $f['id'] ?>">Ver</a>
                            <a class="btn-delete" href="?query=admin/faleconosco/deletar&id=<?= $f['id'] ?>">Excluir</a>
                        </td>
                    </tr>
                <?php endwhile; ?>

            <?php else: ?>
                <tr>
                    <td colspan="6" class="empty-message">Nenhuma mensagem recebida.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php adminPageClose(); ?>
</body>
</html>
