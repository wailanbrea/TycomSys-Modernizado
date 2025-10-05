<?php
echo "<h1>✅ PHP Funciona en Laravel Cloud</h1>";
echo "<p>Fecha: " . date('Y-m-d H:i:s') . "</p>";
echo "<p>PHP Version: " . PHP_VERSION . "</p>";
echo "<p>Directorio actual: " . __DIR__ . "</p>";
echo "<p>Archivos en /public:</p>";
echo "<ul>";
$files = scandir(__DIR__);
foreach ($files as $file) {
    if ($file != '.' && $file != '..') {
        echo "<li>" . $file . "</li>";
    }
}
echo "</ul>";
?>