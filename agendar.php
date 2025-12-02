<?php
    require_once("admin/conectaMYSQL.php");
    
    $mensagem_agendamento = '';
    $tipoMensagem_agendamento = '';
    $mensagem_cliente = '';
    $tipoMensagem_cliente = '';
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome_cliente = $_POST['nome_cliente'];
        $email_cliente = $_POST['email_cliente'];
        $telefone_cliente = $_POST['telefone_cliente'];
        $barbeiro = $_POST['barbeiro'];
        $servico = $_POST['servico'];
        $horario = $_POST['horario'];
        
        // Cadastro de um Agendamento
        $sql_agendamento = "INSERT INTO agendamento (nome_cliente, email_cliente, telefone_cliente, barbeiro, servico, horario) 
                VALUES ('$nome_cliente', '$email_cliente','$telefone_cliente','$barbeiro', '$servico', '$horario')";
        
        $resultado = mysqli_query($connect, $sql_agendamento);
        
        if($resultado) { // se o mysqli_query retornar true executa o codigo abaixo
            $mensagem_agendamento = 'Agendamento realizado com sucesso!';
            $tipoMensagem_agendamento = 'success';
        } else { // se retornar falso retorna isso aq
            $mensagem_agendamento = 'Erro ao realizar agendamento. Tente novamente.';
            $tipoMensagem_agendamento = 'error';
        }

        // Cadastro de cliente se não houver cadastro
        $sql_cliente = "SELECT * FROM usuarios WHERE email = '$email_cliente'";

        // Busca se existe clientes com o email igual ao $email_cliente e retorna os resultados encontrados
        $pesquisa_cliente = mysqli_query($connect,$sql_cliente);
        if (mysqli_num_rows($pesquisa_cliente) == 0){// Se a pesquisa retornar 0 linhas o cliente será cadastrado com as informações fornecidas

            $sql_clientenovo = "INSERT INTO usuarios (cliente, email, telefone) 
                                VALUES ('$nome_cliente','$email_cliente','$telefone_cliente')"; 
        
            $resultado_cliente = mysqli_query($connect,$sql_clientenovo);
            
            //Se não retornar um erro o cliente vai ser cadastrado e irá salvar uma mensagem_cliente com tipo_cliente sucess ou tipo_cliente error se a query retornar erro
            if (isset($resultado_cliente)){
                $mensagem_cliente = 'Cliente Cadastrado com sucesso';
                $tipoMensagem_cliente = 'sucess';
            }
            else{
                $mensagem_cliente = 'Não foi possível cadastrar o cliente.';
                $tipoMensagem_cliente = 'error';
            }
        }

    }
    
    // buscar barbeiros para o form
    $sqlBarbeiros = "SELECT * FROM barbeiros";
    $barbeiros = mysqli_query($connect, $sqlBarbeiros);
    
    // buscar servicos para o form
    $sqlServicos = "SELECT * FROM servicos";
    $servicos = mysqli_query($connect, $sqlServicos);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar - Barbearia</title>
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
        .form-group select {
            width: 100%;
            padding: 14px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f9f9f9;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group select:focus {
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

        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                gap: 15px;
            }

            .nav-links {
                flex-direction: column;
                gap: 15px;
            }

            .form-container {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <?php include_once 'topo.php'?>
    <div class="container">
        <div class="form-container">
            <h2 class="form-title">Agendar Horário</h2>
            
            <?php if($mensagem_agendamento){
                ?>
                <div class="alert alert-<?= $tipoMensagem ?>">
                    <?= ($mensagem_agendamento) ?>
                </div>
                <?php
            }else if($mensagem_cliente){
                ?>
                <div class="alert alert-<?= $tipoMensagem_cliente ?>">
                    <?= ($mensagem_cliente) ?>
                </div>
                <?php
            }
            ?>
            
            <form method="POST" action="?query=agendar">
                <div class="form-group">
                    <label for="nome_cliente">Seu Nome Completo</label>
                    <input type="text" id="nome_cliente" name="nome_cliente" required placeholder="Digite seu nome">
                </div>
                
                <div class="form-group">
                    <label for="email_cliente">Seu E-mail</label>
                    <input type="email" id="email_cliente" name="email_cliente" required placeholder="seu.email@exemplo.com">
                </div>

                <div class="form-group">
                    <label for="telefone_cliente">Seu Telefone</label>
                    <input type="text" id="telefone_cliente" name="telefone_cliente" required placeholder="83 99999-9999" maxlength="11">
                </div>
                
                <div class="form-group">
                    <label for="barbeiro">Escolha o Barbeiro</label>
                    <select id="barbeiro" name="barbeiro" required> 
                        <option value="">Selecione um barbeiro</option>
                        <?php
                            if(mysqli_num_rows($barbeiros) > 0) {
                                while($barbeiro = mysqli_fetch_array($barbeiros)) {
                                    echo "<option value='" . $barbeiro['id'] . "'>" . ($barbeiro['nome']) . "</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="servico">Escolha o Serviço</label>
                    <select id="servico" name="servico" required>
                        <option value="">Selecione um serviço</option>
                        <?php
                            if(mysqli_num_rows($servicos) > 0) {
                                while($servico = mysqli_fetch_array($servicos)) {
                                    echo "<option value='" . ($servico['servico']) . "'>" . 
                                         ($servico['servico']) . " - R$ " . 
                                         number_format($servico['preco'], 2, ',', '.') . "</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="horario">Data e Horário</label>
                    <input type="datetime-local" id="horario" name="horario" required>
                </div>
                
                <button type="submit" class="btn-submit">Confirmar Agendamento</button>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Barbearia. Todos os direitos reservados.</p>
    </footer>
</body>
</html>

