# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Chocoart is a Laravel 12 web application for an artisanal chocolate business. The project showcases chocolate products, offers online courses, provides a blog, and includes contact functionality. The site features a custom brand design with liquid/fluid visual effects following a specific brand manual.

**Key Technologies:**
- Laravel 12 (PHP 8.2+)
- Filament 3.3 (Admin Panel)
- Tailwind CSS 4 (with Vite)
- SQLite (default) or MySQL

## Brand Identity (Critical)

All design work MUST follow the brand manual specifications:

**Colors:**
- Pink: `#e28dc4` (var `--rosa`) - Primary brand color
- Aqua: `#81cacf` (var `--menta`) - Secondary brand color
- Lime: `#c6d379` (var `--pistacho`) - Accent color
- Chocolate: `#5f3917` (var `--choco`) - Text and dark elements

Note: Some templates use inline CSS custom properties, others hardcode hex values. Prefer CSS variables for consistency.

**Typography:**
- Primary: Poppins (headings, body)
- Script: Dancing Script (decorative, slogan)
- Secondary: Quicksand (supporting text)

**Visual Style:**
- "Liquid" design with organic, flowing shapes
- SVG wave dividers between sections
- Animated rotating text rings around product capsules
- Gradient combinations of brand colors
- Decorative elements: scalloped borders, floating animations, morphing shapes

## Key Commands

### Development
```bash
# Start development server with hot reload
php artisan serve

# Start frontend asset compilation
npm run dev

# Run all services concurrently (server, queue, logs, vite)
composer dev
```

### Code Quality
```bash
# Format code with Laravel Pint
./vendor/bin/pint

# Run specific file/directory
./vendor/bin/pint app/Http/Controllers
```

### Testing
```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature
php artisan test --testsuite=Unit

# Run single test file
php artisan test tests/Feature/ExampleTest.php

# Run with coverage
php artisan test --coverage
```

### Database
```bash
# Run migrations
php artisan migrate

# Fresh migration with seeding
php artisan migrate:fresh --seed

# Seed admin user for Filament panel
php artisan db:seed --class=AdminUserSeeder

# Rollback
php artisan migrate:rollback

# Create storage link for uploaded files
php artisan storage:link
```

### Asset Management
```bash
# Build for production
npm run build

# Install dependencies
npm install
composer install
```

## Architecture

### Database Models

The application uses Eloquent models with the following structure:

**Product** (`app/Models/Product.php`)
- Fields: name, slug, description, price, category, icon, gradient, image, images (array), featured, published, order, SEO fields
- Scopes: `published()`, `featured()`
- Auto-generates slug from name on creation
- Auto-populates SEO meta fields if empty

**Course** (`app/Models/Course.php`)
- Similar structure to Product
- Fields include badge field for highlighting

**Post** (`app/Models/Post.php`)
- Blog posts with published status
- Ordered by published_at date

**GalleryImage** (`app/Models/GalleryImage.php`)
- Simple gallery images with ordering

**SeoSetting** (`app/Models/SeoSetting.php`)
- Global SEO configuration

**Setting** (`app/Models/Setting.php`)
- Site-wide editable configuration system
- Groups: `home`, `contact`, `social`, `footer`, `general`
- Types: text, textarea, email, phone, url, image
- Cached automatically for performance (1 hour TTL)
- Static methods: `Setting::get($key, $default)`, `Setting::set($key, $value)`, `Setting::getGroup($group)`
- Image handling: Auto-strips 'storage/' prefix to prevent path duplication
- Cache clears automatically on save/delete

### Filament Admin Panel

The admin panel is accessible at `/admin` and uses Filament 3.3:

**Access:**
- URL: `http://localhost/chocoart/public/admin`
- Default credentials: admin@chocoart.com / password
- Brand colors customized to match Chocoart pink theme

