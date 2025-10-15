#!/bin/bash
# Script para arreglar permisos de upload en producción
# Ejecutar: bash fix-upload-permissions.sh

echo "🔧 Arreglando permisos para uploads..."

# 1. Crear carpeta temporal personal para PHP uploads
echo "📁 Creando carpeta temporal de uploads..."
mkdir -p /home/yjopjnuw/tmp/php-uploads
chmod 755 /home/yjopjnuw/tmp/php-uploads

# 2. Crear carpeta settings en storage
echo "📁 Creando carpeta storage/app/public/settings..."
cd /home/yjopjnuw/chocoart
mkdir -p storage/app/public/settings
chmod -R 755 storage/app/public/settings

# 3. Arreglar permisos de storage completo
echo "🔐 Ajustando permisos de storage..."
chmod -R 755 storage
chmod -R 775 storage/framework
chmod -R 775 storage/logs
chmod -R 755 bootstrap/cache

# 4. Verificar symlink
echo "🔗 Verificando symlink de storage..."
if [ ! -L "public/storage" ]; then
    echo "Creando symlink..."
    php artisan storage:link
else
    echo "Symlink ya existe ✓"
fi

# 5. Verificar que todo quedó bien
echo ""
echo "✅ Verificación:"
echo "Carpeta temporal: $(ls -ld /home/yjopjnuw/tmp/php-uploads 2>/dev/null && echo '✓ OK' || echo '✗ ERROR')"
echo "Settings folder: $(ls -ld storage/app/public/settings 2>/dev/null && echo '✓ OK' || echo '✗ ERROR')"
echo "Storage writable: $(test -w storage/logs && echo '✓ OK' || echo '✗ ERROR')"

echo ""
echo "🎉 ¡Listo! Ahora necesitas configurar upload_tmp_dir en php.ini"
echo "Agrega esta línea a tu .htaccess o configura en cPanel:"
echo ""
echo "php_value upload_tmp_dir /home/yjopjnuw/tmp/php-uploads"
