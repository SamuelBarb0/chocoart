# Sistema de Upload Externo para Filament - Chocoart

## 📋 Resumen

Hemos creado un **sistema de uploads separado de Filament** para evitar el error `validation.uploaded` causado por problemas de permisos en la carpeta temporal de PHP (`/tmp`) del servidor.

## 🎯 Solución Implementada

En lugar de usar el componente `FileUpload` de Filament (que requiere `/tmp` escribible), ahora los uploads se hacen en **páginas HTML separadas** que usan PHP tradicional para subir archivos directamente a `storage/app/public/`.

## 📁 Archivos Creados/Modificados

### Nuevos Archivos

1. **`app/Http/Controllers/AdminUploadController.php`**
   - Controller genérico para uploads de Products, Courses, Posts, Gallery

2. **`app/Http/Controllers/SettingUploadController.php`**
   - Controller específico para Settings

3. **`resources/views/admin/uploads.blade.php`**
   - Vista genérica para subir imágenes de productos, cursos, posts, galería

4. **`resources/views/admin/settings-upload.blade.php`**
   - Vista específica para subir archivos de Settings

### Archivos Modificados

1. **`routes/web.php`**
   - Rutas añadidas:
     - `/admin/uploads` - Gestor de imágenes genérico
     - `/admin/settings-upload` - Gestor de Settings

2. **`app/Filament/Resources/SettingResource.php`**
   - Reemplazado `FileUpload` con botón que abre página externa

3. **`app/Filament/Resources/ProductResource.php`**
   - Reemplazado `FileUpload` con botón que abre página externa

4. **`app/Filament/Resources/CourseResource.php`**
   - Reemplazado `FileUpload` con botón que abre página externa

5. **`app/Filament/Resources/PostResource.php`**
   - Reemplazado `FileUpload` con botón que abre página externa

6. **`app/Filament/Resources/GalleryImageResource.php`**
   - Reemplazado `FileUpload` con botón que abre página externa

## 🚀 Cómo Usar

### Para Settings

1. Ve a Filament: `https://chocoart.com.co/admin/settings`
2. Edita un setting de tipo "Imagen"
3. Verás un botón **"📤 Abrir página de subida de archivos"**
4. Click → Se abre `https://chocoart.com.co/admin/settings-upload`
5. Sube el archivo
6. Vuelve a Filament → El archivo ya está guardado

### Para Products, Courses, Posts, Gallery

1. Ve a Filament: `https://chocoart.com.co/admin/products` (o courses, posts, gallery-images)
2. Edita un item
3. Verás un botón **"📤 Abrir gestor de imágenes"**
4. Click → Se abre `https://chocoart.com.co/admin/uploads?resource=products`
5. Sube:
   - **Imagen Principal**: Aparece en tarjetas y listados
   - **Galería**: Múltiples imágenes (solo Products, Courses, Posts)
6. Vuelve a Filament → Las imágenes ya están guardadas

## 🎨 Características

### Página de Uploads Genérica (`/admin/uploads`)

- **Selector de recursos**: Cambia entre Products, Courses, Posts, Gallery
- **Colores por recurso**: Cada recurso tiene su color de marca
- **Vista previa**: Muestra la imagen actual antes de subir
- **Galería**: Sube múltiples imágenes (productos, cursos, posts)
- **Eliminar**: Botón para eliminar imágenes de galería
- **Sin límites del servidor**: Usa `storage/app/public/` directamente

### Página de Settings (`/admin/settings-upload`)

- **Agrupado por secciones**: Inicio, Contacto, Redes Sociales, Footer
- **Preview**: Muestra video o imagen actual
- **Identificación clara**: Muestra label, descripción y key de cada setting
- **Eliminar**: Botón para eliminar archivo actual

## ✅ Ventajas de este Sistema

1. **No requiere `/tmp` escribible** - Bypasea el problema del servidor
2. **Upload tradicional PHP** - Más simple y confiable
3. **Sin Livewire/Filament** - No hay procesamiento complejo
4. **Funciona en cualquier servidor** - Compatibilidad máxima
5. **Máximo 100MB** - Límite configurable en el controller
6. **Fácil de mantener** - Código simple y directo

## 📊 Rutas Disponibles

```
GET  /admin/uploads?resource=products     → Subir imágenes de productos
GET  /admin/uploads?resource=courses      → Subir imágenes de cursos
GET  /admin/uploads?resource=posts        → Subir imágenes de blog posts
GET  /admin/uploads?resource=gallery      → Subir imágenes de galería

POST /admin/uploads/main                  → Procesar imagen principal
POST /admin/uploads/gallery               → Procesar galería (múltiples)
DELETE /admin/uploads/gallery             → Eliminar imagen de galería

GET  /admin/settings-upload               → Subir archivos de Settings
POST /admin/settings-upload               → Procesar upload de Settings
DELETE /admin/settings-upload             → Eliminar archivo de Settings
```

## 🔧 Configuración en Producción

Los archivos se guardan en:
- **Products**: `storage/app/public/products/`
- **Courses**: `storage/app/public/courses/`
- **Posts**: `storage/app/public/posts/`
- **Gallery**: `storage/app/public/gallery/`
- **Settings**: `storage/app/public/settings/`

Asegúrate de que exista el symlink:
```bash
php artisan storage:link
```

Y que la carpeta tenga permisos:
```bash
chmod -R 755 storage/app/public
```

## 📝 Notas Importantes

1. **Los uploads ya NO usan Filament FileUpload** - Así evitamos el error `validation.uploaded`
2. **Los archivos se guardan con timestamp** - Para evitar conflictos de nombres
3. **Se eliminan archivos antiguos** - Al subir uno nuevo, el anterior se borra automáticamente
4. **Galería acumula imágenes** - No reemplaza, sino que agrega
5. **Validación de archivos**: Solo JPG, PNG, GIF, WEBP, MP4, WEBM, MOV

## 🐛 Troubleshooting

### Si no aparecen las imágenes en el frontend:

```bash
# Verifica el symlink
ls -la public/storage

# Si no existe, créalo
php artisan storage:link

# Verifica permisos
chmod -R 755 storage/app/public
```

### Si da error 404 en las páginas de upload:

```bash
# Verifica las rutas
php artisan route:list --name=admin.uploads
php artisan route:list --name=settings.upload
```

## 🎉 Resultado Final

Ahora puedes subir archivos sin problemas de servidor, con una interfaz bonita y funcional, usando los colores de marca de Chocoart. Todo funciona con PHP tradicional, sin depender de `/tmp`.

---

**Desarrollado para Chocoart** 🍫
Sistema de uploads externo - Laravel 12 + Filament 3.3
