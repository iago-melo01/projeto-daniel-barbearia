<?php
    function urlBase(): string
    {
        $base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
        return $base === '' ? '' : $base;
    }

    function urlAsset(string $path): string
    {
        return urlBase() . '/' . ltrim($path, '/');
    }

    const LOGO_PALADINOS = 'assets/images/logo-paladinos.png';
