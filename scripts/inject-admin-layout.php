<?php
/**
 * Injeta layout Paladinos nos PHP do admin (após remover <style>).
 * php scripts/inject-admin-layout.php
 */
$root = dirname(__DIR__);

function bootstrapRequire(string $filePath): string
{
    $rel = str_replace('\\', '/', substr($filePath, strlen($root) + 1));
    $depth = substr_count($rel, '/') - 1; // admin/foo.php -> 1
    if ($depth <= 1) {
        return "require_once __DIR__ . '/../includes/admin/bootstrap.php';";
    }
    return "require_once dirname(__DIR__, 2) . '/includes/admin/bootstrap.php';";
}

function patchMessageFile(string $path, string $content): ?string
{
    if (strpos($content, 'message-container') === false) {
        return null;
    }
    if (strpos($content, 'adminPaginaMensagem') !== false) {
        return null;
    }

    if (!preg_match('/\$message\s*=\s*["\']([^"\']*)["\']/', $content, $mMsg)) {
        return null;
    }
    if (!preg_match('/\$type\s*=\s*["\'](\w+)["\']/', $content, $mType)) {
        return null;
    }

    $req = bootstrapRequire($path);
    $before = preg_replace(
        '/\?>\s*<!DOCTYPE html>[\s\S]*$/',
        "\n\n" . $req . "\nadminPaginaMensagem(\$message, \$type, \$links);\n",
        $content
    );
    return $before;
}

function patchHtmlShell(
    string $content,
    string $titulo,
    array $acoes,
    string $bodyInner,
    string $req,
    bool $narrow = false
): string {
    $acoesPhp = var_export($acoes, true);
    $open = $narrow ? "adminPageOpen('narrow');" : 'adminPageOpen();';

    return preg_replace(
        '/<!DOCTYPE html>[\s\S]*?<body[^>]*>/i',
        "<!DOCTYPE html>\n<html lang=\"pt-BR\">\n<head>\n<?php\n{$req}\nadminHead('{$titulo}');\n?>\n</head>\n<body class=\"admin-body\">\n<?php\nadminTopBar('{$titulo}', {$acoesPhp});\n{$open}\n?>\n",
        $content,
        1
    );
}

function closeBody(string $content): string
{
    if (strpos($content, 'adminPageClose') !== false) {
        return $content;
    }
    return preg_replace(
        '/\s*<\/body>\s*<\/html>\s*$/i',
        "\n<?php adminPageClose(); ?>\n</body>\n</html>\n",
        $content
    );
}

$mapPainel = [
    'admin/servicos/painel-admin-servicos.php' => ['Gerenciamento de Serviços', []],
    'admin/barbeiro/painel-admin-barbeiro.php' => ['Gerenciamento de Barbeiros', []],
    'admin/cliente/painel-admin-cliente.php' => ['Gerenciamento de Clientes', []],
    'admin/agendamento/painel-admin-agendamento.php' => ['Gerenciamento de Agendamentos', []],
    'admin/faleconosco/painel-admin-faleconosco.php' => ['Fale Conosco', []],
];

$mapList = [
    'admin/servicos/listar-servico.php' => ['Serviços', [
        ['url' => '?query=admin/servicos/cadastro-servico', 'label' => 'Novo serviço', 'class' => 'admin-btn-primary'],
        ['url' => '?query=admin/servicos/painel-admin-servicos', 'label' => 'Voltar', 'class' => 'admin-btn-secondary'],
    ]],
    'admin/barbeiro/listar-barbeiro.php' => ['Barbeiros', [
        ['url' => '?query=admin/barbeiro/cadastro-barbeiro', 'label' => 'Novo barbeiro', 'class' => 'admin-btn-primary'],
        ['url' => '?query=admin/barbeiro/painel-admin-barbeiro', 'label' => 'Voltar', 'class' => 'admin-btn-secondary'],
    ]],
    'admin/cliente/listar-cadastros.php' => ['Clientes', [
        ['url' => '?query=admin/cliente/cadastro-cliente', 'label' => 'Novo cliente', 'class' => 'admin-btn-primary'],
        ['url' => '?query=admin/cliente/painel-admin-cliente', 'label' => 'Voltar', 'class' => 'admin-btn-secondary'],
    ]],
    'admin/agendamento/listar-agendamento.php' => ['Agendamentos', [
        ['url' => '?query=admin/agendamento/cadastro-agendamento', 'label' => 'Novo agendamento', 'class' => 'admin-btn-primary'],
        ['url' => '?query=admin/agendamento/painel-admin-agendamento', 'label' => 'Voltar', 'class' => 'admin-btn-secondary'],
    ]],
    'admin/faleconosco/listar.php' => ['Mensagens', [
        ['url' => '?query=admin/faleconosco/painel-admin-faleconosco', 'label' => 'Voltar', 'class' => 'admin-btn-secondary'],
    ]],
];

