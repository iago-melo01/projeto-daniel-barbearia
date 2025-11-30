<?php
    require_once("admin/conectaMYSQL.php");

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $email_user = $_POST['email'];
        $senha_user = $_POST['senha'];

        $sql_barbeiro = "SELECT * FROM barbeiros WHERE email = '$email_user' AND senha = '$senha_user'";
        $resultado = mysqli_query($connect,$sql_barbeiro);

        if (mysqli_num_rows($resultado) > 0){
            $obj = mysqli_fetch_array($resultado);
            ?>
            <header> Bem vindo <?= $obj['nome'] ?> </header>
            <a href="?query=admin/admin">Painel Administrador</a>
        <?php    
        }
        else{
            $sql_cliente = "SELECT * FROM usuarios WHERE email = '$email_user' AND senha = '$senha_user' ";
            $resultado = mysqli_query($connect,$sql_cliente);

            if(mysqli_num_rows($resultado) > 0){
                $obj = mysqli_fetch_array($resultado);
                ?>
                <header> Bem vindo <?= $obj['cliente']?> </header>
                <a href="?query=admin/cliente/painel-admin-cliente">Painel Cliente</a>
                <?php
            }
            else{
                echo "<h2> Senha ou E-mail incorretos </h2>";
                include("login.php");
            }
        }
    }
    else{
        include("login.php");
    }
?>