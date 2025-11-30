<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
    
    $id = $_GET['id'];

    $sql = "DELETE FROM barbeiros WHERE id = $id";

    $resultado = mysqli_query($connect, $sql);
    
    if($resultado) {
        $message = "Barbeiro excluído com sucesso!";
        $type = "success";
        $links = [
            ['url' => '?query=admin/barbeiro/listar-barbeiro', 'text' => 'Voltar para lista'],
            ['url' => '?query=admin/barbeiro/painel-admin-barbeiro', 'text' => 'Voltar ao Painel']
        ];
    } else {
        $message = "Erro ao excluir barbeiro!";
        $type = "error";
        $links = [
            ['url' => '?query=admin/barbeiro/listar-barbeiro', 'text' => 'Voltar']
        ];
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $type == 'success' ? 'Sucesso' : 'Erro' ?></title>
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
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .message-container {
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 500px;
            width: 100%;
        }

        .message-icon {
            font-size: 64px;
            margin-bottom: 20px;
        }

        .message-container.success .message-icon {
            color: #4caf50;
        }

        .message-container.error .message-icon {
            color: #d32f2f;
        }

        .message-container h2 {
            margin-bottom: 25px;
            font-size: 24px;
        }

        .message-container.success h2 {
            color: #4caf50;
        }

        .message-container.error h2 {
            color: #d32f2f;
        }

        .message-links {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 30px;
        }

        .message-links a {
            padding: 12px 25px;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .message-links a:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(26, 26, 46, 0.3);
        }
    </style>
</head>
<body>
    <div class="message-container <?= $type ?>">
        <div class="message-icon"><?= $type == 'success' ? '✅' : '❌' ?></div>
        <h2><?= ($message) ?></h2>
        <div class="message-links">
            <?php foreach($links as $link): ?>
                <a href="<?= $link['url'] ?>"><?= ($link['text']) ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>

