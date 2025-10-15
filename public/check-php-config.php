<?php
// Archivo temporal para diagnosticar configuración de PHP en producción
// Acceder: https://chocoart.com.co/check-php-config.php
// IMPORTANTE: Eliminar después de usar por seguridad

echo "<h1>Diagnóstico de PHP Upload</h1>";

echo "<h2>Configuración de Upload</h2>";
echo "<pre>";
echo "upload_tmp_dir: " . ini_get('upload_tmp_dir') . " (si está vacío, usa /tmp)\n";
echo "upload_max_filesize: " . ini_get('upload_max_filesize') . "\n";
echo "post_max_size: " . ini_get('post_max_size') . "\n";
echo "max_file_uploads: " . ini_get('max_file_uploads') . "\n";
echo "file_uploads: " . (ini_get('file_uploads') ? 'ON' : 'OFF') . "\n";
echo "</pre>";

echo "<h2>Verificación de Carpeta Temporal</h2>";
$tmp_dir = ini_get('upload_tmp_dir') ?: sys_get_temp_dir();
echo "<pre>";
echo "Carpeta temporal: " . $tmp_dir . "\n";
echo "¿Existe?: " . (file_exists($tmp_dir) ? 'SÍ' : 'NO') . "\n";
echo "¿Es escribible?: " . (is_writable($tmp_dir) ? 'SÍ' : 'NO') . "\n";
echo "Permisos: " . (file_exists($tmp_dir) ? substr(sprintf('%o', fileperms($tmp_dir)), -4) : 'N/A') . "\n";
echo "</pre>";

echo "<h2>Test de escritura</h2>";
$test_file = $tmp_dir . '/test_upload_' . time() . '.txt';
if (@file_put_contents($test_file, 'test')) {
    echo "<p style='color: green;'>✅ Puedo escribir en la carpeta temporal</p>";
    @unlink($test_file);
} else {
    echo "<p style='color: red;'>❌ NO puedo escribir en la carpeta temporal</p>";
    echo "<p>Error: " . error_get_last()['message'] . "</p>";
}

echo "<h2>Storage de Laravel</h2>";
$storage_path = dirname(__DIR__) . '/storage/app/public/settings';
echo "<pre>";
echo "Carpeta: " . $storage_path . "\n";
echo "¿Existe?: " . (file_exists($storage_path) ? 'SÍ' : 'NO') . "\n";
echo "¿Es escribible?: " . (is_writable($storage_path) ? 'SÍ' : 'NO') . "\n";
if (file_exists($storage_path)) {
    echo "Permisos: " . substr(sprintf('%o', fileperms($storage_path)), -4) . "\n";
}
echo "</pre>";

if (!file_exists($storage_path)) {
    echo "<p style='color: orange;'>⚠️ La carpeta settings no existe. Laravel debería crearla automáticamente.</p>";
}

echo "<h2>Información del Sistema</h2>";
echo "<pre>";
echo "PHP Version: " . phpversion() . "\n";
echo "Server: " . $_SERVER['SERVER_SOFTWARE'] . "\n";
echo "User: " . get_current_user() . "\n";
echo "UID: " . getmyuid() . "\n";
echo "</pre>";

echo "<hr>";
echo "<p style='color: red; font-weight: bold;'>⚠️ ELIMINA ESTE ARCHIVO DESPUÉS DE USARLO: rm public/check-php-config.php</p>";
