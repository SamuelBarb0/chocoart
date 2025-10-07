@extends('layouts.app')

@section('title', 'Chocoart - Arte con chocolate | Inicio')

@section('content')

<!-- Hero Video Background Section -->
<section id="inicio" class="relative h-screen min-h-[600px] max-h-[900px] overflow-hidden">
    <!-- Background -->
    <div class="absolute inset-0 z-0">
        <!-- Gradient Background con imagen de chocolate -->
        <div class="absolute inset-0 bg-gradient-to-br from-[#3d2817] via-[#5f3917] to-[#3d2817]">
            <!-- Imagen de fondo de chocolate -->
            <div class="absolute inset-0 opacity-30 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1511381939415-e44015466834?w=1920&q=80');"></div>

            <!-- Pattern overlay -->
            <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>

        <!-- Overlay oscuro con gradiente -->
        <div class="absolute inset-0 bg-gradient-to-br from-black/50 via-transparent to-black/30"></div>
    </div>

    <!-- Hero Content -->
    <div class="relative z-10 h-full flex items-center">
        <div class="container-choco">
            <div class="max-w-4xl mx-auto text-center">
                <!-- Badge -->
                <div class="mb-6 animate-fade-down">
                    <span class="inline-block px-6 py-2 bg-white/10 backdrop-blur-md text-white border border-white/20 rounded-full text-sm font-semibold">
                        ✨ Artesanía en cada bocado
                    </span>
                </div>

                <!-- Main Title -->
                <h1 class="mb-6 animate-fade-up anim-delay-100">
                    <span class="block font-['Dancing_Script'] text-4xl md:text-5xl lg:text-6xl text-[#e28dc4] mb-3 drop-shadow-lg">
                        El Arte del Chocolate
                    </span>
                    <img src="{{ asset('images/LC_10Logo ChocoArt.png') }}" alt="Chocoart" class="w-auto h-30 md:h-28 lg:h-32 mx-auto drop-shadow-2xl">
                </h1>

                <!-- Description -->
                <p class="text-lg md:text-xl lg:text-2xl text-white/90 mb-10 max-w-2xl mx-auto leading-relaxed animate-fade-up anim-delay-200 drop-shadow-lg">
                    Descubre el mundo mágico del chocolate artesanal. Creaciones únicas que despiertan tus sentidos.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-fade-up anim-delay-300">
                    <a href="#productos" class="group px-8 py-4 bg-white text-[#5f3917] rounded-full font-semibold hover:bg-[#e28dc4] hover:text-white transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl inline-flex items-center gap-2">
                        Explorar Productos
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                    <a href="#cursos" class="px-8 py-4 bg-transparent text-white border-2 border-white rounded-full font-semibold hover:bg-white hover:text-[#5f3917] transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl">
                        Ver Cursos
                    </a>
                </div>

                <!-- Stats -->
                <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8 animate-fade-up anim-delay-400">
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-white mb-1">10+</div>
                        <div class="text-sm md:text-base text-white/80">Años de Experiencia</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-white mb-1">500+</div>
                        <div class="text-sm md:text-base text-white/80">Clientes Felices</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-white mb-1">50+</div>
                        <div class="text-sm md:text-base text-white/80">Productos Únicos</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-white mb-1">100%</div>
                        <div class="text-sm md:text-base text-white/80">Artesanal</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 animate-bounce">
        <a href="#productos" class="block text-white/80 hover:text-white transition-colors">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </a>
    </div>


</section>

<!-- Features Section -->
<section class="py-12 md:py-16 bg-white">
    <div class="container-choco">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center group">
                <div class="w-16 h-16 mx-auto mb-4 bg-[#e28dc4] rounded-full flex items-center justify-center text-white group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                        <path d="M2 17l10 5 10-5M2 12l10 5 10-5"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">100% Artesanal</h3>
                <p class="text-gray-600">Cada pieza es elaborada con dedicación y amor por el chocolate</p>
            </div>
            <div class="text-center group">
                <div class="w-16 h-16 mx-auto mb-4 bg-[#81cacf] rounded-full flex items-center justify-center text-white group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M12 6v6l4 2"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Ingredientes Premium</h3>
                <p class="text-gray-600">Usamos solo los mejores ingredientes para nuestras creaciones</p>
            </div>
            <div class="text-center group">
                <div class="w-16 h-16 mx-auto mb-4 bg-[#c6d379] rounded-full flex items-center justify-center text-white group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Cursos Especializados</h3>
                <p class="text-gray-600">Aprende las técnicas profesionales de la chocolatería</p>
            </div>
        </div>
    </div>
