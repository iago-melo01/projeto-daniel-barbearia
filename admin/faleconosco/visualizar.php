<?php
require_once(__DIR__ . "/../conectaMYSQL.php");

$id = $_GET['id'] ?? 0;

if (!$id) {
    die("ID inválido");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $resposta = mysqli_real_escape_string($connect, $_POST['resposta']);
    $sql = "UPDATE fale_conosco 
            SET resposta = '$resposta', status='respondido', data_resposta = NOW()
            WHERE id=$id";
    mysqli_query($connect, $sql);

    echo "<script>alert('Resposta salva!');</script>";
}

mysqli_query($connect, "UPDATE fale_conosco SET status='lido' WHERE id=$id");

$sql = "SELECT * FROM fale_conosco WHERE id=$id";
$res = mysqli_query($connect, $sql);
$dados = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Mensagem</title>

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
            padding: 40px 20px;
            color: #333;
        }

        .list-header {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: #fff;
            padding: 30px 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            text-align: center;
            margin: -40px -20px 30px -20px;
        }

        .list-header h1 {
            font-size: 32px;
            color: #d4af37;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .list-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .list-actions a {
            padding: 10px 20px;
            background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%);
            color: #1a1a2e;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .info-box p {
            margin-bottom: 12px;
            font-size: 16px;
        }

        .info-box b {
            color: #1a1a2e;
        }

        textarea {
            width: 100%;
            height: 150px;
            padding: 15px;
            font-size: 15px;
            border-radius: 10px;
            border: 1px solid #ccc;
            resize: none;
            margin-top: 10px;
            outline: none;
            transition: 0.3s;
        }

        textarea:focus {
            border-color: #d4af37;
            box-shadow: 0 0 8px rgba(212,175,55,0.3);
        }

        button {
            margin-top: 15px;
            padding: 12px 25px;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: #fff;
            font-weight: 600;
            font-size: 15px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 3px 10px rgba(26,26,46,0.3);
        }
    </style>
</head>
<body>

<div class="list-header">
    <h1>Visualizar Mensagem</h1>
    <div class="list-actions">
        <a href="?query=admin/faleconosco/listar">Voltar</a>
    </div>
</div>

<div class="container">

    <div class="info-box">
        <p><b>Nome:</b> <?= htmlspecialchars($dados['nome']) ?></p>
        <p><b>Email:</b> <?= htmlspecialchars($dados['email']) ?></p>
        <p><b>Telefone:</b> <?= htmlspecialchars($dados['telefone']) ?></p>
        <p><b>Assunto:</b> <?= htmlspecialchars($dados['assunto']) ?></p>
        <p><b>Mensagem:</b><br> <?= nl2br(htmlspecialchars($dados['mensagem'])) ?></p>
    </div>

    <hr style="margin: 25px 0;">
    
    <!-- De forma ilustrativa, esta seção seria responsável por enviar a resposta diretamente ao e-mail do cliente -->
    <form method="POST">
        <label><b>Responder:</b></label>
        <textarea name="resposta" required><?= htmlspecialchars($dados['resposta']) ?></textarea>
        <button type="submit">Enviar Resposta</button>
    </form>

</div>
</body>
</html>
