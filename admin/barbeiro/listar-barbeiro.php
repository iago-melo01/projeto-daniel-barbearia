<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barbeiros Cadastrados</title>
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

        .list-actions a:hover {
            background: linear-gradient(135deg, #f4d03f 0%, #d4af37 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
        }

        .table-container {
            max-width: 1200px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: #fff;
        }

        thead th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
        }

        tbody tr {
            border-bottom: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        tbody tr:hover {
            background: #f8f8f8;
        }

        tbody td {
            padding: 15px;
            font-size: 14px;
            color: #333;
        }

        .actions-cell {
            display: flex;
            gap: 10px;
        }

        .btn-edit, .btn-delete {
            padding: 6px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-edit {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: #fff;
        }

        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 3px 10px rgba(26, 26, 46, 0.3);
        }

        .btn-delete {
            background: linear-gradient(135deg, #d32f2f 0%, #f44336 100%);
            color: #fff;
        }

        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 3px 10px rgba(211, 47, 47, 0.3);
        }

        .empty-message {
            text-align: center;
            padding: 40px;
            color: #666;
            font-size: 16px;
        }

        @media (max-width: 768px) {
            .table-container {
                padding: 15px;
            }

            table {
                font-size: 12px;
            }

            thead th, tbody td {
                padding: 10px 5px;
            }

            .list-header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="list-header">
        <h1>Barbeiros Cadastrados</h1>
        <div class="list-actions">
            <a href="?query=admin/barbeiro/cadastro-barbeiro">Cadastrar Novo Barbeiro</a>
            <a href="?query=admin/barbeiro/painel-admin-barbeiro">Voltar ao Painel</a>
        </div>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
        <?php
            $sql = "SELECT * FROM barbeiros";
            $resultado = mysqli_query($connect, $sql);

            if(mysqli_num_rows($resultado) > 0) {
                while($dados = mysqli_fetch_array($resultado)) {
                    echo "<tr>";
                    echo "<td>" . $dados['id'] . "</td>";
                    echo "<td>" . htmlspecialchars($dados['nome']) . "</td>";
                    echo "<td>" . htmlspecialchars($dados['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($dados['descricao']) . "</td>";
                    echo "<td class='actions-cell'>";
                    echo "<a href='?query=admin/barbeiro/barbeiro-form-editar&id=" . $dados['id'] . "' class='btn-edit'>Editar</a>";
                    echo "<a href='?query=admin/barbeiro/barbeiro-excluir&id=" . $dados['id'] . "' class='btn-delete'>Excluir</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='empty-message'>Nenhum barbeiro cadastrado.</td></tr>";
            }
        ?>
            </tbody>
        </table>
    </div>
</body>
</html>

