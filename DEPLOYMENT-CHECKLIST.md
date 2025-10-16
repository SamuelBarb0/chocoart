# 📦 Checklist de Deployment - Sistema de Uploads

## ✅ Archivos a Subir a Producción

### 1. Controllers (2 archivos nuevos)
```
app/Http/Controllers/AdminUploadController.php
app/Http/Controllers/SettingUploadController.php
```

### 2. Views (2 archivos nuevos)
```
resources/views/admin/uploads.blade.php
resources/views/admin/settings-upload.blade.php
```

### 3. Routes (1 archivo modificado)
```
routes/web.php
```

### 4. Filament Resources (5 archivos modificados)
```
app/Filament/Resources/SettingResource.php
app/Filament/Resources/ProductResource.php
app/Filament/Resources/CourseResource.php
app/Filament/Resources/PostResource.php
app/Filament/Resources/GalleryImageResource.php
```

### 5. Middleware (1 archivo nuevo - OPCIONAL, solo si quieres logs)
```
app/Http/Middleware/LogFileUpload.php
bootstrap/app.php  (si quieres logs)
```

### 6. Archivos de diagnóstico (ELIMINAR DESPUÉS DE USAR)
```
public/check-php-config.php  ← ELIMINAR tras diagnosticar
```

---

## 🚀 Pasos para Deployment

### Paso 1: Subir Archivos por FTP/Git

Sube todos los archivos listados arriba a tu servidor de producción.

### Paso 2: Verificar Permisos (SSH/Terminal cPanel)

```bash
cd ~/chocoart

# Crear carpetas si no existen
mkdir -p storage/app/public/products
mkdir -p storage/app/public/courses
mkdir -p storage/app/public/posts
mkdir -p storage/app/public/gallery
mkdir -p storage/app/public/settings

# Dar permisos
chmod -R 755 storage/app/public

# Crear symlink
php artisan storage:link
```

### Paso 3: Limpiar Cache

```bash
cd ~/chocoart

php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
```

### Paso 4: Verificar Rutas

```bash
php artisan route:list --name=admin.uploads
php artisan route:list --name=settings.upload
```

Deberías ver:
```
GET   /admin/uploads
POST  /admin/uploads/main
POST  /admin/uploads/gallery
DELETE /admin/uploads/gallery

GET   /admin/settings-upload
POST  /admin/settings-upload
DELETE /admin/settings-upload
```

### Paso 5: Probar el Sistema

#### 5.1 Probar Settings Upload

1. Ir a: `https://chocoart.com.co/admin/settings-upload`
2. Debe mostrar lista de settings con tipo "Imagen"
3. Subir una imagen de prueba pequeña (100KB)
4. Verificar que aparece "✅ Archivo subido exitosamente"
5. Ir a Filament → Settings → Editar el setting
6. Debe mostrar "✓ Archivo actual: nombre.jpg"

#### 5.2 Probar Products Upload

1. Ir a: `https://chocoart.com.co/admin/uploads?resource=products`
2. Debe mostrar lista de productos
3. Subir imagen principal (campo "Imagen Principal")
4. Subir galería (campo "Galería")
5. Verificar mensajes de éxito
6. Ir a Filament → Products → Editar el producto
7. Debe mostrar "✓ Imagen principal: nombre.jpg"

#### 5.3 Probar Otros Recursos

Repetir lo mismo con:
- `/admin/uploads?resource=courses`
- `/admin/uploads?resource=posts`
- `/admin/uploads?resource=gallery`

---

## 🔍 Verificación de Funcionamiento

### ✅ Checklist de Pruebas

- [ ] `/admin/settings-upload` carga sin errores
- [ ] `/admin/uploads?resource=products` carga sin errores
- [ ] Puedo subir imagen principal de producto
- [ ] Puedo subir galería de producto
- [ ] Puedo eliminar imagen de galería
- [ ] La imagen aparece en Filament después de subirla
- [ ] La imagen aparece en el frontend del sitio
- [ ] No hay error `validation.uploaded`
- [ ] Los botones en Filament abren las páginas correctas

---

## ⚠️ Troubleshooting

### Error: Página 404 en `/admin/uploads`

```bash
# Limpiar cache de rutas
php artisan route:clear
php artisan config:clear

# Verificar que la ruta existe
php artisan route:list | grep uploads
```

### Error: "No such file or directory" al subir

```bash
# Crear carpetas
mkdir -p storage/app/public/settings
chmod -R 755 storage/app/public
```

### Error: Las imágenes no aparecen en frontend

```bash
# Verificar symlink
ls -la public/storage

# Si no existe:
php artisan storage:link
```

### Error: "Class AdminUploadController not found"

```bash
# Verificar que el archivo existe
ls -la app/Http/Controllers/AdminUploadController.php

# Limpiar autoload
composer dump-autoload
php artisan config:clear
```

---

## 📊 Después del Deployment

### Archivos a Eliminar

Una vez que todo funciona, elimina:

```bash
rm public/check-php-config.php
rm app/Http/Middleware/LogFileUpload.php  # Si no lo necesitas
```

### Archivos de Logs (Opcional)

Si agregaste el middleware de logs, puedes revisar:

```bash
tail -f storage/logs/laravel.log
```

---

## 🎉 ¡Listo!

Si todas las pruebas pasan, el sistema de uploads está funcionando correctamente.

### URLs Importantes:

- Settings: `https://chocoart.com.co/admin/settings-upload`
- Products: `https://chocoart.com.co/admin/uploads?resource=products`
- Courses: `https://chocoart.com.co/admin/uploads?resource=courses`
- Posts: `https://chocoart.com.co/admin/uploads?resource=posts`
- Gallery: `https://chocoart.com.co/admin/uploads?resource=gallery`

---

**Cualquier problema, revisa el troubleshooting o los logs de Laravel.**
