<?php
/**
 * Laghouat Cycle - Full Database & System Rebuilder (Fixed & Diagnostic)
 * المسار: /home/afrrxwxq/public_html/public/newadmin.php
 */

define('SECRET_KEY', 'laghouat2026');

ini_set('max_execution_time', 300);
ini_set('memory_limit', '512M');

// ميزة الحذف الذاتي للملف
if (isset($_POST['self_destruct'])) {
    if (@unlink(__FILE__)) {
        die("<h2 style='font-family:sans-serif;color:green;text-align:center;margin-top:50px;'>✅ تم حذف ملف newadmin.php بنجاح لحماية السيرفر.</h2>");
    } else {
        die("<h2 style='font-family:sans-serif;color:red;text-align:center;margin-top:50px;'>❌ تعذر حذف الملف تلقائياً، يرجى حذفه يدوياً عبر cPanel.</h2>");
    }
}

// التحقق من مفتاح الأمان
if (!isset($_GET['key']) || $_GET['key'] !== SECRET_KEY) {
    http_response_code(403);
    die("
    <div style='font-family:sans-serif;text-align:center;margin-top:100px;'>
        <h2 style='color:#e11d48;'>⛔ الدخول محمي</h2>
        <p>يجب تمرير مفتاح الأمان في الرابط لتشغيل السكريبت:</p>
        <code>?key=laghouat2026</code>
    </div>");
}

// 1. تنظيف ملفات الكاش الفيزيائية من القرص فوراً لضمان عدم قراءة بيانات قديمة
$cacheFiles = [
    __DIR__ . '/../bootstrap/cache/config.php',
    __DIR__ . '/../bootstrap/cache/routes-v7.php',
    __DIR__ . '/../bootstrap/cache/services.php',
    __DIR__ . '/../bootstrap/cache/packages.php',
];
foreach ($cacheFiles as $file) {
    if (file_exists($file)) {
        @unlink($file);
    }
}

// 2. تحميل بيئة لارافيل
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

$logs = [];
$dbConnectionOk = false;

// 3. فحص الاتصال بقاعدة البيانات قبل تنفيذ الأوامر
$dbHost = config('database.connections.mysql.host');
$dbPort = config('database.connections.mysql.port');
$dbName = config('database.connections.mysql.database');
$dbUser = config('database.connections.mysql.username');
$dbPass = config('database.connections.mysql.password');

try {
    $dsn = "mysql:host={$dbHost};port={$dbPort};dbname={$dbName};charset=utf8mb4";
    $pdo = new PDO($dsn, $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_TIMEOUT => 5
    ]);
    $dbConnectionOk = true;
    $logs[] = [
        'status' => 'success',
        'command' => 'MySQL Connection Check',
        'output' => "✅ تم الاتصال بنجاح بقاعدة البيانات [{$dbName}] باستخدام المستخدم [{$dbUser}] على [{$dbHost}]."
    ];
} catch (\Throwable $e) {
    $logs[] = [
        'status' => 'error',
        'command' => 'MySQL Connection Check',
        'output' => "❌ فشل الاتصال بقاعدة البيانات:\n" . $e->getMessage() . 
                    "\n\n🔍 فحص الإعدادات المقروءة حالياً:\n" .
                    "- DB_HOST: " . ($dbHost ?: 'غير محدد') . "\n" .
                    "- DB_DATABASE: " . ($dbName ?: 'غير محدد') . "\n" .
                    "- DB_USERNAME: " . ($dbUser ?: 'غير محدد') . "\n" .
                    "- طول كلمة المرور المقروءة: " . strlen($dbPass) . " حرف (تأكد من عدم وجود # دون علامات اقتباس)."
    ];
}

function runCommand($command, $params = []) {
    global $logs;
    try {
        Artisan::call($command, $params);
        $output = trim(Artisan::output());
        $logs[] = [
            'status' => 'success',
            'command' => $command . ' ' . json_encode($params),
            'output' => $output ?: 'Executed successfully.'
        ];
    } catch (\Throwable $e) {
        $logs[] = [
            'status' => 'error',
            'command' => $command,
            'output' => $e->getMessage()
        ];
    }
}

