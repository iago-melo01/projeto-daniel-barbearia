<?php
    require_once("admin/conectaMYSQL.php");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Área do Barbeiro</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-container {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            padding: 40px;
            width: 100%;
            max-width: 450px;
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h1 {
            color: #1a1a2e;
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .login-header .subtitle {
            color: #666;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .barbeiro-badge {
            display: inline-block;
            background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%);
            color: #1a1a2e;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-top: 10px;
            letter-spacing: 0.5px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            color: #333;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f9f9f9;
        }

        .form-group input:focus {
            outline: none;
            border-color: #d4af37;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
        }

        .form-group input::placeholder {
            color: #999;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(26, 26, 46, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .divider {
            text-align: center;
            margin: 25px 0;
            color: #999;
            font-size: 12px;
            position: relative;
        }

        .divider::before,
        .divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 40%;
            height: 1px;
            background: #e0e0e0;
        }

        .divider::before {
            left: 0;
        }

        .divider::after {
            right: 0;
        }

        .info-box {
            background: #f8f9fa;
            border-left: 4px solid #d4af37;
            padding: 12px 15px;
            border-radius: 5px;
            margin-top: 20px;
            font-size: 13px;
            color: #555;
        }

        .info-box strong {
            color: #1a1a2e;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #1a1a2e;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .back-link a:hover {
            color: #d4af37;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 30px 20px;
            }

            .login-header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>✂️ Área do Barbeiro</h1>
            <p class="subtitle">Acesso Restrito</p>
            <span class="barbeiro-badge">BARBEIRO</span>
        </div>

        <form action="?query=admin/admin" method="POST">
            <div class="form-group">
                <label for="email">E-mail Profissional</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="seu.email@barbearia.com" 
                    required
                    autocomplete="email"
                >
            </div>

            <div class="form-group">
                <label for="senha">Senha</label>
                <input 
                    type="password" 
                    id="senha" 
                    name="senha" 
                    placeholder="Digite sua senha" 
                    required
                    autocomplete="current-password"
                >
            </div>

            <button type="submit" class="btn-login">
                Entrar no Painel
            </button>
        </form>

        <div class="divider">ou</div>

        <div class="info-box">
            <strong>💡 Dica:</strong> Use seu e-mail cadastrado no sistema para acessar o painel administrativo.
        </div>

        <div class="back-link">
            <a href="?query=home">← Voltar para página inicial</a>
        </div>
    </div>
</body>
</html>
