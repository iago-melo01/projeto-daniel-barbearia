<?php
    require_once(__DIR__ . "/../conectaMYSQL.php");
    
    // Buscar barbeiros para o select
    $sqlBarbeiros = "SELECT * FROM barbeiros";
    $barbeiros = mysqli_query($connect, $sqlBarbeiros);
    
    // Buscar servicos para o select
    $sqlServicos = "SELECT * FROM servicos";
    $servicos = mysqli_query($connect, $sqlServicos);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Agendamento</title>
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
        .form-group select {
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
        .form-group select:focus {
            outline: none;
            border-color: #d4af37;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
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
        <h2>Novo Agendamento</h2>
    </div>

    <div class="form-container">
        <form action="?query=admin/agendamento/agendamento-inserir" method="post">
            <div class="form-group">
                <label for="barbeiro">Barbeiro:</label>
                <select name="barbeiro" id="barbeiro" required>
                    <option value="">Selecione um barbeiro</option>
                    <?php
                        if(mysqli_num_rows($barbeiros) > 0) {
                            while($barbeiro = mysqli_fetch_array($barbeiros)) {
                                echo "<option value='" . $barbeiro['id'] . "'>" . $barbeiro['nome'] . "</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="servico">Serviço:</label>
                <select name="servico" id="servico" required>
                    <option value="">Selecione um serviço</option>
                    <?php
                        if(mysqli_num_rows($servicos) > 0) {
                            while($servico = mysqli_fetch_array($servicos)) {
                                echo "<option value='" . $servico['servico'] . "'>" . $servico['servico'] . " - R$ " . number_format($servico['preco'], 2, ',', '.') . "</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="horario">Data e Horário:</label>
                <input type="datetime-local" name="horario" id="horario" required>
            </div>
            
            <button type="submit" class="btn-submit">Marcar Agendamento</button>
        </form>

        <div class="form-actions">
            <a href="?query=admin/agendamento/listar-agendamento">Ver Agendamentos</a>
            <a href="?query=admin/agendamento/painel-admin-agendamento">Voltar ao Painel</a>
        </div>
    </div>
</body>
</html>
