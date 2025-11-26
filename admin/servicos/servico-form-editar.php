<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
    
    $id = $_GET['id'];
    $sql = "SELECT * FROM servicos WHERE id = '$id'";
    $resultado = mysqli_query($connect, $sql);
    
    if(mysqli_num_rows($resultado) > 0) {
        $servico = mysqli_fetch_array($resultado);
?>

<h2>Editar Serviço</h2>
<form action="?query=admin/servicos/servico-alterar" method="post">
    <input type="hidden" name="id" value="<?=$servico['id']?>">
    
    <label>Nome do Serviço:</label><br>
    <input type="text" name="servico" value="<?=$servico['servico']?>" required><br><br>
    
    <label>Descrição:</label><br>
    <textarea name="descricao" rows="4" cols="50" required><?=$servico['descricao']?></textarea><br><br>
    
    <label>Preço (R$):</label><br>
    <input type="number" name="preco" value="<?=$servico['preco']?>" required><br><br>
    
    <label>Imagem (URL):</label><br>
    <input type="text" name="imagem" value="<?=$servico['imagem']?>"><br><br>
    
    <input type="submit" value="Salvar Alterações"><br><br>
    <a href="?query=admin/servicos/listar-servico">Cancelar</a> | 
    <a href="?query=admin/servicos/painel-admin-servicos">Voltar ao Painel</a>
</form>

<?php
    } else {
        echo "<h2>Serviço não encontrado!</h2>";
        echo "<a href='?query=admin/servicos/listar-servico'>Voltar para lista</a>";
    }
?>

