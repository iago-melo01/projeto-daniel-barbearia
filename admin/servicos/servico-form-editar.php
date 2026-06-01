<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
    
    $id = $_GET['id'];
    $sql = "SELECT * FROM servicos WHERE id = '$id'";
    $resultado = mysqli_query($connect, $sql);
    
    if(mysqli_num_rows($resultado) > 0) {
        $servico = mysqli_fetch_array($resultado);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<?php
require_once dirname(__DIR__, 2) . '/includes/admin/bootstrap.php';
adminHead('Editar Serviço');
?>
</head>
<body class="admin-body">
<?php
adminTopBar('Editar Serviço', array (
  0 => 
  array (
    'url' => '?query=admin/servicos/listar-servico',
    'label' => 'Voltar',
    'class' => 'admin-btn-secondary',
  ),
));
adminPageOpen('narrow');
?>

    <div class="form-container">
        <form action="?query=admin/servicos/servico-alterar" method="post">
            <input type="hidden" name="id" value="<?=$servico['id']?>">
            
            <div class="form-group">
                <label for="servico">Nome do Serviço:</label>
                <input type="text" name="servico" id="servico" value="<?=htmlspecialchars($servico['servico'])?>" required>
            </div>
            
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea name="descricao" id="descricao" rows="4" required><?=htmlspecialchars($servico['descricao'])?></textarea>
            </div>
            
            <div class="form-group">
                <label for="preco">Preço (R$):</label>
                <input type="number" name="preco" id="preco" step="0.01" min="0" value="<?=$servico['preco']?>" required>
            </div>
            
            <div class="form-group">
                <label for="imagem">Imagem (URL):</label>
                <input type="text" name="imagem" id="imagem" value="<?=htmlspecialchars($servico['imagem'])?>">
            </div>
            
            <button type="submit" class="btn-submit">Salvar Alterações</button>
        </form>

        <div class="form-actions">
            <a href="?query=admin/servicos/listar-servico">Cancelar</a>
            <a href="?query=admin/servicos/painel-admin-servicos">Voltar ao Painel</a>
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
    <title>Serviço não encontrado</title>
</head>
<body>
    <div class="error-container">
        <h2>Serviço não encontrado!</h2>
        <a href="?query=admin/servicos/listar-servico">Voltar para lista</a>
    </div>
</body>
</html>
<?php
    }
?>

