<?php
/**
 * Script único para remover blocos <style> antigos dos PHP do admin.
 * Execute: php scripts/aplicar-tema-admin.php
 */
$root = dirname(__DIR__);
$adminDir = $root . '/admin';
$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($adminDir, RecursiveDirectoryIterator::SKIP_DOTS)
);

$count = 0;
foreach ($iterator as $file) {
    if ($file->getExtension() !== 'php') {
        continue;
    }
    $path = $file->getPathname();
    if (basename($path) === 'conectaMYSQL.php' || basename($path) === 'conectaPDO.php') {
        continue;
    }
    $content = file_get_contents($path);
    $new = preg_replace('/\s*<style>.*?<\/style>\s*/s', "\n", $content, -1, $replaced);
    if ($replaced > 0 && $new !== $content) {
        file_put_contents($path, $new);
        $count++;
        echo "OK: " . str_replace($root . DIRECTORY_SEPARATOR, '', $path) . "\n";
    }
}
echo "Arquivos atualizados: $count\n";
