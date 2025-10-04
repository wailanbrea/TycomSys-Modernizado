<?php
/**
 * Debug Index - Temporary file to diagnose Laravel Cloud issues
 * This file should be placed in /var/www/html/public/index.php
 */

echo "<h1>🔧 Laravel Cloud Debug</h1>";
echo "<p>Current time: " . date('Y-m-d H:i:s') . "</p>";
echo "<p>PHP Version: " . PHP_VERSION . "</p>";
echo "<p>Current directory: " . getcwd() . "</p>";

// Check if Laravel files exist
$files = [
    '../vendor/autoload.php' => 'Autoloader',
    '../bootstrap/app.php' => 'Laravel Bootstrap',
    '../.env' => 'Environment File',
    '../artisan' => 'Artisan CLI',
    '../public/index.php' => 'Public Index'
];

echo "<h2>📁 File Structure Check:</h2>";
foreach ($files as $file => $description) {
    $path = __DIR__ . '/' . $file;
    $exists = file_exists($path);
    echo "<p>{$description}: " . ($exists ? "✅ Exists" : "❌ Missing") . " ({$file})</p>";
}

// Check directory permissions
echo "<h2>🔐 Directory Permissions:</h2>";
$dirs = ['../', '../public', '../storage', '../bootstrap/cache'];
foreach ($dirs as $dir) {
    $path = __DIR__ . '/' . $dir;
    if (is_dir($path)) {
        $perms = substr(sprintf('%o', fileperms($path)), -4);
        $readable = is_readable($path);
        echo "<p>{$dir}: {$perms} " . ($readable ? "✅ Readable" : "❌ Not readable") . "</p>";
    }
}

// Try to load Laravel
echo "<h2>🚀 Laravel Load Test:</h2>";
try {
    if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
        require_once __DIR__ . '/../vendor/autoload.php';
        echo "<p>✅ Autoloader loaded successfully</p>";
        
        if (file_exists(__DIR__ . '/../bootstrap/app.php')) {
            $app = require_once __DIR__ . '/../bootstrap/app.php';
            echo "<p>✅ Laravel application loaded successfully</p>";
        } else {
            echo "<p>❌ Laravel bootstrap file not found</p>";
        }
    } else {
        echo "<p>❌ Composer autoloader not found</p>";
    }
} catch (Exception $e) {
    echo "<p>❌ Error loading Laravel: " . $e->getMessage() . "</p>";
}

echo "<h2>🌐 Environment Info:</h2>";
echo "<p>Document Root: " . ($_SERVER['DOCUMENT_ROOT'] ?? 'Not set') . "</p>";
echo "<p>Script Name: " . ($_SERVER['SCRIPT_NAME'] ?? 'Not set') . "</p>";
echo "<p>Request URI: " . ($_SERVER['REQUEST_URI'] ?? 'Not set') . "</p>";
?>