**Resources (in navigation order):**
1. ProductResource - Manage products with image uploads, gallery, SEO
2. CourseResource - Manage courses with badge support
3. GalleryImageResource - Manage gallery images
4. PostResource - Manage blog posts
5. SeoSettingResource - Global SEO settings
6. SettingResource - Site-wide editable configuration (hero video, footer, contact info, feature cards, social links)

**Features:**
- File uploads stored in `storage/app/public` (symlinked to `public/storage`)
- Image/video uploads with 50MB max file size
- Image editor for cropping/resizing (avoid using in SettingResource - causes upload issues)
- Reorderable galleries
- Rich text editor for descriptions
- SEO fields (meta_title, meta_description, meta_keywords)
- Published/Featured toggles
- Order field for custom sorting
- Settings organized by groups with color-coded badges
- Dynamic form fields based on setting type (text, textarea, email, phone, url, image)

### Frontend Structure

**Asset Pipeline:**
- Uses Vite for asset compilation with Tailwind CSS 4
- Entry points: `resources/css/app.css` and `resources/js/app.js`
- Assets referenced via `@vite()` directive in layouts
- Custom styles embedded in Blade templates using `<style>` blocks with Tailwind utility classes

**Blade Templates:**
- `resources/views/layouts/app.blade.php` - Master layout with:
  - Top bar with contact info and social links
  - Sticky navigation with mobile menu toggle
  - Footer with wave divider SVG
  - Google Fonts: Poppins, Dancing Script, Quicksand
  - Mobile menu collapse functionality
  - WhatsApp floating button
- Page views: `home.blade.php`, `productos.blade.php`, `cursos.blade.php`, `galeria.blade.php`, `blog.blade.php`, `blog-post.blade.php`, `contacto.blade.php`

**JavaScript Assets:**
- `public/js/animations.js` - Brand-specific animations referenced in layout
- Inline scripts for interactive components (modal, carousel, menu toggle)

**Styling Approach:**
- Tailwind CSS 4 utility-first classes as primary styling method
- Inline `<style>` blocks for component-specific animations and brand colors
- CSS custom properties in `:root` for brand consistency
- Responsive design with Tailwind breakpoints (sm, md, lg)

### Routes Structure

Routes are defined in `routes/web.php` using closure-based routing:

**Public Routes:**
- `GET /` → home view (fetches products for preview, uses Settings for hero/features)
- `GET /productos` → productos view (fetches published products from DB)
- `GET /cursos` → cursos view (fetches published courses from DB)
- `GET /galeria` → galeria view (fetches gallery images with categories from DB)
- `GET /blog` → blog view (fetches published posts from DB)
- `GET /blog/{slug}` → blog-post view (fetches single post with intelligent related posts)
- `GET /contacto` → contacto view (uses Settings for contact info)
- `POST /contacto` → contacto.store (TODO: needs implementation)
- `GET /media/{path}` → serves files from public storage

**Admin Routes:**
- Automatically handled by Filament at `/admin`

**Data Flow:**
Routes fetch data from models and pass to views via `compact()`:
```php
Route::get('/productos', function () {
    $productos = Product::where('published', true)->orderBy('order')->get();
    return view('productos', compact('productos'));
});

Route::get('/', function () {
    $productos = Product::where('published', true)->orderBy('order')->get();
    return view('home', compact('productos'));
});
```

**Settings Usage in Views:**
Settings are accessed directly in Blade templates for dynamic content:
```blade
{{ \App\Models\Setting::get('home_hero_title', 'Arte con Chocolate') }}
{{ \App\Models\Setting::get('contact_email', 'info@chocoart.com') }}

@php
  // For uploaded files (videos/images)
  $heroVideo = \App\Models\Setting::get('home_hero_video', 'videos/default.mp4');
  $videoPath = str_starts_with($heroVideo, 'settings/')
    ? asset('storage/' . $heroVideo)
    : asset($heroVideo);
@endphp
<video src="{{ $videoPath }}" ...>
```

