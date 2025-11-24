<?php
    require_once "../conectaMYSQL.php";
    $id = $_GET['id'];
    $sql = "SELECT * FROM cortes WHERE id = '$id'";
    $resultado = mysqli_query($connect, $sql);
    if(mysqli_num_rows($resultado) > 0){
        $pagina = mysqli_fetch_array($resultado);


?>

<h2>Alteração de páginas</h2>
<form action="?pg=cortes-alterar" method="post">
    <input type="hidden" name="id" value="<?=$pagina['id']?>">
    <label>Nome do corte:</label><br>
    <input type="text" name="corte" value="<?=$pagina['corte']?>"><br>
    <label>Descrição:</label><br>
    <input type="text" name="descricao" value="<?=$pagina['descricao']?>"><br>
    <label>Preço:</label><br>
    <input type="number" name="preco" value="<?=$pagina['preco']?>"><br>
    <label>Imagem do corte (URL):</label><br>
    <input type="text" name="imagem" value="<?=$pagina['imagem']?>"><br>
    <input type="submit" value="Alterar página"><br><br>
    <a href='?pg=paginas'>Voltar</a>
</form>

<?php
    }else{
        echo "<h2>Nenhuma página cadastrada!</h2>";
    }
?>