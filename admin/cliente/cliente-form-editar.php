<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
    
    $id = $_GET['id'];
    $sql = "SELECT * FROM usuarios WHERE id = '$id'";
    $resultado = mysqli_query($connect, $sql);
    
    if(mysqli_num_rows($resultado) > 0) {
        $cliente = mysqli_fetch_array($resultado);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<?php
require_once dirname(__DIR__, 2) . '/includes/admin/bootstrap.php';
adminHead('Editar Cliente');
?>
</head>
<body class="admin-body">
<?php
adminTopBar('Editar Cliente', array (
  0 => 
  array (
    'url' => '?query=admin/cliente/listar-cadastros',
    'label' => 'Voltar',
    'class' => 'admin-btn-secondary',
  ),
));
adminPageOpen('narrow');
?>

    <div class="form-container">
        <form action="?query=admin/cliente/cliente-alterar" method="post">
            <input type="hidden" name="id" value="<?=$cliente['id']?>">
            
            <div class="form-group">
                <label for="cliente">Nome Completo:</label>
                <input type="text" name="cliente" id="cliente" value="<?=htmlspecialchars($cliente['cliente'])?>" required>
            </div>

            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" value="<?=htmlspecialchars($cliente['email'])?>" required>
            </div>

            <div class="form-group">
                <label for="senha">Nova Senha (deixe em branco para manter a atual):</label>
                <input type="password" name="senha" id="senha" placeholder="Deixe em branco para manter a senha atual">
            </div>

            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" name="telefone" id="telefone" value="<?=htmlspecialchars($cliente['telefone'])?>" required>
            </div>
            
            <button type="submit" class="btn-submit">Salvar Alterações</button>
        </form>

        <div class="form-actions">
            <a href="?query=admin/cliente/listar-cadastros">Cancelar</a>
            <a href="?query=admin/cliente/painel-admin-cliente">Voltar ao Painel</a>
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
    <title>Cliente não encontrado</title>
</head>
<body>
    <div class="error-container">
        <h2>Cliente não encontrado!</h2>
        <a href="?query=admin/cliente/listar-cadastros">Voltar para lista</a>
    </div>
</body>
</html>
<?php
    }
?>

