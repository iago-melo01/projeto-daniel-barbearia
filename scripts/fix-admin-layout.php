<?php
$root = dirname(__DIR__);
$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($root . '/admin', RecursiveDirectoryIterator::SKIP_DOTS)
);

foreach ($iterator as $file) {
    if ($file->getExtension() !== 'php') {
        continue;
    }
    $path = $file->getPathname();
    $content = file_get_contents($path);
    $orig = $content;

    // Remove require duplicado no topo quando já existe no head
    if (substr_count($content, "includes/admin/bootstrap.php") > 1) {
        $content = preg_replace(
            '/^<\?php\s*require_once dirname\(__DIR__, 2\) \. \'\/includes\/admin\/bootstrap\.php\';\s*\?>\s*\n/s',
            '',
            $content,
            1
        );
    }

    // Remove </div> órfão após adminPageOpen
    $content = preg_replace(
        '/adminPageOpen\([^)]*\);\s*\?>\s*\n\s*<\/div>\s*\n/s',
        "adminPageOpen();\n?>\n\n",
        $content
    );
    $content = preg_replace(
        '/adminPageOpen\(\'narrow\'\);\s*\?>\s*\n\s*<\/div>\s*\n/s',
        "adminPageOpen('narrow');\n?>\n\n",
        $content
    );

    // Painéis: adicionar footer se tem admin-grid mas não tem adminFooterNav
    if (strpos($content, 'admin-grid') !== false && strpos($content, 'adminFooterNav') === false) {
        $content = preg_replace(
            '/(\s*)<\/div>\s*\n<\?php adminPageClose\(\); \?>/',
            "$1</div>\n        </div>\n<?php adminFooterNav('?query=admin/admin', 'Voltar ao painel principal'); ?>\n<?php adminPageClose(); ?>",
            $content,
            1
        );
    }

    if ($content !== $orig) {
        file_put_contents($path, $content);
        echo 'FIX: ' . str_replace($root . DIRECTORY_SEPARATOR, '', $path) . "\n";
    }
}
