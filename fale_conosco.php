<?php
require_once("admin/conectaMYSQL.php");

$mensagem_envio = '';
$tipoMensagem_envio = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $assunto = $_POST['assunto'];
    $mensagem = $_POST['mensagem'];

    $sql = "INSERT INTO fale_conosco (nome, email, telefone, assunto, mensagem) 
            VALUES ('$nome','$email','$telefone','$assunto','$mensagem')";

    $resultado = mysqli_query($connect, $sql);

    if($resultado) {
        $mensagem_envio = 'Mensagem enviada com sucesso!';
        $tipoMensagem_envio = 'success';
    } else {
        $mensagem_envio = 'Erro ao enviar mensagem. Tente novamente.';
        $tipoMensagem_envio = 'error';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Mensagem - Barbearia</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            color: #333;
        }

        header {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: #fff;
            padding: 20px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 28px;
            font-weight: 700;
            color: #d4af37;
        }

        .nav-links {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: #d4af37;
        }

        .btn-login {
            background: #d4af37;
            color: #1a1a2e;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: #f4d03f;
            transform: translateY(-2px);
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .form-container {
            background: #fff;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .form-title {
            font-size: 32px;
            color: #1a1a2e;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            color: #333;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 15px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 14px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f9f9f9;
            font-family: inherit;
        }

        .form-group textarea {
            height: 150px;
            resize: none;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #d4af37;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
        }

        .btn-submit {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(26, 26, 46, 0.4);
        }

        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            font-weight: 500;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        footer {
            background: #1a1a2e;
            color: #fff;
            text-align: center;
            padding: 30px 20px;
            margin-top: 60px;
        }
    </style>

</head>
<body>

<?php include_once 'topo.php'; ?>

<div class="container">
    <div class="form-container">

        <h2 class="form-title">Enviar Mensagem</h2>

        <?php if($mensagem_envio): ?>
            <div class="alert alert-<?= $tipoMensagem_envio ?>">
                <?= $mensagem_envio ?>
            </div>
        <?php endif; ?>

        <form method="POST">

            <div class="form-group">
                <label for="nome">Seu Nome Completo</label>
                <input type="text" id="nome" name="nome" required placeholder="Digite seu nome">
            </div>

            <div class="form-group">
                <label for="email">Seu E-mail</label>
                <input type="email" id="email" name="email" required placeholder="seu.email@exemplo.com">
            </div>

            <div class="form-group">
                <label for="telefone">Seu Telefone</label>
                <input type="text" id="telefone" name="telefone" required placeholder="83 99999-9999" maxlength="11" >
            </div>

            <div class="form-group">
                <label for="assunto">Assunto</label>
                <textarea id="assunto" name="assunto" required placeholder="Assunto"></textarea>
            </div>

            <div class="form-group">
                <label for="mensagem">Mensagem</label>
                <textarea id="mensagem" name="mensagem" required placeholder="Mensagem"></textarea>
            </div>

            <button type="submit" class="btn-submit">Enviar Mensagem</button>

        </form>
    </div>
</div>

<footer>
    <p>&copy; 2025 Barbearia. Todos os direitos reservados.</p>
</footer>
