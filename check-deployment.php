<?php
/**
 * Deployment Check Script
 * This file helps verify that the deployment is working correctly
 */

echo "Laravel Deployment Check\n";
echo "========================\n\n";

// Check if public/index.php exists
if (file_exists(__DIR__ . '/public/index.php')) {
    echo "✅ public/index.php exists\n";
} else {
    echo "❌ public/index.php missing\n";
}

// Check if bootstrap/app.php exists
if (file_exists(__DIR__ . '/bootstrap/app.php')) {
    echo "✅ bootstrap/app.php exists\n";
} else {
    echo "❌ bootstrap/app.php missing\n";
}

// Check if vendor/autoload.php exists
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    echo "✅ vendor/autoload.php exists\n";
} else {
    echo "❌ vendor/autoload.php missing\n";
}

// Check if .env exists
if (file_exists(__DIR__ . '/.env')) {
    echo "✅ .env file exists\n";
} else {
    echo "❌ .env file missing\n";
}

// Check PHP version
echo "PHP Version: " . PHP_VERSION . "\n";

// Check current working directory
echo "Current Directory: " . __DIR__ . "\n";

// Check if we can access Laravel
if (file_exists(__DIR__ . '/public/index.php')) {
    echo "\n🔧 Attempting to load Laravel...\n";
    try {
        // Include Laravel bootstrap
        require_once __DIR__ . '/vendor/autoload.php';
        $app = require_once __DIR__ . '/bootstrap/app.php';
        echo "✅ Laravel application loaded successfully!\n";
    } catch (Exception $e) {
        echo "❌ Error loading Laravel: " . $e->getMessage() . "\n";
    }
}

echo "\n========================\n";
echo "Check completed.\n";
?>
