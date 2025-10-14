@extends('layouts.app')

@section('title', 'Contacto - Chocoart')

@section('content')

<!-- Hero Contacto -->
<section class="relative overflow-hidden bg-gradient-to-br from-[#3d2817] via-[#5f3917] to-[#3d2817] py-24">
  <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Ccircle cx=\'30\' cy=\'30\' r=\'2\'/%3E%3C/g%3E%3C/svg%3E');"></div>

  <div class="container-choco relative z-10">
    <div class="text-center max-w-4xl mx-auto">
      <h1 class="font-['Dancing_Script'] text-5xl md:text-6xl lg:text-7xl text-[#e28dc4] mb-4 drop-shadow-lg">
        Contáctanos
      </h1>
      <p class="text-lg md:text-xl text-white/90 mb-8">
        Hablemos sobre tu próxima dulce experiencia
      </p>
    </div>
  </div>

  <!-- Wave Divider Bottom - Mobile (sutiles) -->
  <div class="lg:hidden absolute -bottom-1 left-0 w-full z-10 overflow-hidden">
    <svg class="w-full h-20 md:h-24" viewBox="0 0 1200 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M0,60 Q50,20 100,60 T200,60 T300,60 T400,60 T500,60 T600,60 T700,60 T800,60 T900,60 T1000,60 T1100,60 T1200,60 L1200,120 L0,120 Z" fill="white"/>
    </svg>
  </div>

  <!-- Wave Divider Bottom - Desktop (pronunciadas) -->
  <div class="hidden lg:block absolute -bottom-1 left-0 w-full z-10 overflow-hidden">
    <svg class="w-full h-16 md:h-20" viewBox="0 0 1200 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M0,30 Q15,0 30,30 T60,30 T90,30 T120,30 T150,30 T180,30 T210,30 T240,30 T270,30 T300,30 T330,30 T360,30 T390,30 T420,30 T450,30 T480,30 T510,30 T540,30 T570,30 T600,30 T630,30 T660,30 T690,30 T720,30 T750,30 T780,30 T810,30 T840,30 T870,30 T900,30 T930,30 T960,30 T990,30 T1020,30 T1050,30 T1080,30 T1110,30 T1140,30 T1170,30 T1200,30 L1200,60 L0,60 Z" fill="white"/>
    </svg>
  </div>
</section>