$mapForm = [
    'admin/servicos/cadastro-servico.php' => ['Cadastro de Serviço', '?query=admin/servicos/painel-admin-servicos'],
    'admin/servicos/servico-form-editar.php' => ['Editar Serviço', '?query=admin/servicos/listar-servico'],
    'admin/barbeiro/cadastro-barbeiro.php' => ['Cadastro de Barbeiro', '?query=admin/barbeiro/painel-admin-barbeiro'],
    'admin/barbeiro/barbeiro-form-editar.php' => ['Editar Barbeiro', '?query=admin/barbeiro/listar-barbeiro'],
    'admin/cliente/cadastro-cliente.php' => ['Cadastro de Cliente', '?query=admin/cliente/painel-admin-cliente'],
    'admin/cliente/cliente-form-editar.php' => ['Editar Cliente', '?query=admin/cliente/listar-cadastros'],
    'admin/agendamento/cadastro-agendamento.php' => ['Novo Agendamento', '?query=admin/agendamento/painel-admin-agendamento'],
    'admin/agendamento/agendamento-form-editar.php' => ['Editar Agendamento', '?query=admin/agendamento/listar-agendamento'],
];

$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($root . '/admin', RecursiveDirectoryIterator::SKIP_DOTS)
);

$updated = 0;

foreach ($iterator as $file) {
    if ($file->getExtension() !== 'php') {
        continue;
    }
    $path = $file->getPathname();
    $rel = str_replace('\\', '/', substr($path, strlen($root) + 1));
    $content = file_get_contents($path);
    $orig = $content;

    if ($patched = patchMessageFile($path, $content)) {
        file_put_contents($path, $patched);
        echo "MSG: $rel\n";
        $updated++;
        continue;
    }

    $req = bootstrapRequire($path);

    if (isset($mapPainel[$rel]) && strpos($content, 'adminTopBar') === false) {
        [$titulo, $acoes] = $mapPainel[$rel];
        $acoes = array_merge($acoes, [
            ['url' => '?query=admin/admin', 'label' => 'Painel principal', 'class' => 'admin-btn-secondary'],
        ]);
        if (!str_starts_with(trim($content), '<?php')) {
            $content = "<?php\n{$req}\n?>\n" . $content;
        }
        $content = patchHtmlShell($content, $titulo, $acoes, '', $req);
        $content = preg_replace('/<div class="admin-header">[\s\S]*?<\/div>\s*/', '', $content);
        $content = preg_replace('/<div class="back-section">[\s\S]*?<\/div>\s*/', '', $content);
        $content = str_replace(
            '</div>' . "\n" . '</body>',
            "</div>\n<?php adminFooterNav('?query=admin/admin', 'Voltar ao painel principal'); ?>\n<?php adminPageClose(); ?>\n</body>",
            $content
        );
        $content = closeBody($content);
        file_put_contents($path, $content);
        echo "PAINEL: $rel\n";
        $updated++;
        continue;
    }

    if (isset($mapList[$rel]) && strpos($content, 'adminTopBar') === false) {
        [$titulo, $acoes] = $mapList[$rel];
        if (!preg_match('/^<\?php/', trim($content))) {
            $content = "<?php\n{$req}\n?>\n" . $content;
        }
        $content = patchHtmlShell($content, $titulo, $acoes, '', $req);
        $content = preg_replace('/<div class="list-header">[\s\S]*?<\/div>\s*/', '', $content);
        $content = closeBody($content);
        file_put_contents($path, $content);
        echo "LIST: $rel\n";
        $updated++;
        continue;
    }

    if (isset($mapForm[$rel]) && strpos($content, 'adminTopBar') === false) {
        [$titulo, $voltar] = $mapForm[$rel];
        $acoes = [['url' => $voltar, 'label' => 'Voltar', 'class' => 'admin-btn-secondary']];
        if (!preg_match('/^<\?php/', trim($content))) {
            $content = "<?php\n{$req}\n?>\n" . $content;
        }
        $content = patchHtmlShell($content, $titulo, $acoes, '', $req, true);
        $content = preg_replace('/<div class="form-header">[\s\S]*?<\/div>\s*/', '', $content);
        $content = closeBody($content);
        file_put_contents($path, $content);
        echo "FORM: $rel\n";
        $updated++;
        continue;
    }
}

echo "Total: $updated\n";
