<?php 
    session_start();
    require_once("conectaMYSQL.php");
     
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $sql = "SELECT * FROM barbeiros WHERE email = '$email' AND senha = '$senha'";
        $resultado = mysqli_query($connect, $sql);

        if(mysqli_num_rows($resultado) > 0){
            $barbeiro = mysqli_fetch_array($resultado);
            
            $_SESSION['admin_logado'] = true;
            $_SESSION['admin_id'] = $barbeiro['id'];
            $_SESSION['admin_nome'] = $barbeiro['nome'];
            $_SESSION['admin_email'] = $barbeiro['email'];
            
            header("Location: ?query=admin/admin");
            exit;
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
    } 

    elseif(isset($_SESSION['admin_logado']) && $_SESSION['admin_logado'] === true) {

        $barbeiro = [
            'id' => $_SESSION['admin_id'],
            'nome' => $_SESSION['admin_nome'],
            'email' => $_SESSION['admin_email']
        ];
        ?>
        <!DOCTYPE html>
        <html lang="pt-BR">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Painel Administrador</title>
            <style>
                * {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                }

                body {
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                    background: linear-gradient(135deg, #f5f5f5 0%, #e8e8e8 100%);
                    min-height: 100vh;
                    color: #333;
                }

                .admin-header {
                    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
                    color: #fff;
                    padding: 40px 20px;
                    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
                    text-align: center;
                }

                .admin-header h2 {
                    font-size: 36px;
                    margin-bottom: 15px;
                    color: #d4af37;
                    font-weight: 700;
                }

                .admin-header p {
                    font-size: 18px;
                    opacity: 0.9;
                }

                .admin-header .welcome-name {
                    color: #d4af37;
                    font-weight: 600;
                }

                .admin-container {
                    max-width: 1200px;
                    margin: 60px auto;
                    padding: 0 20px;
                }

                .admin-grid {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                    gap: 30px;
                    margin-bottom: 40px;
                }

                .admin-card {
                    background: #fff;
                    border-radius: 15px;
                    padding: 35px;
                    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
                    transition: all 0.3s ease;
                    text-align: center;
                    position: relative;
                    overflow: hidden;
                }

                .admin-card::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    height: 5px;
                    background: linear-gradient(90deg, #1a1a2e 0%, #16213e 50%, #d4af37 100%);
                }

                .admin-card:hover {
                    transform: translateY(-8px);
                    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
                }

                .admin-card-icon {
                    font-size: 48px;
                    margin-bottom: 20px;
                    display: block;
                }

                .admin-card h3 {
                    color: #1a1a2e;
                    font-size: 24px;
                    margin-bottom: 15px;
                    font-weight: 700;
                }

                .admin-card p {
                    color: #666;
                    margin-bottom: 25px;
                    line-height: 1.6;
                    font-size: 14px;
                }

                .admin-card a {
                    display: inline-block;
                    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
                    color: #fff;
                    padding: 12px 30px;
                    border-radius: 8px;
                    text-decoration: none;
                    font-weight: 600;
                    transition: all 0.3s ease;
                    font-size: 16px;
                }

                .admin-card a:hover {
                    background: linear-gradient(135deg, #16213e 0%, #1a1a2e 100%);
                    transform: translateY(-2px);
                    box-shadow: 0 5px 15px rgba(26, 26, 46, 0.3);
                }

                .logout-section {
                    text-align: center;
                    margin-top: 50px;
                    padding-top: 30px;
                    border-top: 2px solid #e0e0e0;
                }

                .btn-logout {
                    display: inline-block;
                    background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%);
                    color: #1a1a2e;
                    padding: 12px 35px;
                    border-radius: 8px;
                    text-decoration: none;
                    font-weight: 600;
                    transition: all 0.3s ease;
                    font-size: 16px;
                }

                .btn-logout:hover {
                    background: linear-gradient(135deg, #f4d03f 0%, #d4af37 100%);
                    transform: translateY(-2px);
                    box-shadow: 0 5px 20px rgba(212, 175, 55, 0.4);
                }

                @media (max-width: 768px) {
                    .admin-header h2 {
                        font-size: 28px;
                    }

                    .admin-grid {
                        grid-template-columns: 1fr;
                    }

                    .admin-container {
                        margin: 30px auto;
                    }
                }
            </style>
        </head>
        <body>
            <div class="admin-header">
                <h2>Painel Administrador</h2>
                <p>Bem-vindo, <span class="welcome-name"><?= htmlspecialchars($barbeiro['nome']) ?></span>!</p>
            </div>

            <div class="admin-container">
                <div class="admin-grid">
                    <div class="admin-card">
                        <span class="admin-card-icon">✂️</span>
                        <h3>Serviços</h3>
                        <p>Gerencie os serviços oferecidos pela barbearia</p>
                        <a href="?query=admin/servicos/painel-admin-servicos">Gerenciar Serviços</a>
                    </div>

                    <div class="admin-card">
                        <span class="admin-card-icon">👨‍💼</span>
                        <h3>Barbeiros</h3>
                        <p>Administre o cadastro de barbeiros</p>
                        <a href="?query=admin/barbeiro/painel-admin-barbeiro">Gerenciar Barbeiros</a>
                    </div>

                    <div class="admin-card">
                        <span class="admin-card-icon">👥</span>
                        <h3>Clientes</h3>
                        <p>Visualize e gerencie os clientes cadastrados</p>
                        <a href="?query=admin/cliente/painel-admin-cliente">Gerenciar Clientes</a>
                    </div>

                    <div class="admin-card">
                        <span class="admin-card-icon">📅</span>
                        <h3>Agendamentos</h3>
                        <p>Controle todos os agendamentos realizados</p>
                        <a href="?query=admin/agendamento/painel-admin-agendamento">Gerenciar Agendamentos</a>
                    </div>
                    <div class="admin-card">
                        <span class="admin-card-icon">💬</span>
                        <h3>Fale Conosco</h3>
                        <p>Gerencie todas as mensagens recebidas</p>
                        <a href="?query=admin/faleconosco/painel-admin-faleconosco">Gerenciar Mensagens</a>
                    </div>
                </div>

                <div class="logout-section">
                    <a href="?query=admin/logout" class="btn-logout">Sair do Painel</a>
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
