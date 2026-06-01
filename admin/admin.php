<?php
    session_start();
    require_once __DIR__ . '/conectaMYSQL.php';
    require_once dirname(__DIR__) . '/includes/admin/bootstrap.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';
        $sql = "SELECT * FROM barbeiros WHERE email = '$email' AND senha = '$senha'";
        $resultado = mysqli_query($connect, $sql);

        if (mysqli_num_rows($resultado) > 0) {
            $barbeiro = mysqli_fetch_array($resultado);
            $_SESSION['admin_logado'] = true;
            $_SESSION['admin_id'] = $barbeiro['id'];
            $_SESSION['admin_nome'] = $barbeiro['nome'];
            $_SESSION['admin_email'] = $barbeiro['email'];
            header('Location: ?query=admin/admin');
            exit;
        }

        adminAcessoNegado(
            'E-mail ou senha incorretos. Verifique suas credenciais e tente novamente.',
            '?query=login-barbeiro',
            'Tentar novamente'
        );
    }

    if (!isset($_SESSION['admin_logado']) || $_SESSION['admin_logado'] !== true) {
        adminAcessoNegado('Você precisa fazer login para acessar esta área.');
    }

    $nomeBarbeiro = $_SESSION['admin_nome'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php adminHead('Painel administrador'); ?>
</head>
<body class="admin-body">
    <?php
        adminTopBar('Painel administrador', [
            ['url' => '?query=home', 'label' => 'Ver site', 'class' => 'admin-btn-secondary'],
            ['url' => '?query=admin/logout', 'label' => 'Sair', 'class' => 'admin-btn-outline'],
        ], 'Bem-vindo, ' . $nomeBarbeiro);
    ?>
    <?php adminPageOpen(); ?>
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
        </div>
    <?php adminPageClose(); ?>
</body>
</html>
