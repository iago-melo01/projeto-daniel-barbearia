<?php
    require_once("admin/conectaMYSQL.php");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nós - Barbearia</title>

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
            transition: 0.3s;
        }

        .nav-links a:hover {
            color: #d4af37;
        }

        .hero {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: #fff;
            padding: 70px 20px;
            text-align: center;
        }

        .hero h1 {
            font-size: 48px;
            color: #d4af37;
            margin-bottom: 15px;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 50px 20px;
        }

        .section-title {
            text-align: center;
            font-size: 36px;
            color: #1a1a2e;
            margin-bottom: 40px;
        }

        .sobre-texto {
            font-size: 19px;
            line-height: 1.8;
            color: #444;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        footer {
            background: #1a1a2e;
            color: #fff;
            text-align: center;
            padding: 30px 20px;
            margin-top: 60px;
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

    </style>
</head>
<body>

<?php include_once 'topo.php' ?>

<section class="hero">
    <h1>Nossa Barbearia</h1>
    <p>Tradição, estilo e excelência em cada detalhe</p>
</section>

<div class="container">
    <h2 class="section-title">Quem Somos</h2>

    <div class="sobre-texto">
        <p>
            A <strong>Barbearia Clássica</strong> nasceu com um propósito simples: oferecer muito mais do que um corte de cabelo. 
            Criamos um espaço onde tradição e modernidade se unem para proporcionar uma experiência única, confortável e inesquecível.
        </p>

        <p>
            Cada cliente é atendido com atenção, respeito e profissionalismo. Valorizamos o estilo individual de cada pessoa, e 
            buscamos sempre entregar o melhor resultado — seja em cortes clássicos, modernos, barba, cuidados especiais ou tratamentos capilares.
        </p>

        <p>
            Com profissionais experientes, ambiente acolhedor e produtos de alta qualidade, nossa missão é garantir que você 
            saia renovado, confiante e com a autoestima lá em cima.
        </p>

        <p><strong>Mais do que uma barbearia, somos um estilo de vida.</strong></p>
    </div>
</div>

<footer>
    <p>&copy; 2025 Barbearia. Todos os direitos reservados.</p>
</footer>

</body>
</html>