**Views Pattern:**
```blade
@extends('layouts.app')
@section('title', 'Page Title')
@section('content')
    <!-- Page content -->
@endsection

@push('scripts')
<script src="{{ asset('js/script.js') }}"></script>
@endpush
```

### Contact Form Implementation Notes

The contact form currently redirects back with a success message but doesn't process data. To implement:

1. Create a controller: `php artisan make:controller ContactController`
2. Add validation and email sending logic
3. Update route in `routes/web.php` to use controller method
4. Configure mail settings in `.env`

## Development Workflow

### Adding New Pages

1. Create Blade view in `resources/views/`
2. Extend `layouts.app` layout
3. Add route in `routes/web.php`
4. Use brand colors and existing CSS patterns
5. If data-driven, create model and Filament resource

### Styling Guidelines

- Primary approach: Tailwind CSS 4 utility classes
- Brand colors: Use Tailwind bracket notation `[#e28dc4]` or CSS custom properties when defined
- Maintain liquid/organic design aesthetic with flowing shapes
- Use gradients combining 2-3 brand colors (e.g., `bg-gradient-to-br from-[#e28dc4] to-[#81cacf]`)
- Component-specific animations go in inline `<style>` blocks with `@keyframes`
- Ensure mobile responsiveness with Tailwind breakpoints
- Common patterns:
  - Rounded corners: `rounded-full`, `rounded-2xl`, `rounded-xl`
  - Shadows: `shadow-lg`, `shadow-xl`, `shadow-2xl`
  - Transitions: `transition-all duration-300`, `transition-colors duration-300`

### JavaScript Patterns

- Inline scripts using IIFEs: `(() => { /* code */ })()`
- Event listeners for interactive elements (modals, carousels, menu toggles)
- Accessibility attributes: `aria-label`, `aria-expanded`, `aria-current`
- Form submissions include CSRF token (`@csrf`)
- Keyboard navigation support (Escape to close, Arrow keys for carousels)

### Adding Content via Filament

**Products, Courses, Posts, Gallery:**
1. Access admin panel at `/admin`
2. Login with admin credentials
3. Use resource forms to add/edit content
4. Upload images (automatically stored in `storage/app/public/{resource}/`)
5. Set order field to control display sequence (lower = first)
6. Toggle published/featured as needed
7. Content automatically appears on frontend routes

**Settings (site-wide configuration):**
1. Go to Admin Panel → Configuración
2. Filter by group (Inicio, Contacto, Redes Sociales, Footer)
3. Click Edit on the setting you want to change
4. **For file uploads:** Change "Tipo" field to "Imagen" first, then upload field appears
5. Files save to `storage/app/public/settings/`
6. Changes appear immediately on frontend (cached for 1 hour)

## Environment Setup

Required `.env` configuration:
```env
APP_NAME=Chocoart
APP_ENV=local
APP_KEY=base64:... # Generate with php artisan key:generate
APP_DEBUG=true
APP_URL=http://localhost

# SQLite (default) or MySQL
DB_CONNECTION=sqlite
# For MySQL, uncomment and configure:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=chocoart
# DB_USERNAME=root
# DB_PASSWORD=

# File uploads
FILESYSTEM_DISK=public

# Mail configuration (for contact form)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="noreply@chocoart.com"
MAIL_FROM_NAME="Chocoart"
```

## XAMPP/Local Development

This project runs in XAMPP environment:
- Web root: `c:\xampp1\htdocs\chocoart`
- Access frontend: `http://localhost/chocoart/public`
- Access admin: `http://localhost/chocoart/public/admin`
- Ensure Apache and MySQL are running (if using MySQL instead of SQLite)
- Ensure `public/storage` symlink exists: `php artisan storage:link`

## Settings System Architecture

The Settings system allows site-wide configuration to be edited through the Filament admin panel without code changes.

### Settings Configuration

