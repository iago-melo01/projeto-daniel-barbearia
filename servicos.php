<?php
    require_once("admin/conectaMYSQL.php");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviços - Barbearia</title>
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 60px 20px;
        }

        .section-title {
            text-align: center;
            font-size: 36px;
            margin-bottom: 50px;
            color: #1a1a2e;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .service-card {
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .service-card h3 {
            color: #1a1a2e;
            margin-bottom: 15px;
            font-size: 24px;
        }

        .service-card p {
            color: #666;
            margin-bottom: 20px;
            line-height: 1.8;
        }

        .service-price {
            font-size: 28px;
            font-weight: 700;
            color: #d4af37;
            margin-bottom: 20px;
        }

        .btn-agendar {
            display: block;
            text-align: center;
            background: #1a1a2e;
            color: #fff;
            padding: 14px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-agendar:hover {
            background: #16213e;
        }

        footer {
            background: #1a1a2e;
            color: #fff;
            text-align: center;
            padding: 30px 20px;
            margin-top: 60px;
        }

        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                gap: 15px;
            }

            .nav-links {
                flex-direction: column;
                gap: 15px;
            }

            .services-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">✂️ Barbearia</div>
            <nav class="nav-links">
                <a href="?query=home">Início</a>
                <a href="?query=servicos">Serviços</a>
                <a href="?query=agendar">Agendar</a>
                <a href="?query=login-barbeiro" class="btn-login">Área do Barbeiro</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <h2 class="section-title">Todos os Nossos Serviços</h2>
        <div class="services-grid">
            <?php
                $sql = "SELECT * FROM servicos";
                $resultado = mysqli_query($connect, $sql);

                if(mysqli_num_rows($resultado) > 0) {
                    while($servico = mysqli_fetch_array($resultado)) {
                        echo '<div class="service-card">';
                        echo '<h3>' . ($servico['servico']) . '</h3>';
                        echo '<p>' . ($servico['descricao']) . '</p>';
                        echo '<div class="service-price">R$ ' . number_format($servico['preco'], 2, ',', '.') . '</div>';
                        echo '<a href="?query=agendar" class="btn-agendar">Agendar Este Serviço</a>';
                        echo '</div>';
                    }
                } else {
                    echo '<p style="grid-column: 1/-1; text-align: center; color: #666; padding: 40px;">Nenhum serviço disponível no momento.</p>';
                }
            ?>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Barbearia. Todos os direitos reservados.</p>
    </footer>
</body>
</html>

