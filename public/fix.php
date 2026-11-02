<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$viewsPath = resource_path('views');
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($viewsPath));

echo "<h2>🔎 جاري فحص جميع ملفات Blade بحثاً عن @foreach المكسور...</h2>";

$found = false;
foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $content = file_get_contents($file->getPathname());
        
        // البحث عن أي @foreach ملاصق للكلمة التي بعده
        if (preg_match('/@foreach\([^\)]*as\$[a-zA-Z0-9_]+\)/i', $content, $matches)) {
            $found = true;
            echo "<p style='color: red;'>❌ <b>ملف مكسور:</b> " . str_replace(base_path(), '', $file->getPathname()) . "</p>";
            echo "<code>" . htmlspecialchars($matches[0]) . "</code><hr>";
        }
    }
}

if (!$found) {
    echo "<h3 style='color: green;'>✅ لم يتم العثور على صيغ @foreach مكسورة شائعة في ملفات resources/views!</h3>";
}