**Available Setting Groups:**
- `home` - Hero section, about section, feature cards (37 total settings)
- `contact` - Email, phone, WhatsApp, address, hours, map URL
- `social` - Facebook, Instagram, TikTok, YouTube, Twitter URLs
- `footer` - About text, copyright, logo
- `general` - Miscellaneous site-wide settings

**Key Settings:**
```
Home:
  - home_hero_video (image type - accepts video files)
  - home_hero_title, home_hero_subtitle, home_hero_description
  - home_about_title, home_about_text_1, home_about_text_2, home_about_image
  - home_feature_1_icon (color hex), home_feature_1_title, home_feature_1_description
  - home_feature_2_icon, home_feature_2_title, home_feature_2_description
  - home_feature_3_icon, home_feature_3_title, home_feature_3_description

Contact:
  - contact_email, contact_phone, contact_whatsapp
  - contact_whatsapp_message (pre-filled WhatsApp message)
  - contact_address, contact_hours, contact_map_url

Social:
  - social_facebook, social_instagram, social_tiktok
  - social_youtube, social_twitter

Footer:
  - footer_about, footer_copyright, footer_logo (image type)
```

### Seeding Settings

Run `php artisan db:seed --class=SettingsSeeder` to populate default settings. The seeder uses `updateOrCreate()` so it's safe to run multiple times.

### Using Settings in Views

**Simple text values:**
```blade
<h1>{{ \App\Models\Setting::get('home_hero_title', 'Default Title') }}</h1>
<a href="mailto:{{ \App\Models\Setting::get('contact_email', 'info@example.com') }}">
```

**Conditional rendering (social links):**
```blade
@if(\App\Models\Setting::get('social_facebook'))
  <a href="{{ \App\Models\Setting::get('social_facebook') }}" target="_blank">
    <!-- Facebook icon -->
  </a>
@endif
```

**File uploads:**
```blade
@php
  $heroVideo = \App\Models\Setting::get('home_hero_video', 'videos/default.mp4');
  $videoPath = str_starts_with($heroVideo, 'settings/')
    ? asset('storage/' . $heroVideo)
    : asset($heroVideo);
@endphp
<video src="{{ $videoPath }}" ...>
```

**Feature cards with dynamic colors:**
```blade
<div style="background-color: {{ \App\Models\Setting::get('home_feature_1_icon', '#e28dc4') }}">
  <h3>{{ \App\Models\Setting::get('home_feature_1_title', 'Title') }}</h3>
  <p>{{ \App\Models\Setting::get('home_feature_1_description', 'Description') }}</p>
</div>
```

### Caching

Settings are automatically cached for 1 hour using Laravel's cache system. Cache is cleared when a setting is saved or deleted via the boot method in the Setting model.

## Important Implementation Notes

### File Uploads

**Storage Structure:**
```
storage/
  app/
    public/
      products/       ← Product images
      courses/        ← Course images
      posts/          ← Blog post images
      gallery/        ← Gallery images
      settings/       ← Settings images/videos (hero video, footer logo, etc.)
```

**Setup:**
- Symlink required: `php artisan storage:link` creates `public/storage -> storage/app/public`
- Access images in views: `{{ asset('storage/products/image.jpg') }}`
- Or use media route: `{{ url('/media/products/image.jpg') }}`

**Settings Files:**
- Settings with type='image' can accept images OR videos
- Max file size: 50MB
- Files stored in `settings/` subdirectory
- Use helper pattern to check if file is uploaded vs. default:
  ```blade
  @php
    $value = \App\Models\Setting::get('key', 'default/path.ext');
    $path = str_starts_with($value, 'settings/')
      ? asset('storage/' . $value)  // Uploaded file
      : asset($value);               // Default file
  @endphp
  ```

### Interactive Components

