<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
    
    $id = $_GET['id'];
    $sql = "SELECT * FROM barbeiros WHERE id = '$id'";
    $resultado = mysqli_query($connect, $sql);
    
    if(mysqli_num_rows($resultado) > 0) {
        $barbeiro = mysqli_fetch_array($resultado);
?>

<h2>Editar Barbeiro</h2>
<form action="?query=admin/barbeiro/barbeiro-alterar" method="post">
    <input type="hidden" name="id" value="<?=$barbeiro['id']?>">
    
    <label>Nome do Barbeiro:</label><br>
    <input type="text" name="nome" value="<?=$barbeiro['nome']?>" required><br><br>
    
    <label>Descrição / Especialidade:</label><br>
    <textarea name="descricao" rows="4" cols="50" required><?=$barbeiro['descricao']?></textarea><br><br>
    
    <input type="submit" value="Salvar Alterações"><br><br>
    <a href="?query=admin/barbeiro/listar-barbeiro">Cancelar</a> | 
    <a href="?query=admin/barbeiro/painel-admin-barbeiro">Voltar ao Painel</a>
</form>

<?php
    } else {
        echo "<h2>Barbeiro não encontrado!</h2>";
        echo "<a href='?query=admin/barbeiro/listar-barbeiro'>Voltar para lista</a>";
    }
?>

