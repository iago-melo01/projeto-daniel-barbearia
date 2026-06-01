<?php
    header('Content-Type: application/json; charset=utf-8');

    require_once __DIR__ . '/../admin/conectaPDO.php';
    require_once __DIR__ . '/../includes/horarios-agendamento.php';

    $data = trim($_GET['data'] ?? '');
    $barbeiro = filter_var($_GET['barbeiro'] ?? '', FILTER_VALIDATE_INT);

    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $data)) {
        http_response_code(400);
        echo json_encode(['erro' => 'Data inválida.']);
        exit;
    }

    if ($barbeiro === false || $barbeiro < 1) {
        http_response_code(400);
        echo json_encode(['erro' => 'Selecione um barbeiro.']);
        exit;
    }

    $faixas = obterFaixasHorarioPorData($data);
    $fechado = empty($faixas);

    if ($fechado) {
        echo json_encode([
            'data' => $data,
            'barbeiro' => $barbeiro,
            'fechado' => true,
            'mensagem' => 'A barbearia não abre aos domingos e segundas-feiras.',
            'ocupados' => [],
            'faixas' => [],
        ]);
        exit;
    }

    $stmt = $pdo->prepare(
        'SELECT horario FROM agendamento
         WHERE DATE(horario) = :data AND barbeiro = :barbeiro'
    );
    $stmt->execute(['data' => $data, 'barbeiro' => $barbeiro]);

    $horariosReservados = $stmt->fetchAll(PDO::FETCH_COLUMN);
    $ocupados = calcularHorariosOcupadosParaData($data, $faixas, $horariosReservados);

    echo json_encode([
        'data' => $data,
        'barbeiro' => $barbeiro,
        'fechado' => false,
        'ocupados' => $ocupados,
        'faixas' => $faixas,
        'bloco_minutos' => BLOCO_AGENDA_MINUTOS,
    ]);