**Product Modal with Carousel:**
- Located in relevant product views
- Triggered by `.open-modal` buttons with `data-*` attributes
- Carousel supports touch/swipe on mobile
- Images array passed via `data-images` JSON attribute
- Modal styling uses gradient card with brand colors

**SVG Patterns:**
- Wave dividers: Use `<path>` with curves for organic section transitions
- Text rings: Circular `<textPath>` with rotating animation
- Decorative frames: Organic blob shapes using SVG paths

### Asset References

Use Laravel asset helpers for all resources:
- Images: `{{ asset('images/filename.png') }}`
- Storage images: `{{ asset('storage/products/filename.jpg') }}`
- Videos: `{{ asset('videos/filename.mp4') }}`
- JavaScript: `{{ asset('js/filename.js') }}`
- Routes: `{{ route('route.name') }}`

### Data Patterns

When working with models, follow these patterns:

**Fetching published content:**
```php
$productos = Product::published()->orderBy('order')->get();
$cursos = Course::published()->orderBy('order')->get();
$posts = Post::published()->orderBy('published_at', 'desc')->get();
```

**Featured items:**
```php
$featured = Product::published()->featured()->get();
```

**Related blog posts (intelligent matching):**
```php
// Get post
$post = Post::where('slug', $slug)->where('published', true)->firstOrFail();

// Get related posts (same category first, then fill with recent)
$relatedPosts = Post::where('published', true)
    ->where('id', '!=', $post->id)
    ->where('category', $post->category)
    ->orderBy('published_at', 'desc')
    ->take(3)
    ->get();

// Fill remaining slots with other recent posts
if ($relatedPosts->count() < 3) {
    $additionalPosts = Post::where('published', true)
        ->where('id', '!=', $post->id)
        ->whereNotIn('id', $relatedPosts->pluck('id'))
        ->orderBy('published_at', 'desc')
        ->take(3 - $relatedPosts->count())
        ->get();
    $relatedPosts = $relatedPosts->merge($additionalPosts);
}
```

**Gallery with categories:**
```php
$images = GalleryImage::query()
    ->orderByDesc('featured')
    ->orderBy('order')
    ->orderBy('id')
    ->get();

$categories = $images->pluck('category')
    ->filter()
    ->unique()
    ->values()
    ->map(fn ($c) => [
        'label' => $c,
        'slug'  => Str::of($c)->lower()->slug('-'),
    ]);
```

**Product display on home page:**
The home page shows the first 4 published products. In Blade:
```blade
@if(isset($productos) && $productos->count() > 0)
  @foreach($productos->take(4) as $producto)
    @if($producto->image)
      <!-- Show product image -->
      <img src="{{ asset('storage/' . $producto->image) }}" ...>
    @else
      <!-- Show gradient with icon/emoji -->
      <div class="bg-gradient-to-br {{ $producto->gradient }}">
        {{ $producto->icon }}
      </div>
    @endif
    <h3>{{ $producto->name }}</h3>
  @endforeach
@else
  <!-- Fallback: 4 hardcoded example products -->
@endif
```

## Brand Consistency Checklist

When adding features, verify:
- [ ] Uses brand color hex values or CSS custom properties
- [ ] Typography follows Poppins/Dancing Script/Quicksand pattern
- [ ] Includes liquid/organic shape elements where appropriate (SVG waves, rounded shapes)
- [ ] Maintains visual consistency with existing sections
- [ ] Responsive across breakpoints (mobile-first approach)
- [ ] Smooth animations using Tailwind transitions or custom `@keyframes`
- [ ] Accessibility: proper ARIA labels, keyboard navigation, semantic HTML
- [ ] Images uploaded via Filament are properly referenced in views
- [ ] Data fetched from models/Settings, not hardcoded
- [ ] Settings used for site-wide configuration (contact info, social links, hero content)
- [ ] Uploaded files (Settings) use proper path checking pattern (settings/ prefix check)
- [ ] All Spanish labels in Filament resources match existing naming conventions
