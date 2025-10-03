@extends('layouts.app')

@section('title', 'Chocoart - Arte con chocolate | Inicio')

@section('content')

<!-- Hero Section -->
<section id="inicio" class="hero">

    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">
                <span class="title-main">Chocoart</span>
                <span class="title-slogan">Arte con chocolate</span>
            </h1>
            <p class="hero-description">
                Descubre el mundo mágico del chocolate artesanal.
                Creaciones únicas que despiertan tus sentidos.
            </p>
            <div class="hero-buttons">
                <a href="#productos" class="btn btn-primary">Ver Productos</a>
                <a href="#cursos" class="btn btn-secondary">Nuestros Cursos</a>
            </div>
        </div>
        <div class="hero-image">
            <div class="hero-logo-container">
                <img src="{{ asset('images/PRINCIPAL EXTENDIDO.png') }}" alt="Chocoart Logo" class="hero-logo">
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features">
    <div class="container">
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon" style="background: #e28dc4;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                        <path d="M2 17l10 5 10-5M2 12l10 5 10-5"></path>
                    </svg>
                </div>
                <h3>100% Artesanal</h3>
                <p>Cada pieza es elaborada con dedicación y amor por el chocolate</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="background: #81cacf;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M12 6v6l4 2"></path>
                    </svg>
                </div>
                <h3>Ingredientes Premium</h3>
                <p>Usamos solo los mejores ingredientes para nuestras creaciones</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="background: #c6d379;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
                <h3>Cursos Especializados</h3>
                <p>Aprende las técnicas profesionales de la chocolatería</p>
            </div>
        </div>
    </div>
</section>

<!-- Products Section -->
<section id="productos" class="products">
    <div class="liquid-bg "></div>
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Nuestros Productos</h2>
            <p class="section-subtitle">Delicias artesanales que cautivan</p>
        </div>
        <div class="products-grid">
            <div class="product-card">
                <div class="product-image">
                    <div class="product-placeholder" style="background: linear-gradient(135deg, #e28dc4, #e0a6d1);"></div>
                </div>
                <div class="product-info">
                    <h3>Bombones Artesanales</h3>
                    <p>Exquisitos bombones rellenos con sabores únicos</p>
                    <a href="#contacto" class="product-link">Ver más →</a>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <div class="product-placeholder" style="background: linear-gradient(135deg, #81cacf, #a0dade);"></div>
                </div>
                <div class="product-info">
                    <h3>Tabletas Premium</h3>
                    <p>Chocolate de origen único con porcentajes variados</p>
                    <a href="#contacto" class="product-link">Ver más →</a>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <div class="product-placeholder" style="background: linear-gradient(135deg, #c6d379, #d4df98);"></div>
                </div>
                <div class="product-info">
                    <h3>Figuras Decorativas</h3>
                    <p>Arte comestible para ocasiones especiales</p>
                    <a href="#contacto" class="product-link">Ver más →</a>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <div class="product-placeholder" style="background: linear-gradient(135deg, #5f3917, #8b4513);"></div>
                </div>
                <div class="product-info">
                    <h3>Trufas Gourmet</h3>
                    <p>Suaves trufas con texturas cremosas y sabores intensos</p>
                    <a href="#contacto" class="product-link">Ver más →</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Courses Section -->
