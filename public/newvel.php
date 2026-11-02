<?php
$secret_password = "2026"; // كلمة المرور الخاصة بك

if (!isset($_GET['pass']) || $_GET['pass'] !== $secret_password) {
    http_response_code(403);
    die("Access Denied. Invalid or missing password.");
}

set_time_limit(600);

// الانتقال للمجلد الرئيسي للموقع (أعلى مجلد public)
$root_dir = dirname(__DIR__); // سيصبح /home/afrrxwxq/public_html
chdir($root_dir);

$composer_home = $root_dir . '/.composer';
if (!file_exists($composer_home)) {
    mkdir($composer_home, 0755, true);
}

putenv("COMPOSER_HOME=$composer_home");
putenv("HOME=$root_dir");

echo "<pre style='background: #111; color: #0f0; padding: 15px; font-family: monospace;'>";
echo "=== بدء عملية تهيئة مشروع لارايفل في المجلد الرئيسي ===\n";
echo "Current Directory: " . getcwd() . "\n\n";

// 1. تحميل وتثبيت composer.phar في المجلد الرئيسي إذا لم يكن موجوداً
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

// 2. الأوامر التي ستقام في المجلد الرئيسي (حيث يوجد composer.json و artisan)
$commands = [
    "php composer.phar --version",
    "php composer.phar install --no-dev --optimize-autoloader",
    "php artisan key:generate --force",
    // "php artisan migrate --force", // قم بإلغاء التفعيل إذا أردت تشغيل الترحيلات
];

foreach ($commands as $command) {
    echo "Running: $command\n";
    $output = shell_exec("COMPOSER_HOME=$composer_home " . $command . " 2>&1");
    echo htmlspecialchars($output) . "\n-----------------------------------\n";
}

echo "\n=== تمت العملية بنجاح! ===";
echo "</pre>";
?>