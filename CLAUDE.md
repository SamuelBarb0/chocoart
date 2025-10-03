# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Chocoart is a Laravel 12 web application for an artisanal chocolate business. The project showcases chocolate products, offers online courses, and provides contact functionality. The site features a custom brand design with liquid/fluid visual effects following a specific brand manual.

## Brand Identity (Critical)

All design work MUST follow the brand manual specifications:

**Colors (defined in CSS variables):**
- Pink: `#e28dc4` - Primary brand color
- Aqua: `#81cacf` - Secondary brand color
- Lime: `#c6d379` - Accent color
- Chocolate: `#5f3917` - Text and dark elements

**Typography:**
- Primary: Poppins (headings, body)
- Script: Dancing Script (decorative, slogan)
- Secondary: Quicksand (supporting text)

**Visual Style:**
- "Liquid" design with organic, flowing shapes
- Animated morphing blob backgrounds
- Gradient combinations of brand colors

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

**Blade Templates:**
- `resources/views/layouts/app.blade.php` - Master layout with navigation, footer, and asset includes
- `resources/views/home.blade.php` - Homepage extending master layout

**Assets:**
- `public/css/style.css` - All styles with CSS variables for brand colors
- `public/js/script.js` - Interactions including:
  - Mobile menu toggle
  - Smooth scrolling
  - Intersection Observer animations
  - Form handling with success messages
  - Parallax effects for liquid shapes
  - Product card 3D tilt effects
  - Gallery lightbox

**Key CSS Patterns:**
- Liquid shape animations use `@keyframes morph` with organic border-radius transitions
- Brand colors accessed via CSS custom properties (`var(--color-pink)`, etc.)
- Responsive breakpoints: 1024px, 768px, 480px
- Mobile-first grid layouts with `grid-template-columns: repeat(auto-fit, minmax(...))`

### Backend Structure

**Routes (`routes/web.php`):**
- `GET /` - Homepage (renders `home` view)
- `POST /contacto` - Contact form submission (currently basic redirect, needs implementation)

**Views Pattern:**
```blade
@extends('layouts.app')
@section('title', 'Page Title')
@section('content')
    <!-- Page content -->
@endsection
```

### Contact Form Implementation Notes

The contact form currently redirects back with a success message but doesn't process data. To implement:

1. Create a controller: `php artisan make:controller ContactController`
2. Add validation and email sending logic
3. Update route to use controller method
4. Configure mail settings in `.env`

## Development Workflow

### Adding New Pages

1. Create Blade view in `resources/views/`
2. Extend `layouts.app` layout
3. Add route in `routes/web.php`
4. Use brand colors and existing CSS patterns

### Styling Guidelines

- Always use CSS custom properties for brand colors (never hardcode hex values outside `:root`)
- Maintain liquid/organic design aesthetic with flowing shapes
- Use gradients combining 2-3 brand colors
- Add smooth transitions (`var(--transition)`)
- Ensure mobile responsiveness

### JavaScript Patterns

- Event delegation for dynamic content
- Intersection Observer for scroll animations
- Form submissions include CSRF token (`@csrf`)
- Success messages use inline styles with brand gradients

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

## Brand Consistency Checklist

When adding features, verify:
- [ ] Uses defined brand colors from CSS variables
- [ ] Typography follows Poppins/Dancing Script/Quicksand pattern
- [ ] Includes liquid/organic shape elements where appropriate
- [ ] Maintains visual consistency with existing sections
- [ ] Responsive across breakpoints
- [ ] Smooth animations using defined transitions
