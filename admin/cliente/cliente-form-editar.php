<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
    
    $id = $_GET['id'];
    $sql = "SELECT * FROM usuarios WHERE id = '$id'";
    $resultado = mysqli_query($connect, $sql);
    
    if(mysqli_num_rows($resultado) > 0) {
        $cliente = mysqli_fetch_array($resultado);
?>

<h2>Editar Cliente</h2>
<form action="?query=admin/cliente/cliente-alterar" method="post">
    <input type="hidden" name="id" value="<?=$cliente['id']?>">
    
    <label>Nome de Usuário:</label><br>
    <input type="text" name="user" value="<?=$cliente['user']?>" required><br><br>
    
    <label>Nome Completo:</label><br>
    <input type="text" name="cliente" value="<?=$cliente['cliente']?>" required><br><br>
    
    <label>E-mail:</label><br>
    <input type="email" name="email" value="<?=$cliente['email']?>" required><br><br>
    
    <label>Nova Senha (deixe em branco para manter a atual):</label><br>
    <input type="password" name="senha"><br><br>
    
    <label>Idade:</label><br>
    <input type="number" name="idade" value="<?=$cliente['idade']?>" required><br><br>
    
    <label>Telefone:</label><br>
    <input type="text" name="telefone" value="<?=$cliente['telefone']?>" required><br><br>
    
    <input type="submit" value="Salvar Alterações"><br><br>
    <a href="?query=admin/cliente/listar-cadastros">Cancelar</a> | 
    <a href="?query=admin/cliente/painel-admin-cliente">Voltar ao Painel</a>
</form>

<?php
    } else {
        echo "<h2>Cliente não encontrado!</h2>";
        echo "<a href='?query=admin/cliente/listar-cadastros'>Voltar para lista</a>";
    }
?>