<!-- Contacto Section -->
<section class="py-20 bg-white relative">
  <style>
    :root{
      --rosa:#e28dc4;
      --menta:#81cacf;
      --pistacho:#c6d379;
      --choco:#5f3917;
    }

    @keyframes spin { to { transform: rotate(360deg); } }
    .text-ring{ animation: spin var(--ring-speed, 20s) linear infinite; transform-origin:50% 50%; will-change:transform; }

    .contact-capsule{ --base-scale:.90; transform: scale(var(--base-scale)); }
    .group:hover .contact-capsule{ transform: translateY(-0.5rem) scale(calc(var(--base-scale)*1.02)); }
    .group:hover .contact-emoji{ transform: scale(1.1); }
    .group:hover .contact-ring-wrap{ transform: scale(1.02); }
    .group:hover .text-ring{ animation-duration: 12s; }

    @media (prefers-reduced-motion: reduce){
      .text-ring{ animation:none!important; }
      .group:hover .contact-capsule, .group:hover .contact-emoji, .group:hover .contact-ring-wrap{ transform:none!important; }
    }

    /* Formulario estilo CHOCOART */
    .form-input{
      transition: all 0.3s ease;
    }
    .form-input:focus{
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(226, 141, 196, 0.2);
    }

    /* Mensaje de éxito */
    .success-message{
      background: linear-gradient(135deg, var(--pistacho) 0%, var(--menta) 100%);
      animation: slideDown 0.5s ease-out;
    }
    @keyframes slideDown {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>

  <div class="container-choco">
    <div class="grid lg:grid-cols-2 gap-12 max-w-6xl mx-auto items-start">

      <!-- Info Cards con Cápsulas -->
      <div class="space-y-8">
        <div class="text-center mb-8">
          <h2 class="font-['Dancing_Script'] text-3xl md:text-4xl text-[var(--choco)] mb-2">
            ¿Cómo contactarnos?
          </h2>
          <p class="text-gray-600">Estamos aquí para ayudarte</p>
        </div>

        <!-- Ubicación -->
        <div class="group relative">
          <div class="flex items-start gap-4">
            <div class="relative w-24 h-24 flex-shrink-0">
              <div class="absolute inset-0 rounded-full blur-xl" style="background: radial-gradient(circle, color-mix(in srgb, var(--rosa) 40%, white 0%) 0%, transparent 70%);"></div>

              <svg viewBox="0 0 200 200" class="contact-ring-wrap absolute inset-0 pointer-events-none transition-transform duration-300"
                   aria-hidden="true"
                   style="mask-image: radial-gradient(circle at 50% 50%, transparent 38%, black 40%); -webkit-mask-image: radial-gradient(circle at 50% 50%, transparent 38%, black 40%);">
                <defs><path id="circlePath-contact1" d="M100,100 m-80,0 a80,80 0 1,1 160,0 a80,80 0 1,1 -160,0"/></defs>
                <g class="text-ring">
                  <text font-size="12" font-weight="600" fill="var(--choco)" letter-spacing="2">
                    <textPath href="#circlePath-contact1">• CHOCOART • CHOCOART • CHOCOART •</textPath>
                  </text>
                </g>
              </svg>

              <div class="contact-capsule relative z-10 w-full h-full bg-gradient-to-br from-[color-mix(in_srgb,var(--rosa) 50%,white_0%)] to-[color-mix(in_srgb,var(--rosa) 10%,var(--choco) 90%)] rounded-full shadow-lg flex items-center justify-center transition-transform duration-500">
                <div class="contact-emoji text-3xl transition-transform duration-300">📍</div>
              </div>
            </div>

            <div class="flex-1 pt-2">
              <h3 class="text-xl font-semibold text-[var(--choco)] mb-2">Ubicación</h3>
              <p class="text-gray-600 leading-relaxed">{{ \App\Models\Setting::get('contact_address', 'Bogotá, Colombia') }}<br>
              <span class="text-sm text-gray-500">{{ \App\Models\Setting::get('contact_hours', 'Lun - Sáb: 9:00 AM - 6:00 PM') }}</span></p>
            </div>
          </div>
        </div>

        <!-- Teléfono/WhatsApp -->
        <div class="group relative">
          <div class="flex items-start gap-4">
            <div class="relative w-24 h-24 flex-shrink-0">
              <div class="absolute inset-0 rounded-full blur-xl" style="background: radial-gradient(circle, color-mix(in srgb, var(--menta) 40%, white 0%) 0%, transparent 70%);"></div>

              <svg viewBox="0 0 200 200" class="contact-ring-wrap absolute inset-0 pointer-events-none transition-transform duration-300"
                   aria-hidden="true"
                   style="mask-image: radial-gradient(circle at 50% 50%, transparent 38%, black 40%); -webkit-mask-image: radial-gradient(circle at 50% 50%, transparent 38%, black 40%);">
                <defs><path id="circlePath-contact2" d="M100,100 m-80,0 a80,80 0 1,1 160,0 a80,80 0 1,1 -160,0"/></defs>
                <g class="text-ring">
                  <text font-size="12" font-weight="600" fill="var(--choco)" letter-spacing="2">
                    <textPath href="#circlePath-contact2">• CHOCOART • CHOCOART • CHOCOART •</textPath>
                  </text>
                </g>
              </svg>

              <div class="contact-capsule relative z-10 w-full h-full bg-gradient-to-br from-[color-mix(in_srgb,var(--menta) 50%,white_0%)] to-[color-mix(in_srgb,var(--menta) 10%,var(--choco) 90%)] rounded-full shadow-lg flex items-center justify-center transition-transform duration-500">
                <div class="contact-emoji text-3xl transition-transform duration-300">📱</div>
              </div>
            </div>

            <div class="flex-1 pt-2">
              <h3 class="text-xl font-semibold text-[var(--choco)] mb-2">WhatsApp / Teléfono</h3>
              <p class="text-gray-600 leading-relaxed">
                <a href="https://wa.me/{{ \App\Models\Setting::get('contact_whatsapp', '573001234567') }}?text={{ urlencode(\App\Models\Setting::get('contact_whatsapp_message', 'Hola, me gustaría obtener más información')) }}" class="hover:text-[var(--menta)] transition-colors">{{ \App\Models\Setting::get('contact_phone', '+57 300 123 4567') }}</a><br>
                <span class="text-sm text-gray-500">{{ \App\Models\Setting::get('contact_hours', 'Lun - Sáb: 9:00 AM - 6:00 PM') }}</span>
              </p>
            </div>
          </div>
        </div>

        <!-- Email -->
        <div class="group relative">
          <div class="flex items-start gap-4">
            <div class="relative w-24 h-24 flex-shrink-0">
              <div class="absolute inset-0 rounded-full blur-xl" style="background: radial-gradient(circle, color-mix(in srgb, var(--pistacho) 40%, white 0%) 0%, transparent 70%);"></div>

              <svg viewBox="0 0 200 200" class="contact-ring-wrap absolute inset-0 pointer-events-none transition-transform duration-300"
                   aria-hidden="true"
                   style="mask-image: radial-gradient(circle at 50% 50%, transparent 38%, black 40%); -webkit-mask-image: radial-gradient(circle at 50% 50%, transparent 38%, black 40%);">
                <defs><path id="circlePath-contact3" d="M100,100 m-80,0 a80,80 0 1,1 160,0 a80,80 0 1,1 -160,0"/></defs>
                <g class="text-ring">
                  <text font-size="12" font-weight="600" fill="var(--choco)" letter-spacing="2">
                    <textPath href="#circlePath-contact3">• CHOCOART • CHOCOART • CHOCOART •</textPath>
                  </text>
                </g>
              </svg>

              <div class="contact-capsule relative z-10 w-full h-full bg-gradient-to-br from-[color-mix(in_srgb,var(--pistacho) 50%,white_0%)] to-[color-mix(in_srgb,var(--pistacho) 10%,var(--choco) 90%)] rounded-full shadow-lg flex items-center justify-center transition-transform duration-500">
                <div class="contact-emoji text-3xl transition-transform duration-300">✉️</div>
              </div>
            </div>

            <div class="flex-1 pt-2">
              <h3 class="text-xl font-semibold text-[var(--choco)] mb-2">Email</h3>
              <p class="text-gray-600 leading-relaxed">
                <a href="mailto:{{ \App\Models\Setting::get('contact_email', 'info@chocoart.com.co') }}" class="hover:text-[var(--pistacho)] transition-colors">{{ \App\Models\Setting::get('contact_email', 'info@chocoart.com.co') }}</a><br>
                <span class="text-sm text-gray-500">Respuesta en 24 horas</span>
              </p>
            </div>
          </div>
        </div>

        <!-- Redes Sociales -->
        <div class="pt-6 border-t-2 border-gray-100">
          <h3 class="text-lg font-semibold text-[var(--choco)] mb-4 text-center">Síguenos en redes</h3>
          <div class="flex justify-center gap-4">
            @if(\App\Models\Setting::get('social_facebook'))
            <a href="{{ \App\Models\Setting::get('social_facebook') }}" target="_blank" rel="noopener" class="w-12 h-12 rounded-full bg-gradient-to-br from-[var(--rosa)] to-pink-300 flex items-center justify-center text-white hover:scale-110 transition-transform shadow-md">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            </a>
            @endif
            @if(\App\Models\Setting::get('social_instagram'))
            <a href="{{ \App\Models\Setting::get('social_instagram') }}" target="_blank" rel="noopener" class="w-12 h-12 rounded-full bg-gradient-to-br from-[var(--menta)] to-blue-300 flex items-center justify-center text-white hover:scale-110 transition-transform shadow-md">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
            </a>
            @endif
            @if(\App\Models\Setting::get('contact_whatsapp'))
            <a href="https://wa.me/{{ \App\Models\Setting::get('contact_whatsapp', '573001234567') }}?text={{ urlencode(\App\Models\Setting::get('contact_whatsapp_message', 'Hola, me gustaría obtener más información')) }}" target="_blank" rel="noopener" class="w-12 h-12 rounded-full bg-gradient-to-br from-[#25D366] to-[#128C7E] flex items-center justify-center text-white hover:scale-110 transition-transform shadow-md">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
            </a>
            @endif
          </div>
        </div>
      </div>

      <!-- Formulario -->
      <div class="relative">
        <div class="bg-gradient-to-br from-pink-50 via-blue-50 to-lime-50 p-8 rounded-3xl shadow-2xl border-2 border-[var(--rosa)]">
          <h2 class="font-['Dancing_Script'] text-3xl text-[var(--choco)] mb-6 text-center">
            Envíanos un mensaje
          </h2>

          @if(session('success'))
          <div class="success-message mb-6 p-4 rounded-2xl text-white text-center">
            <p class="font-semibold">✓ {{ session('success') }}</p>
          </div>
          @endif

          <form method="POST" action="{{ route('contacto.store') }}" class="space-y-5">
            @csrf

            <div>
              <label class="block text-sm font-semibold text-[var(--choco)] mb-2">Nombre Completo *</label>
              <input type="text" name="nombre" required
                     class="form-input w-full px-4 py-3 border-2 border-white bg-white rounded-2xl focus:ring-2 focus:ring-[var(--rosa)] focus:border-transparent outline-none transition-all"
                     placeholder="Tu nombre">
            </div>

            <div>
              <label class="block text-sm font-semibold text-[var(--choco)] mb-2">Email *</label>
              <input type="email" name="email" required
                     class="form-input w-full px-4 py-3 border-2 border-white bg-white rounded-2xl focus:ring-2 focus:ring-[var(--rosa)] focus:border-transparent outline-none transition-all"
                     placeholder="tu@email.com">
            </div>

            <div>
              <label class="block text-sm font-semibold text-[var(--choco)] mb-2">Teléfono</label>
              <input type="tel" name="telefono"
                     class="form-input w-full px-4 py-3 border-2 border-white bg-white rounded-2xl focus:ring-2 focus:ring-[var(--rosa)] focus:border-transparent outline-none transition-all"
                     placeholder="+57 300 123 4567">
            </div>

            <div>
              <label class="block text-sm font-semibold text-[var(--choco)] mb-2">Asunto *</label>
              <select name="asunto" required
                      class="form-input w-full px-4 py-3 border-2 border-white bg-white rounded-2xl focus:ring-2 focus:ring-[var(--rosa)] focus:border-transparent outline-none transition-all">
                <option value="">Selecciona un asunto</option>
                <option value="productos">Información sobre productos</option>
                <option value="cursos">Información sobre cursos</option>
                <option value="pedido">Realizar un pedido</option>
                <option value="evento">Consulta para evento</option>
                <option value="otro">Otro</option>
              </select>
            </div>

            <div>
              <label class="block text-sm font-semibold text-[var(--choco)] mb-2">Mensaje *</label>
              <textarea name="mensaje" rows="5" required
                        class="form-input w-full px-4 py-3 border-2 border-white bg-white rounded-2xl focus:ring-2 focus:ring-[var(--rosa)] focus:border-transparent outline-none transition-all resize-none"
                        placeholder="Cuéntanos en qué podemos ayudarte..."></textarea>
            </div>

            <button type="submit" class="w-full px-6 py-4 bg-gradient-to-r from-[var(--rosa)] via-[var(--menta)] to-[var(--pistacho)] text-white rounded-full font-semibold hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 text-lg">
              Enviar Mensaje 💌
            </button>
          </form>
        </div>
      </div>

    </div>
  </div>
</section>

@endsection

@push('scripts')
<script src="{{ asset('js/animations.js') }}"></script>
@endpush