// 4. تنفيذ أوامر التهيئة في حال نجاح الاتصال فقط
if ($dbConnectionOk) {
    // تصفير الكاش الداخلي
    runCommand('optimize:clear');

    // إعادة بناء الجداول
    runCommand('migrate:fresh', ['--force' => true]);

    // تنفيذ الـ Seeders
    runCommand('db:seed', ['--force' => true]);

    // Storage link (مع معالجة وجوده المسبق)
    if (!file_exists(public_path('storage'))) {
        runCommand('storage:link');
    } else {
        $logs[] = [
            'status' => 'success',
            'command' => 'storage:link',
            'output' => 'الرابط public/storage موجود مسبقاً وسليم.'
        ];
    }

    // 5. إنشاء حساب المدير العام
    $adminCredentials = [
        'name'     => 'Admin Ilias',
        'phone'    => '0550112233',
        'email'    => 'admin@laghouatcycle.com',
        'password' => 'admin@laghouat2026',
        'role'     => 'admin'
    ];

    try {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $adminRole->syncPermissions(Permission::all());

        $admin = User::updateOrCreate(
            ['phone' => $adminCredentials['phone']],
            [
                'name'      => $adminCredentials['name'],
                'email'     => $adminCredentials['email'],
                'password'  => Hash::make($adminCredentials['password']),
                'role'      => 'admin',
                'is_active' => true,
            ]
        );

        $admin->syncRoles(['admin']);

        $logs[] = [
            'status' => 'success',
            'command' => 'Super Admin Verification',
            'output' => "تم تثبيت حساب المدير بنجاح برتبة admin وكامل الصلاحيات."
        ];
    } catch (\Throwable $e) {
        $logs[] = [
            'status' => 'error',
            'command' => 'Super Admin Verification',
            'output' => $e->getMessage()
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>Laghouat Cycle - فحص وإعادة تهيئة النظام</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; background: #0f172a; color: #f8fafc; padding: 25px; margin: 0; }
        .container { max-width: 900px; margin: 0 auto; background: #1e293b; padding: 30px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); }
        h1 { color: #38bdf8; margin-top: 0; }
        .card { background: #0f172a; border-radius: 8px; padding: 15px; margin-bottom: 20px; border-right: 4px solid #38bdf8; }
        .log-item { background: #111827; padding: 12px; border-radius: 6px; margin-bottom: 10px; font-family: monospace; font-size: 13px; }
        .success { border-right: 4px solid #22c55e; color: #86efac; }
        .error { border-right: 4px solid #ef4444; color: #fca5a5; }
        .btn-delete { background: #e11d48; color: white; border: none; padding: 12px 25px; border-radius: 6px; cursor: pointer; font-weight: bold; font-size: 15px; }
        .btn-delete:hover { background: #be123c; }
        .alert-box { background: #451a03; border-right: 4px solid #f59e0b; padding: 15px; border-radius: 6px; margin-bottom: 20px; color: #fde68a; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚀 فحص وإعادة إحياء قاعدة البيانات - Laghouat Cycle</h1>

        <?php if (!$dbConnectionOk): ?>
            <div class="alert-box">
                <strong>⚠️ فشل الاتصال بقاعدة البيانات!</strong><br>
                يرجى فتح ملف <code>/home/afrrxwxq/public_html/.env</code> والتأكد من إحاطة كلمة المرور بعلامتي تنصيص:
                <br><code>DB_PASSWORD="كلمة_المرور_هنا"</code>
            </div>
        <?php else: ?>
            <div class="card">
                <h3 style="margin-top:0; color:#38bdf8;">🔑 بيانات حساب المدير العام:</h3>
                <ul style="line-height: 1.8;">
                    <li><strong>البريد الإلكتروني:</strong> admin@laghouatcycle.com</li>
                    <li><strong>رقم الهاتف:</strong> 0550112233</li>
                    <li><strong>كلمة المرور:</strong> <code style="background:#334155;padding:2px 6px;border-radius:4px;">admin@laghouat2026</code></li>
                    <li><strong>الرتبة:</strong> admin (كامل الصلاحيات)</li>
                </ul>
            </div>
        <?php endif; ?>

        <h3>📋 سجل العمليات والفحص (Execution & Diagnostic Logs):</h3>
        <?php foreach ($logs as $log): ?>
            <div class="log-item <?= $log['status'] ?>">
                <strong>> <?= htmlspecialchars($log['command']) ?></strong><br>
                <pre style="margin:5px 0 0 0; white-space:pre-wrap;"><?= htmlspecialchars($log['output']) ?></pre>
            </div>
        <?php endforeach; ?>

        <?php if ($dbConnectionOk): ?>
        <div style="margin-top: 30px; padding: 20px; background: #450a0a; border-radius: 8px; text-align: center;">
            <p style="color: #fca5a5; font-weight: bold; margin-top: 0;">⚠️ تنبيه أمني: بعد التأكد من عمل الموقع، احذف هذا الملف فوراً!</p>
            <form method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا الملف نهائياً من السيرفر؟');">
                <button type="submit" name="self_destruct" class="btn-delete">🗑️ حذف ملف newadmin.php نهائياً الآن</button>
            </form>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>