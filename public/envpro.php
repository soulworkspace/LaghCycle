<?php
set_time_limit(600);

$root_dir = dirname(__DIR__);
chdir($root_dir);

$composer_home = $root_dir . '/.composer';
if (!file_exists($composer_home)) {
    mkdir($composer_home, 0755, true);
}

putenv("COMPOSER_HOME=$composer_home");
putenv("HOME=$root_dir");

echo "<pre style='background: #111; color: #0f0; padding: 15px; font-family: monospace;'>";
echo "=== بدء عملية تهيئة مشروع لارايفل ===\n";
echo "Current Directory: " . getcwd() . "\n\n";

// 1. تحميل وتثبيت composer.phar محلياً إذا لم يكن موجوداً
if (!file_exists($root_dir . '/composer.phar')) {
    echo "جاري تحميل وتثبيت Composer محلياً...\n";
    $setup_script = file_get_contents('https://getcomposer.org/installer');
    file_put_contents($root_dir . '/composer-setup.php', $setup_script);
    
    $output = shell_exec("php $root_dir/composer-setup.php --install-dir=$root_dir 2>&1");
    echo htmlspecialchars($output) . "\n";
    
    if (file_exists($root_dir . '/composer-setup.php')) {
        unlink($root_dir . '/composer-setup.php');
    }
}

// 2. نسخ ملف .env.example إلى .env بشكل إجباري إذا لم يكن .env موجوداً
if (!file_exists($root_dir . '/.env')) {
    if (file_exists($root_dir . '/.env.example')) {
        copy($root_dir . '/.env.example', $root_dir . '/.env');
        echo "تم إنشاء ملف .env بنجاح من .env.example\n\n";
    } else {
        // إذا لم يوجد .env.example، سننشئ ملف .env فارغاً لتجنب خطأ key:generate
        file_put_contents($root_dir . '/.env', "APP_KEY=\n");
        echo "تم إنشـاء ملف .env افتراضي.\n\n";
    }
}

// 3. قائمة الأوامر للتنفيذ
$commands = [
    "php composer.phar --version",
    "php composer.phar install --no-dev --optimize-autoloader",
    "php artisan key:generate --force",
    // "php artisan migrate --force", // تفعيلها إذا أردت تشغيل الترحيلات
];

foreach ($commands as $command) {
    echo "Running: $command\n";
    $output = shell_exec("COMPOSER_HOME=$composer_home " . $command . " 2>&1");
    echo htmlspecialchars($output) . "\n-----------------------------------\n";
}

echo "\n=== تمت عملية التهيئة بنجاح! ===";
echo "</pre>";
?>