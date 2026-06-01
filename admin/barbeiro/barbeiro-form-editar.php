<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
    
    $id = $_GET['id'];
    $sql = "SELECT * FROM barbeiros WHERE id = '$id'";
    $resultado = mysqli_query($connect, $sql);
    
    if(mysqli_num_rows($resultado) > 0) {
        $barbeiro = mysqli_fetch_array($resultado);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<?php
require_once dirname(__DIR__, 2) . '/includes/admin/bootstrap.php';
adminHead('Editar Barbeiro');
?>
</head>
<body class="admin-body">
<?php
adminTopBar('Editar Barbeiro', array (
  0 => 
  array (
    'url' => '?query=admin/barbeiro/listar-barbeiro',
    'label' => 'Voltar',
    'class' => 'admin-btn-secondary',
  ),
));
adminPageOpen('narrow');
?>

    <div class="form-container">
        <form action="?query=admin/barbeiro/barbeiro-alterar" method="post">
            <input type="hidden" name="id" value="<?=$barbeiro['id']?>">
            
            <div class="form-group">
                <label for="nome">Nome do Barbeiro:</label>
                <input type="text" name="nome" id="nome" value="<?=($barbeiro['nome'])?>" required>
            </div>

            <div class="form-group">
                <label for="email_id">E-mail do Barbeiro:</label>
                <input type="email" name="email" id="email_id" value="<?=($barbeiro['email'])?>" required>
            </div>

            <div class="form-group">
                <label for="senha_id">Senha:</label>
                <input type="text" name="senha" id="senha_id" value="<?=($barbeiro['senha'])?>" required>
            </div>
            
            <div class="form-group">
                <label for="descricao">Descrição / Especialidade:</label>
                <textarea name="descricao" id="descricao" rows="4" required><?=($barbeiro['descricao'])?></textarea>
            </div>
            
            <button type="submit" class="btn-submit">Salvar Alterações</button>
        </form>

        <div class="form-actions">
            <a href="?query=admin/barbeiro/listar-barbeiro">Cancelar</a>
            <a href="?query=admin/barbeiro/painel-admin-barbeiro">Voltar ao Painel</a>
        </div>
    </div>
</body>
</html>
<?php
    } else {
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barbeiro não encontrado</title>
</head>
<body>
    <div class="error-container">
        <h2>Barbeiro não encontrado!</h2>
        <a href="?query=admin/barbeiro/listar-barbeiro">Voltar para lista</a>
    </div>
</body>
</html>
<?php
    }
?>

