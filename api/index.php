<?php

// Buat semua direktori yang dibutuhkan Laravel di /tmp
$directories = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
    '/tmp/bootstrap/cache',
];

foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Override storage path ke /tmp
$_SERVER['APP_STORAGE'] = '/tmp/storage';

require __DIR__ . '/../public/index.php';