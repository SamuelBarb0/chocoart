# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Chocoart is a Laravel 12 web application for an artisanal chocolate business. The project showcases chocolate products, offers online courses, and provides contact functionality. The site features a custom brand design with liquid/fluid visual effects following a specific brand manual.

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

# Rollback
php artisan migrate:rollback
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
- `resources/views/home.blade.php` - One-page design with all sections
- Additional views: `productos.blade.php`, `cursos.blade.php`, `galeria.blade.php`, `contacto.blade.php`

**JavaScript Assets:**
- `public/js/animations.js` - Brand-specific animations referenced in layout
- Inline scripts for interactive components (modal, carousel, menu toggle)

**Styling Approach:**
- Tailwind CSS 4 utility-first classes as primary styling method
- Inline `<style>` blocks for component-specific animations and brand colors
- CSS custom properties in `:root` for brand consistency
- Responsive design with Tailwind breakpoints (sm, md, lg)

### Backend Structure

**Routes (`routes/web.php`):**
All routes currently use closures (no controllers):
- `GET /` → `home` view (route name: `home`)
- `GET /productos` → `productos` view (route name: `productos`)
- `GET /cursos` → `cursos` view (route name: `cursos`)
- `GET /galeria` → `galeria` view (route name: `galeria`)
- `GET /contacto` → `contacto` view (route name: `contacto`)
- `POST /contacto` → Basic redirect (route name: `contacto.store`) - **TODO: needs implementation**

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

## Environment Setup

Required `.env` configuration:
```env
APP_NAME=Chocoart
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=chocoart
DB_USERNAME=root
DB_PASSWORD=
```

## XAMPP/Local Development

This project runs in XAMPP environment:
- Web root: `c:\xampp1\htdocs\chocoart`
- Access via: `http://localhost/chocoart/public`
- Ensure Apache and MySQL are running

## Important Implementation Notes

### Interactive Components

**Product Modal with Carousel:**
- Located in `home.blade.php` products section
- Triggered by `.open-modal` buttons with `data-*` attributes
- Carousel supports touch/swipe on mobile
- Images array passed via `data-images` JSON attribute
- Modal styling uses gradient card (`card-choco-rose` class)

**SVG Patterns:**
- Wave dividers: Use `<path>` with curves for organic section transitions
- Text rings: Circular `<textPath>` with rotating animation
- Decorative frames: Organic blob shapes using SVG paths

### Asset References

Use Laravel asset helpers for all resources:
- Images: `{{ asset('images/filename.png') }}`
- Videos: `{{ asset('videos/filename.mp4') }}`
- JavaScript: `{{ asset('js/filename.js') }}`
- Routes: `{{ route('route.name') }}`

## Brand Consistency Checklist

When adding features, verify:
- [ ] Uses brand color hex values or CSS custom properties
- [ ] Typography follows Poppins/Dancing Script/Quicksand pattern
- [ ] Includes liquid/organic shape elements where appropriate (SVG waves, rounded shapes)
- [ ] Maintains visual consistency with existing sections
- [ ] Responsive across breakpoints (mobile-first approach)
- [ ] Smooth animations using Tailwind transitions or custom `@keyframes`
- [ ] Accessibility: proper ARIA labels, keyboard navigation, semantic HTML
