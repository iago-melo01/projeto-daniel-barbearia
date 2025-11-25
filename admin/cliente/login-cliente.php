<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
?>

<h2>Login de Cliente</h2>
<form action="?query=admin/cliente/login-cliente" method="post">
    <label>E-mail:</label><br>
    <input type="email" name="email" required><br><br>
    
    <label>Senha:</label><br>
    <input type="password" name="senha" required><br><br>
    
    <input type="submit" value="Entrar"><br><br>
    <a href="?query=admin/cliente/cadastro-cliente">Não tem conta? Cadastre-se</a> | 
    <a href="?query=admin/cliente/painel-admin-cliente">Voltar ao Painel</a>
</form>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
        $resultado = mysqli_query($connect, $sql);
        
        if(mysqli_num_rows($resultado) > 0) {
            $usuario = mysqli_fetch_array($resultado);
            echo "<h2>Bem-vindo, " . $usuario['cliente'] . "!</h2>";
            echo "<p>Login realizado com sucesso.</p>";
        } else {
            echo "<h2>E-mail ou senha incorretos!</h2>";
        }
    }
?>