</section>

<!-- Popular Products Section -->
<section id="productos" class="py-16 md:py-20 bg-gradient-to-b from-pink-50 to-white relative">
    <div class="container-choco">
        <div class="text-center mb-12">
            <h2 class="font-['Dancing_Script'] text-3xl md:text-4xl lg:text-5xl text-[#e28dc4] mb-3">
                I Most Popular Cupcakes I
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                El secreto para hacer el mejor cupcake de chocolate perfectamente húmedo con glaseado
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-12">
            <!-- Product 1 -->
            <div class="text-center group">
                <div class="relative mb-6">
                    <span class="absolute -top-2 left-1/2 -translate-x-1/2 z-10 px-3 py-1 bg-[#c6d379] text-white text-xs font-bold rounded-full">NEW</span>
                    <div class="w-48 h-48 mx-auto bg-gradient-to-br from-[#81cacf] to-[#a0dade] rounded-full shadow-xl group-hover:-translate-y-3 transition-all duration-300 group-hover:shadow-2xl"></div>
                </div>
                <h3 class="text-xl font-semibold text-[#5f3917] mb-2">Mint Cupcake</h3>
                <p class="text-gray-600 text-sm mb-3">Best Flavor your taste mint</p>
                <span class="text-2xl font-bold text-[#e28dc4]">$12.00</span>
            </div>

            <!-- Product 2 -->
            <div class="text-center group">
                <div class="relative mb-6">
                    <span class="absolute -top-2 left-1/2 -translate-x-1/2 z-10 px-3 py-1 bg-red-600 text-white text-xs font-bold rounded-full">BEST</span>
                    <div class="w-48 h-48 mx-auto bg-gradient-to-br from-red-400 to-pink-400 rounded-full shadow-xl group-hover:-translate-y-3 transition-all duration-300 group-hover:shadow-2xl"></div>
                </div>
                <h3 class="text-xl font-semibold text-[#5f3917] mb-2">Red Velvet</h3>
                <p class="text-gray-600 text-sm mb-3">Best ever deep red velvet chocolate cake</p>
                <span class="text-2xl font-bold text-[#e28dc4]">$15.00</span>
            </div>

            <!-- Product 3 -->
            <div class="text-center group">
                <div class="relative mb-6">
                    <span class="absolute -top-2 left-1/2 -translate-x-1/2 z-10 px-3 py-1 bg-[#c6d379] text-white text-xs font-bold rounded-full">NEW</span>
                    <div class="w-48 h-48 mx-auto bg-gradient-to-br from-yellow-300 to-yellow-400 rounded-full shadow-xl group-hover:-translate-y-3 transition-all duration-300 group-hover:shadow-2xl"></div>
                </div>
                <h3 class="text-xl font-semibold text-[#5f3917] mb-2">Mango Yogurt Cupcake</h3>
                <p class="text-gray-600 text-sm mb-3">Delicious Mango Yogurt Cupcake</p>
                <span class="text-2xl font-bold text-[#e28dc4]">$13.00</span>
            </div>

            <!-- Product 4 -->
            <div class="text-center group">
                <div class="relative mb-6">
                    <span class="absolute -top-2 left-1/2 -translate-x-1/2 z-10 px-3 py-1 bg-[#e28dc4] text-white text-xs font-bold rounded-full">SALE</span>
                    <div class="w-48 h-48 mx-auto bg-gradient-to-br from-[#81cacf] to-[#e28dc4] rounded-full shadow-xl group-hover:-translate-y-3 transition-all duration-300 group-hover:shadow-2xl"></div>
                </div>
                <h3 class="text-xl font-semibold text-[#5f3917] mb-2">Mint Chocolate</h3>
                <p class="text-gray-600 text-sm mb-3">Best ever Mint Chocolate cake</p>
                <span class="text-2xl font-bold text-[#e28dc4]">$10.00</span>
            </div>

            <!-- Product 5 -->
            <div class="text-center group">
                <div class="relative mb-6">
                    <span class="absolute -top-2 left-1/2 -translate-x-1/2 z-10 px-3 py-1 bg-red-600 text-white text-xs font-bold rounded-full">HOT</span>
                    <div class="w-48 h-48 mx-auto bg-gradient-to-br from-[#e28dc4] to-pink-200 rounded-full shadow-xl group-hover:-translate-y-3 transition-all duration-300 group-hover:shadow-2xl"></div>
                </div>
                <h3 class="text-xl font-semibold text-[#5f3917] mb-2">Raspberry Cupcake</h3>
                <p class="text-gray-600 text-sm mb-3">Raspberry with dark chocolate</p>
                <span class="text-2xl font-bold text-[#e28dc4]">$14.00</span>
            </div>

            <!-- Product 6 -->
            <div class="text-center group">
                <div class="relative mb-6">
                    <span class="absolute -top-2 left-1/2 -translate-x-1/2 z-10 px-3 py-1 bg-[#e28dc4] text-white text-xs font-bold rounded-full">SALE</span>
                    <div class="w-48 h-48 mx-auto bg-gradient-to-br from-[#5f3917] to-yellow-900 rounded-full shadow-xl group-hover:-translate-y-3 transition-all duration-300 group-hover:shadow-2xl"></div>
                </div>
                <h3 class="text-xl font-semibold text-[#5f3917] mb-2">Dark Chocolate</h3>
                <p class="text-gray-600 text-sm mb-3">Lovely dark cake with dark chocolate</p>
                <span class="text-2xl font-bold text-[#e28dc4]">$12.00</span>
            </div>
        </div>

    </div>

    <!-- Wave Divider Bottom -->
    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none rotate-180">
        <svg class="relative block w-full h-16" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="white"></path>
        </svg>
    </div>
