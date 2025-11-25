<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
    
    $id = $_GET['id'];
    $sql = "SELECT * FROM cortes WHERE id = '$id'";
    $resultado = mysqli_query($connect, $sql);
    
    if(mysqli_num_rows($resultado) > 0) {
        $corte = mysqli_fetch_array($resultado);
?>

<h2>Editar Corte</h2>
<form action="?query=admin/cortes/corte-alterar" method="post">
    <input type="hidden" name="id" value="<?=$corte['id']?>">
    
    <label>Nome do Corte:</label><br>
    <input type="text" name="corte" value="<?=$corte['corte']?>" required><br><br>
    
    <label>Descrição:</label><br>
    <textarea name="descricao" rows="4" cols="50" required><?=$corte['descricao']?></textarea><br><br>
    
    <label>Preço (R$):</label><br>
    <input type="number" name="preco" value="<?=$corte['preco']?>" required><br><br>
    
    <label>Imagem (URL):</label><br>
    <input type="text" name="imagem" value="<?=$corte['imagem']?>"><br><br>
    
    <input type="submit" value="Salvar Alterações"><br><br>
    <a href="?query=admin/cortes/listar-corte">Cancelar</a> | 
    <a href="?query=admin/cortes/painel-admin-cortes">Voltar ao Painel</a>
</form>

<?php
    } else {
        echo "<h2>Corte não encontrado!</h2>";
        echo "<a href='?query=admin/cortes/listar-corte'>Voltar para lista</a>";
    }
?>

