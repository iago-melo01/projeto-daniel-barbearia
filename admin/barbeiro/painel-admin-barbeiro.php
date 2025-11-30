<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Barbeiros</title>
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
            margin-bottom: 30px;
            color: #d4af37;
            font-weight: 700;
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
            padding: 40px;
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

        .back-section {
            text-align: center;
            margin-top: 40px;
        }

        .btn-back {
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

        .btn-back:hover {
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
        <h2>Gerenciamento de Barbeiros</h2>
    </div>

    <div class="admin-container">
        <div class="admin-grid">
            <div class="admin-card">
                <span class="admin-card-icon">➕</span>
                <h3>Cadastrar Barbeiro</h3>
                <p>Adicione um novo barbeiro ao sistema</p>
                <a href="?query=admin/barbeiro/cadastro-barbeiro">Cadastrar</a>
            </div>

            <div class="admin-card">
                <span class="admin-card-icon">📋</span>
                <h3>Listar Barbeiros</h3>
                <p>Visualize e gerencie todos os barbeiros cadastrados</p>
                <a href="?query=admin/barbeiro/listar-barbeiro">Listar</a>
            </div>
        </div>

        <div class="back-section">
            <a href="?query=admin/admin" class="btn-back">Voltar ao Painel Principal</a>
        </div>
    </div>
</body>
</html>