</section>

<!-- Specialties Section -->
<section class="py-16 md:py-20 bg-white">
    <div class="container-choco">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-[#5f3917] mb-3">Our Specialties</h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center group">
                <div class="w-32 h-32 md:w-36 md:h-36 mx-auto mb-4 bg-gradient-to-br from-[#e28dc4] to-pink-200 rounded-full shadow-lg group-hover:scale-105 transition-transform duration-300"></div>
                <h3 class="text-lg font-semibold text-[#5f3917] mb-1">Occasion Cakes</h3>
                <p class="text-sm text-gray-600">Delicious sweet cakes for your special day</p>
            </div>

            <div class="text-center group">
                <div class="w-32 h-32 md:w-36 md:h-36 mx-auto mb-4 bg-gradient-to-br from-[#81cacf] to-blue-200 rounded-full shadow-lg group-hover:scale-105 transition-transform duration-300"></div>
                <h3 class="text-lg font-semibold text-[#5f3917] mb-1">Cupcakes</h3>
                <p class="text-sm text-gray-600">Freshly baked mini delights</p>
            </div>

            <div class="text-center group">
                <div class="w-32 h-32 md:w-36 md:h-36 mx-auto mb-4 bg-gradient-to-br from-[#c6d379] to-lime-200 rounded-full shadow-lg group-hover:scale-105 transition-transform duration-300"></div>
                <h3 class="text-lg font-semibold text-[#5f3917] mb-1">Macaroons</h3>
                <p class="text-sm text-gray-600">French style colorful treats</p>
            </div>

            <div class="text-center group">
                <div class="w-32 h-32 md:w-36 md:h-36 mx-auto mb-4 bg-gradient-to-br from-orange-200 to-orange-300 rounded-full shadow-lg group-hover:scale-105 transition-transform duration-300"></div>
                <h3 class="text-lg font-semibold text-[#5f3917] mb-1">Small Cakes</h3>
                <p class="text-sm text-gray-600">Perfect individual portions</p>
            </div>
        </div>
    </div>
</section>

<!-- Courses Section -->
<section id="cursos" class="py-16 md:py-20 bg-gradient-to-b from-white to-pink-50">
    <div class="container-choco">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-[#5f3917] mb-3">Academia Chocoart</h2>
            <p class="text-gray-600">Aprende el arte de la chocolatería profesional</p>
        </div>

        <div class="grid lg:grid-cols-2 gap-8 items-center max-w-5xl mx-auto">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="h-48 bg-gradient-to-br from-[#e28dc4] to-[#81cacf]"></div>
                <div class="p-8">
                    <span class="inline-block px-4 py-1 bg-[#e28dc4] text-white text-sm font-semibold rounded-full mb-4">Más Popular</span>
                    <h3 class="text-2xl font-bold text-[#5f3917] mb-4">Curso Básico de Chocolatería</h3>
                    <p class="text-gray-600 mb-6">
                        Descubre los fundamentos de la chocolatería artesanal. Aprende sobre temperado, moldeo, y creación de bombones básicos.
                    </p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center text-gray-700">
                            <svg class="w-5 h-5 text-[#c6d379] mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            8 horas de instrucción
                        </li>
                        <li class="flex items-center text-gray-700">
                            <svg class="w-5 h-5 text-[#c6d379] mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Materiales incluidos
                        </li>
                        <li class="flex items-center text-gray-700">
                            <svg class="w-5 h-5 text-[#c6d379] mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Certificado de finalización
                        </li>
                        <li class="flex items-center text-gray-700">
                            <svg class="w-5 h-5 text-[#c6d379] mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Grupo reducido (máx. 8 personas)
                        </li>
                    </ul>
                    <a href="#contacto" class="block w-full text-center px-6 py-3 bg-[#5f3917] text-white rounded-full font-semibold hover:bg-[#e28dc4] transition-colors duration-300">
                        Inscribirse ahora
                    </a>
                </div>
            </div>

            <div class="space-y-4">
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 border-l-4 border-[#e28dc4]">
                    <h4 class="text-xl font-semibold text-[#5f3917] mb-2">Curso Avanzado</h4>
                    <p class="text-gray-600">Técnicas profesionales y decoración avanzada</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 border-l-4 border-[#81cacf]">
                    <h4 class="text-xl font-semibold text-[#5f3917] mb-2">Chocolatería para Empresas</h4>
                    <p class="text-gray-600">Aprende a crear tu negocio de chocolate</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 border-l-4 border-[#c6d379]">
                    <h4 class="text-xl font-semibold text-[#5f3917] mb-2">Masterclass de Bombones</h4>
                    <p class="text-gray-600">Especialízate en bombones rellenos gourmet</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section id="galeria" class="py-16 md:py-20 bg-pink-50 relative">
    <div class="container-choco">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-[#5f3917] mb-3">Galería de Creaciones</h2>
            <p class="text-gray-600">Un vistazo a nuestras obras de arte comestibles</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            <div class="gallery-item relative group overflow-hidden rounded-2xl shadow-lg col-span-2 md:col-span-2 md:row-span-2 h-64 md:h-96 cursor-pointer">
                <div class="absolute inset-0 bg-gradient-to-br from-[#e28dc4] to-[#81cacf]"></div>
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <h4 class="text-white text-2xl font-semibold">Evento Corporativo</h4>
                </div>
            </div>
            <div class="gallery-item relative group overflow-hidden rounded-2xl shadow-lg h-32 md:h-44 cursor-pointer">
                <div class="absolute inset-0 bg-gradient-to-br from-[#c6d379] to-[#e28dc4]"></div>
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <h4 class="text-white text-lg font-semibold">Bombones Premium</h4>
                </div>
            </div>
            <div class="gallery-item relative group overflow-hidden rounded-2xl shadow-lg h-32 md:h-44 cursor-pointer">
                <div class="absolute inset-0 bg-gradient-to-br from-[#81cacf] to-[#c6d379]"></div>
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <h4 class="text-white text-lg font-semibold">Tabletas Artesanales</h4>
                </div>
            </div>
            <div class="gallery-item relative group overflow-hidden rounded-2xl shadow-lg h-32 md:h-44 cursor-pointer">
                <div class="absolute inset-0 bg-gradient-to-br from-[#5f3917] to-[#e28dc4]"></div>
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <h4 class="text-white text-lg font-semibold">Figuras Decorativas</h4>
                </div>
            </div>
            <div class="gallery-item relative group overflow-hidden rounded-2xl shadow-lg col-span-2 h-32 md:h-44 cursor-pointer">
                <div class="absolute inset-0 bg-gradient-to-br from-[#e28dc4] to-[#c6d379]"></div>
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <h4 class="text-white text-xl font-semibold">Workshop {{ date('Y') }}</h4>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="py-16 md:py-20 bg-white">
    <div class="container-choco">
        <div class="grid lg:grid-cols-2 gap-12 items-center max-w-6xl mx-auto">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-[#5f3917] mb-6">Nuestra Historia</h2>
                <p class="text-xl text-gray-700 mb-4 font-medium">
                    En Chocoart, transformamos el chocolate en verdaderas obras de arte.
                </p>
                <p class="text-gray-600 mb-4">
                    Cada pieza que creamos es el resultado de años de pasión, dedicación y perfeccionamiento de técnicas artesanales. Creemos que el chocolate es más que un simple dulce: es una experiencia sensorial que conecta emociones y crea momentos memorables.
                </p>
                <p class="text-gray-600">
                    Nuestro compromiso es utilizar solo ingredientes premium, trabajar con chocolate de origen sostenible y compartir nuestro conocimiento a través de nuestra academia.
                </p>
            </div>
            <div class="relative h-64 md:h-96 bg-gradient-to-br from-[#e28dc4] via-[#81cacf] to-[#c6d379] rounded-2xl shadow-2xl"></div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contacto" class="py-16 md:py-20 bg-gradient-to-b from-white to-pink-50">
    <div class="container-choco">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-[#5f3917] mb-3">Contáctanos</h2>
            <p class="text-gray-600">Estamos aquí para endulzar tu día</p>
        </div>

        <div class="grid lg:grid-cols-2 gap-12 max-w-6xl mx-auto">
            <div class="space-y-6">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-[#e28dc4] rounded-full flex items-center justify-center text-white flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-[#5f3917] mb-1">Ubicación</h4>
                        <p class="text-gray-600">Bogotá, Colombia</p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-[#81cacf] rounded-full flex items-center justify-center text-white flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-[#5f3917] mb-1">Teléfono</h4>
                        <p class="text-gray-600">+57 300 123 4567</p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-[#c6d379] rounded-full flex items-center justify-center text-white flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-[#5f3917] mb-1">Email</h4>
                        <p class="text-gray-600">info@chocoart.com.co</p>
                    </div>
                </div>
            </div>

            <form class="bg-white p-8 rounded-2xl shadow-xl" method="POST" action="{{ url('/contacto') }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <input type="text" name="nombre" placeholder="Tu nombre" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#e28dc4] focus:border-transparent outline-none transition-all">
                    </div>
                    <div>
                        <input type="email" name="email" placeholder="Tu email" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#e28dc4] focus:border-transparent outline-none transition-all">
                    </div>
                    <div>
                        <input type="tel" name="telefono" placeholder="Teléfono"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#e28dc4] focus:border-transparent outline-none transition-all">
                    </div>
                    <div>
                        <textarea name="mensaje" placeholder="Mensaje" rows="5" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#e28dc4] focus:border-transparent outline-none transition-all resize-none"></textarea>
                    </div>
                    <button type="submit" class="w-full px-6 py-3 bg-[#5f3917] text-white rounded-full font-semibold hover:bg-[#e28dc4] transition-colors duration-300">
                        Enviar Mensaje
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script src="{{ asset('js/script.js') }}"></script>
@endpush