<section id="cursos" class="courses">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Academia Chocoart</h2>
            <p class="section-subtitle">Aprende el arte de la chocolatería profesional</p>
        </div>
        <div class="courses-container">
            <div class="course-featured">
                <div class="course-image">
                    <div class="course-placeholder"></div>
                </div>
                <div class="course-content">
                    <span class="course-tag">Más Popular</span>
                    <h3>Curso Básico de Chocolatería</h3>
                    <p>Descubre los fundamentos de la chocolatería artesanal. Aprende sobre temperado, moldeo, y creación de bombones básicos.</p>
                    <ul class="course-features">
                        <li>✓ 8 horas de instrucción</li>
                        <li>✓ Materiales incluidos</li>
                        <li>✓ Certificado de finalización</li>
                        <li>✓ Grupo reducido (máx. 8 personas)</li>
                    </ul>
                    <a href="#contacto" class="btn btn-primary">Inscribirse ahora</a>
                </div>
            </div>
            <div class="courses-list">
                <div class="course-item">
                    <h4>Curso Avanzado</h4>
                    <p>Técnicas profesionales y decoración avanzada</p>
                </div>
                <div class="course-item">
                    <h4>Chocolatería para Empresas</h4>
                    <p>Aprende a crear tu negocio de chocolate</p>
                </div>
                <div class="course-item">
                    <h4>Masterclass de Bombones</h4>
                    <p>Especialízate en bombones rellenos gourmet</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section id="galeria" class="gallery">
    <div class="liquid-bg "></div>
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Galería de Creaciones</h2>
            <p class="section-subtitle">Un vistazo a nuestras obras de arte comestibles</p>
        </div>
        <div class="gallery-grid">
            <div class="gallery-item gallery-item-large">
                <div class="gallery-placeholder" style="background: linear-gradient(135deg, #e28dc4 0%, #81cacf 100%);"></div>
                <div class="gallery-overlay">
                    <h4>Evento Corporativo</h4>
                </div>
            </div>
            <div class="gallery-item">
                <div class="gallery-placeholder" style="background: linear-gradient(135deg, #c6d379 0%, #e28dc4 100%);"></div>
                <div class="gallery-overlay">
                    <h4>Bombones Premium</h4>
                </div>
            </div>
            <div class="gallery-item">
                <div class="gallery-placeholder" style="background: linear-gradient(135deg, #81cacf 0%, #c6d379 100%);"></div>
                <div class="gallery-overlay">
                    <h4>Tabletas Artesanales</h4>
                </div>
            </div>
            <div class="gallery-item">
                <div class="gallery-placeholder" style="background: linear-gradient(135deg, #5f3917 0%, #e28dc4 100%);"></div>
                <div class="gallery-overlay">
                    <h4>Figuras Decorativas</h4>
                </div>
            </div>
            <div class="gallery-item gallery-item-wide">
                <div class="gallery-placeholder" style="background: linear-gradient(135deg, #e28dc4 0%, #c6d379 100%);"></div>
                <div class="gallery-overlay">
                    <h4>Workshop {{ date('Y') }}</h4>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about">
    <div class="container">
        <div class="about-content">
            <div class="about-text">
                <h2>Nuestra Historia</h2>
                <p class="lead">En Chocoart, transformamos el chocolate en verdaderas obras de arte.</p>
                <p>Cada pieza que creamos es el resultado de años de pasión, dedicación y perfeccionamiento de técnicas artesanales. Creemos que el chocolate es más que un simple dulce: es una experiencia sensorial que conecta emociones y crea momentos memorables.</p>
                <p>Nuestro compromiso es utilizar solo ingredientes premium, trabajar con chocolate de origen sostenible y compartir nuestro conocimiento a través de nuestra academia.</p>
            </div>
            <div class="about-image">
                <div class="about-placeholder">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contacto" class="contact">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Contáctanos</h2>
            <p class="section-subtitle">Estamos aquí para endulzar tu día</p>
        </div>
        <div class="contact-wrapper">
            <div class="contact-info">
                <div class="contact-item">
                    <div class="contact-icon" style="background: #e28dc4;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                    </div>
                    <div>
                        <h4>Ubicación</h4>
                        <p>Bogotá, Colombia</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-icon" style="background: #81cacf;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4>Teléfono</h4>
                        <p>+57 300 123 4567</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-icon" style="background: #c6d379;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                    </div>
                    <div>
                        <h4>Email</h4>
                        <p>info@chocoart.com.co</p>
                    </div>
                </div>
            </div>
            <form class="contact-form" method="POST" action="{{ url('/contacto') }}">
                @csrf
                <div class="form-group">
                    <input type="text" name="nombre" placeholder="Tu nombre" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="Tu email" required>
                </div>
                <div class="form-group">
                    <input type="tel" name="telefono" placeholder="Teléfono">
                </div>
                <div class="form-group">
                    <textarea name="mensaje" placeholder="Mensaje" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Enviar Mensaje</button>
            </form>
        </div>
    </div>
</section>

@endsection
