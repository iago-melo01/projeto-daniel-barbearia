<?php 
    require_once("conectaMYSQL.php");
    
    // Verifica se foi enviado via POST
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $sql = "SELECT * FROM barbeiros WHERE email = '$email' AND senha = '$senha'";
        $resultado = mysqli_query($connect, $sql);

        if(mysqli_num_rows($resultado) > 0){
            $barbeiro = mysqli_fetch_array($resultado);
            ?>
            <!DOCTYPE html>
            <html lang="pt-BR">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Painel Administrador</title>
            </head>
            <body>
                <header>
                    <h2>Painel Administrador da Barbearia</h2>
                    <p>Bem-vindo, <strong><?= htmlspecialchars($barbeiro['nome']) ?></strong>!</p>
                    <hr>
                    <a href="?query=admin/servicos/painel-admin-servicos">Gerenciamento de Serviços</a><br><br>
                    <a href="?query=admin/barbeiro/painel-admin-barbeiro">Gerenciamento de Barbeiros</a><br><br>
                    <a href="?query=admin/cliente/painel-admin-cliente">Gerenciamento de Clientes</a><br><br>
                    <a href="?query=admin/agendamento/painel-admin-agendamento">Gerenciamento de Agendamentos</a>
                </header>
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
                <title>Acesso Negado</title>
                <style>
                    body {
                        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
                        min-height: 100vh;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        padding: 20px;
                    }
                    .error-container {
                        background: #ffffff;
                        border-radius: 15px;
                        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
                        padding: 40px;
                        text-align: center;
                        max-width: 450px;
                    }
                    .error-icon {
                        font-size: 64px;
                        margin-bottom: 20px;
                    }
                    h2 {
                        color: #d32f2f;
                        margin-bottom: 15px;
                    }
                    p {
                        color: #666;
                        margin-bottom: 25px;
                    }
                    .btn-retry {
                        display: inline-block;
                        padding: 12px 30px;
                        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
                        color: #ffffff;
                        text-decoration: none;
                        border-radius: 8px;
                        font-weight: 600;
                        transition: all 0.3s ease;
                    }
                    .btn-retry:hover {
                        transform: translateY(-2px);
                        box-shadow: 0 5px 20px rgba(26, 26, 46, 0.4);
                    }
                </style>
            </head>
            <body>
                <div class="error-container">
                    <div class="error-icon">🔒</div>
                    <h2>Acesso Negado</h2>
                    <p>E-mail ou senha incorretos. Verifique suas credenciais e tente novamente.</p>
                    <a href="?query=login-barbeiro" class="btn-retry">Tentar Novamente</a>
                </div>
            </body>
            </html>
            <?php
        }
    } else {
        ?>
        <!DOCTYPE html>
        <html lang="pt-BR">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Acesso Negado</title>
            <style>
                body {
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
                    min-height: 100vh;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    padding: 20px;
                }
                .error-container {
                    background: #ffffff;
                    border-radius: 15px;
                    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
                    padding: 40px;
                    text-align: center;
                    max-width: 450px;
                }
                .error-icon {
                    font-size: 64px;
                    margin-bottom: 20px;
                }
                h2 {
                    color: #d32f2f;
                    margin-bottom: 15px;
                }
                p {
                    color: #666;
                    margin-bottom: 25px;
                }
                .btn-retry {
                    display: inline-block;
                    padding: 12px 30px;
                    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
                    color: #ffffff;
                    text-decoration: none;
                    border-radius: 8px;
                    font-weight: 600;
                    transition: all 0.3s ease;
                }
                .btn-retry:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 5px 20px rgba(26, 26, 46, 0.4);
                }
            </style>
        </head>
        <body>
            <div class="error-container">
                <div class="error-icon">⚠️</div>
                <h2>Acesso Negado</h2>
                <p>Você precisa fazer login para acessar esta área.</p>
                <a href="?query=login-barbeiro" class="btn-retry">Ir para Login</a>
            </div>
        </body>
        </html>
        <?php
    }
?>
