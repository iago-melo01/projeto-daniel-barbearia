<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
    
    $id = $_GET['id'];
    $sql = "SELECT * FROM barbeiros WHERE id = '$id'";
    $resultado = mysqli_query($connect, $sql);
    
    if(mysqli_num_rows($resultado) > 0) {
        $barbeiro = mysqli_fetch_array($resultado);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Barbeiro</title>
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

        .form-header {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: #fff;
            padding: 30px 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            text-align: center;
            margin: -40px -20px 40px -20px;
        }

        .form-header h2 {
            font-size: 32px;
            color: #d4af37;
            font-weight: 700;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #1a1a2e;
            font-weight: 600;
            font-size: 14px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            transition: all 0.3s ease;
            background: #fff;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #d4af37;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .btn-submit {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #16213e 0%, #1a1a2e 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(26, 26, 46, 0.3);
        }

        .form-actions {
            margin-top: 30px;
            padding-top: 25px;
            border-top: 2px solid #e0e0e0;
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .form-actions a {
            padding: 10px 20px;
            background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%);
            color: #1a1a2e;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .form-actions a:hover {
            background: linear-gradient(135deg, #f4d03f 0%, #d4af37 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 25px;
            }

            .form-header h2 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="form-header">
        <h2>Editar Barbeiro</h2>
    </div>

    <div class="form-container">
        <form action="?query=admin/barbeiro/barbeiro-alterar" method="post">
            <input type="hidden" name="id" value="<?=$barbeiro['id']?>">
            
            <div class="form-group">
                <label for="nome">Nome do Barbeiro:</label>
                <input type="text" name="nome" id="nome" value="<?=($barbeiro['nome'])?>" required>
            </div>

            <div class="form-group">
                <label for="email_id">E-mail do Barbeiro:</label>
                <input type="email" name="email" id="email_id" value="<?=($barbeiro['email'])?>" required>
            </div>

            <div class="form-group">
                <label for="senha_id">Senha:</label>
                <input type="text" name="senha" id="senha_id" value="<?=($barbeiro['senha'])?>" required>
            </div>
            
            <div class="form-group">
                <label for="descricao">Descrição / Especialidade:</label>
                <textarea name="descricao" id="descricao" rows="4" required><?=($barbeiro['descricao'])?></textarea>
            </div>
            
            <button type="submit" class="btn-submit">Salvar Alterações</button>
        </form>

        <div class="form-actions">
            <a href="?query=admin/barbeiro/listar-barbeiro">Cancelar</a>
            <a href="?query=admin/barbeiro/painel-admin-barbeiro">Voltar ao Painel</a>
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
    <title>Barbeiro não encontrado</title>
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

        .error-container {
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 500px;
        }

        .error-container h2 {
            color: #d32f2f;
            margin-bottom: 20px;
        }

        .error-container a {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 30px;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .error-container a:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(26, 26, 46, 0.3);
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h2>Barbeiro não encontrado!</h2>
        <a href="?query=admin/barbeiro/listar-barbeiro">Voltar para lista</a>
    </div>
</body>
</html>
<?php
    }
?>

