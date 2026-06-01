<?php
    const NOME_BARBEARIA = 'Barbearia Paladinos';
    const INSTAGRAM_BARBEARIA = 'https://www.instagram.com/barbeariapaladinosjpa';
    const INSTAGRAM_USUARIO = '@barbeariapaladinosjpa';

    const MENSAGEM_AGENDAMENTO_SUCESSO =
        'Agendamento realizado com sucesso. Aguarde a confirmação da barbearia.';

    /** Minutos bloqueados na agenda por agendamento (sempre 1 hora). */
    const BLOCO_AGENDA_MINUTOS = 60;

    function obterCatalogoServicosPaladinos(): array
    {
        // Corte R$ 30 | barba R$ 20 | sobrancelha R$ 15 — combos = soma
        return [
            'Corte Masculino' => ['duracao' => 45, 'preco' => 30.00],
            'Corte + Barba' => ['duracao' => 60, 'preco' => 50.00],
            'Corte + Sobrancelha' => ['duracao' => 45, 'preco' => 45.00],
        ];
    }

    function obterHorarioFuncionamentoTexto(): array
    {
        return [
            'Terça a sexta-feira: 09:00 às 18:00',
            'Sábado: 09:00 às 14:00',
            'Domingo e segunda-feira: fechado',
        ];
    }
