@extends('layouts.app')

@section('title', 'Cursos - Chocoart')

@section('content')

<!-- Hero Cursos -->
<section class="relative overflow-hidden bg-gradient-to-br from-[#3d2817] via-[#5f3917] to-[#3d2817] py-24">
  <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Ccircle cx=\'30\' cy=\'30\' r=\'2\'/%3E%3C/g%3E%3C/svg%3E');"></div>

  <div class="container-choco relative z-10">
    <div class="text-center max-w-4xl mx-auto">
      <h1 class="font-['Dancing_Script'] text-5xl md:text-6xl lg:text-7xl text-[#81cacf] mb-4 drop-shadow-lg">
        Academia Chocoart
      </h1>
      <p class="text-lg md:text-xl text-white/90 mb-8">
        Aprende el arte de la chocolatería profesional con nuestros expertos
      </p>
    </div>
  </div>

  <!-- Wave Divider Bottom -->
  <div class="absolute -bottom-1 left-0 w-full z-10">
    <svg class="w-full h-16 md:h-20" viewBox="0 0 1200 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M0,30 Q15,0 30,30 T60,30 T90,30 T120,30 T150,30 T180,30 T210,30 T240,30 T270,30 T300,30 T330,30 T360,30 T390,30 T420,30 T450,30 T480,30 T510,30 T540,30 T570,30 T600,30 T630,30 T660,30 T690,30 T720,30 T750,30 T780,30 T810,30 T840,30 T870,30 T900,30 T930,30 T960,30 T990,30 T1020,30 T1050,30 T1080,30 T1110,30 T1140,30 T1170,30 T1200,30 L1200,60 L0,60 Z" fill="white"/>
    </svg>
  </div>
</section>

<!-- Cursos Section -->
<section class="py-20 bg-white relative">
  <style>
    :root{
      --rosa:#e28dc4;
      --menta:#81cacf;
      --pistacho:#c6d379;
      --choco:#5f3917;
    }

    .curso-card {
      position: relative;
      background: white;
      border-radius: 1.5rem;
      overflow: hidden;
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      border: 2px solid transparent;
    }

    .curso-card:hover {
      transform: translateY(-12px);
      box-shadow: 0 20px 40px rgba(95, 57, 23, 0.15);
      border-color: var(--rosa);
    }

    .curso-header {
      height: 180px;
      position: relative;
      overflow: hidden;
    }

    .curso-icon {
      font-size: 4rem;
      transition: transform 0.4s ease;
    }

    .curso-card:hover .curso-icon {
      transform: scale(1.15) rotate(5deg);
    }

    .badge {
      position: absolute;
      top: 1rem;
      right: 1rem;
      padding: 0.5rem 1rem;
      border-radius: 2rem;
      font-size: 0.75rem;
      font-weight: 700;
      color: white;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      z-index: 10;
    }

    .curso-content {
      padding: 1.5rem;
    }

    .detail-item {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.75rem;
      background: #f9fafb;
      border-radius: 0.75rem;
      transition: all 0.3s ease;
    }

    .detail-item:hover {
      background: #f3f4f6;
      transform: translateX(4px);
    }

    .detail-icon {
      width: 2.5rem;
      height: 2.5rem;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .btn-curso {
      width: 100%;
      padding: 1rem;
      border-radius: 1rem;
      font-weight: 600;
      transition: all 0.3s ease;
      border: none;
      cursor: pointer;
      position: relative;
      overflow: hidden;
    }

    .btn-curso::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
      transition: left 0.5s ease;
    }

    .btn-curso:hover::before {
      left: 100%;
    }

    .btn-curso:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    @media (max-width: 768px) {
      .curso-header {
        height: 150px;
      }
      .curso-icon {
        font-size: 3rem;
      }
    }
  </style>

  <div class="container-choco">
    <div class="text-center mb-16">
      <h2 class="font-['Dancing_Script'] text-4xl md:text-5xl lg:text-6xl text-[var(--menta)] mb-3">
        I Nuestros Cursos I
      </h2>
      <p class="text-gray-600 max-w-2xl mx-auto text-lg">
        Desde fundamentos básicos hasta técnicas profesionales avanzadas
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">

      <!-- CURSO 1: Básico -->
      <div class="curso-card">
        <div class="curso-header bg-gradient-to-br from-[#c6d379] to-[#81cacf] flex items-center justify-center">
          <div class="badge" style="background: linear-gradient(135deg, var(--pistacho), var(--menta));">
            POPULAR
          </div>
          <div class="curso-icon">📚</div>
        </div>

        <div class="curso-content">
          <h3 class="text-2xl font-bold text-[var(--choco)] mb-2">Curso Básico</h3>
          <p class="text-gray-500 mb-4 text-sm">Fundamentos de chocolatería artesanal</p>

          <div class="space-y-3 mb-6">
            <div class="detail-item">
              <div class="detail-icon bg-[var(--pistacho)]/20">
                <svg class="w-5 h-5 text-[var(--pistacho)]" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>
              </div>
              <div>
                <div class="text-xs text-gray-500">Duración</div>
                <div class="text-sm font-semibold text-[var(--choco)]">8 horas</div>
              </div>
            </div>

            <div class="detail-item">
              <div class="detail-icon bg-[var(--pistacho)]/20">
                <svg class="w-5 h-5 text-[var(--pistacho)]" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                </svg>
              </div>
              <div>
                <div class="text-xs text-gray-500">Capacidad</div>
                <div class="text-sm font-semibold text-[var(--choco)]">Máx. 8 personas</div>
              </div>
            </div>

            <div class="detail-item">
              <div class="detail-icon bg-[var(--pistacho)]/20">
                <svg class="w-5 h-5 text-[var(--pistacho)]" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                </svg>
              </div>
              <div>
                <div class="text-xs text-gray-500">Nivel</div>
                <div class="text-sm font-semibold text-[var(--choco)]">Principiante</div>
              </div>
            </div>
          </div>

          <a href="{{ route('contacto') }}" class="btn-curso bg-gradient-to-r from-[var(--pistacho)] to-[var(--menta)] text-white">
            Inscríbete Ahora
          </a>
        </div>
      </div>

      <!-- CURSO 2: Avanzado -->
      <div class="curso-card">
        <div class="curso-header bg-gradient-to-br from-[#e28dc4] to-[#5f3917] flex items-center justify-center">
          <div class="badge" style="background: linear-gradient(135deg, var(--rosa), var(--choco));">
            AVANZADO
          </div>
          <div class="curso-icon">🎓</div>
        </div>

        <div class="curso-content">
          <h3 class="text-2xl font-bold text-[var(--choco)] mb-2">Curso Avanzado</h3>
          <p class="text-gray-500 mb-4 text-sm">Técnicas profesionales y templado perfecto</p>

          <div class="space-y-3 mb-6">
            <div class="detail-item">
              <div class="detail-icon bg-[var(--rosa)]/20">
                <svg class="w-5 h-5 text-[var(--rosa)]" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>
              </div>
              <div>
                <div class="text-xs text-gray-500">Duración</div>
                <div class="text-sm font-semibold text-[var(--choco)]">12 horas</div>
              </div>
            </div>

            <div class="detail-item">
              <div class="detail-icon bg-[var(--rosa)]/20">
                <svg class="w-5 h-5 text-[var(--rosa)]" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
              </div>
              <div>
                <div class="text-xs text-gray-500">Incluye</div>
                <div class="text-sm font-semibold text-[var(--choco)]">Certificación</div>
              </div>
            </div>

            <div class="detail-item">
              <div class="detail-icon bg-[var(--rosa)]/20">
                <svg class="w-5 h-5 text-[var(--rosa)]" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
              </div>
              <div>
                <div class="text-xs text-gray-500">Nivel</div>
                <div class="text-sm font-semibold text-[var(--choco)]">Intermedio</div>
              </div>
            </div>
          </div>

          <a href="{{ route('contacto') }}" class="btn-curso bg-gradient-to-r from-[var(--rosa)] to-[var(--choco)] text-white">
            Inscríbete Ahora
          </a>
        </div>
      </div>

      <!-- CURSO 3: Masterclass -->
      <div class="curso-card">
        <div class="curso-header bg-gradient-to-br from-[#81cacf] to-[#e28dc4] flex items-center justify-center">
          <div class="badge" style="background: linear-gradient(135deg, var(--menta), var(--rosa));">
            MASTERCLASS
          </div>
          <div class="curso-icon">⭐</div>
        </div>

        <div class="curso-content">
          <h3 class="text-2xl font-bold text-[var(--choco)] mb-2">Masterclass Bombones</h3>
          <p class="text-gray-500 mb-4 text-sm">Bombones rellenos gourmet profesionales</p>

          <div class="space-y-3 mb-6">
            <div class="detail-item">
              <div class="detail-icon bg-[var(--menta)]/20">
                <svg class="w-5 h-5 text-[var(--menta)]" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>
              </div>
              <div>
                <div class="text-xs text-gray-500">Duración</div>
                <div class="text-sm font-semibold text-[var(--choco)]">6 horas intensivas</div>
              </div>
            </div>

            <div class="detail-item">
              <div class="detail-icon bg-[var(--menta)]/20">
                <svg class="w-5 h-5 text-[var(--menta)]" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
              </div>
              <div>
                <div class="text-xs text-gray-500">Nivel</div>
                <div class="text-sm font-semibold text-[var(--choco)]">Experto</div>
              </div>
            </div>

            <div class="detail-item">
              <div class="detail-icon bg-[var(--menta)]/20">
                <svg class="w-5 h-5 text-[var(--menta)]" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
                </svg>
              </div>
              <div>
                <div class="text-xs text-gray-500">Material</div>
                <div class="text-sm font-semibold text-[var(--choco)]">Incluido</div>
              </div>
            </div>
          </div>

          <a href="{{ route('contacto') }}" class="btn-curso bg-gradient-to-r from-[var(--menta)] to-[var(--rosa)] text-white">
            Inscríbete Ahora
          </a>
        </div>
      </div>

      <!-- CURSO 4: Empresas -->
      <div class="curso-card">
        <div class="curso-header bg-gradient-to-br from-[#5f3917] to-[#c6d379] flex items-center justify-center">
          <div class="badge" style="background: linear-gradient(135deg, var(--choco), var(--pistacho));">
            EMPRESAS
          </div>
          <div class="curso-icon">💼</div>
        </div>

        <div class="curso-content">
          <h3 class="text-2xl font-bold text-[var(--choco)] mb-2">Chocolatería Empresarial</h3>
          <p class="text-gray-500 mb-4 text-sm">Inicia tu negocio de chocolate artesanal</p>

          <div class="space-y-3 mb-6">
            <div class="detail-item">
              <div class="detail-icon bg-[var(--choco)]/20">
                <svg class="w-5 h-5 text-[var(--choco)]" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>
              </div>
              <div>
                <div class="text-xs text-gray-500">Duración</div>
                <div class="text-sm font-semibold text-[var(--choco)]">16 horas</div>
              </div>
            </div>

            <div class="detail-item">
              <div class="detail-icon bg-[var(--choco)]/20">
                <svg class="w-5 h-5 text-[var(--choco)]" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"/><path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"/>
                </svg>
              </div>
              <div>
                <div class="text-xs text-gray-500">Incluye</div>
                <div class="text-sm font-semibold text-[var(--choco)]">Plan de negocio</div>
              </div>
            </div>

            <div class="detail-item">
              <div class="detail-icon bg-[var(--choco)]/20">
                <svg class="w-5 h-5 text-[var(--choco)]" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                </svg>
              </div>
              <div>
                <div class="text-xs text-gray-500">Tema</div>
                <div class="text-sm font-semibold text-[var(--choco)]">Costos y ventas</div>
              </div>
            </div>
          </div>

          <a href="{{ route('contacto') }}" class="btn-curso bg-gradient-to-r from-[var(--choco)] to-[var(--pistacho)] text-white">
            Inscríbete Ahora
          </a>
        </div>
      </div>

      <!-- CURSO 5: Decoración -->
      <div class="curso-card">
        <div class="curso-header bg-gradient-to-br from-[#e28dc4] to-[#c6d379] flex items-center justify-center">
          <div class="badge" style="background: linear-gradient(135deg, var(--rosa), var(--pistacho));">
            NUEVO
          </div>
          <div class="curso-icon">🎨</div>
        </div>

        <div class="curso-content">
          <h3 class="text-2xl font-bold text-[var(--choco)] mb-2">Decoración Artística</h3>
          <p class="text-gray-500 mb-4 text-sm">Técnicas avanzadas de decoración con chocolate</p>

          <div class="space-y-3 mb-6">
            <div class="detail-item">
              <div class="detail-icon bg-[var(--rosa)]/20">
                <svg class="w-5 h-5 text-[var(--rosa)]" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>
              </div>
              <div>
                <div class="text-xs text-gray-500">Duración</div>
                <div class="text-sm font-semibold text-[var(--choco)]">10 horas</div>
              </div>
            </div>

            <div class="detail-item">
              <div class="detail-icon bg-[var(--rosa)]/20">
                <svg class="w-5 h-5 text-[var(--rosa)]" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                </svg>
              </div>
              <div>
                <div class="text-xs text-gray-500">Tipo</div>
                <div class="text-sm font-semibold text-[var(--choco)]">Práctica intensiva</div>
              </div>
            </div>

            <div class="detail-item">
              <div class="detail-icon bg-[var(--rosa)]/20">
                <svg class="w-5 h-5 text-[var(--rosa)]" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/>
                </svg>
              </div>
              <div>
                <div class="text-xs text-gray-500">Aprende</div>
                <div class="text-sm font-semibold text-[var(--choco)]">Transfer y pintura</div>
              </div>
            </div>
          </div>

          <a href="{{ route('contacto') }}" class="btn-curso bg-gradient-to-r from-[var(--rosa)] to-[var(--pistacho)] text-white">
            Inscríbete Ahora
          </a>
        </div>
      </div>

      <!-- CURSO 6: Kids -->
      <div class="curso-card">
        <div class="curso-header bg-gradient-to-br from-[#c6d379] to-[#e28dc4] flex items-center justify-center">
          <div class="badge" style="background: linear-gradient(135deg, var(--pistacho), var(--rosa));">
            KIDS
          </div>
          <div class="curso-icon">👶</div>
        </div>

        <div class="curso-content">
          <h3 class="text-2xl font-bold text-[var(--choco)] mb-2">Taller para Niños</h3>
          <p class="text-gray-500 mb-4 text-sm">Diversión y aprendizaje con chocolate</p>

          <div class="space-y-3 mb-6">
            <div class="detail-item">
              <div class="detail-icon bg-[var(--pistacho)]/20">
                <svg class="w-5 h-5 text-[var(--pistacho)]" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>
              </div>
              <div>
                <div class="text-xs text-gray-500">Duración</div>
                <div class="text-sm font-semibold text-[var(--choco)]">3 horas</div>
              </div>
            </div>

            <div class="detail-item">
              <div class="detail-icon bg-[var(--pistacho)]/20">
                <svg class="w-5 h-5 text-[var(--pistacho)]" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                </svg>
              </div>
              <div>
                <div class="text-xs text-gray-500">Edades</div>
                <div class="text-sm font-semibold text-[var(--choco)]">8 a 14 años</div>
              </div>
            </div>

            <div class="detail-item">
              <div class="detail-icon bg-[var(--pistacho)]/20">
                <svg class="w-5 h-5 text-[var(--pistacho)]" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"/>
                </svg>
              </div>
              <div>
                <div class="text-xs text-gray-500">Ideal para</div>
                <div class="text-sm font-semibold text-[var(--choco)]">Cumpleaños</div>
              </div>
            </div>
          </div>

          <a href="{{ route('contacto') }}" class="btn-curso bg-gradient-to-r from-[var(--pistacho)] to-[var(--rosa)] text-white">
            Inscríbete Ahora
          </a>
        </div>
      </div>

    </div>

    <!-- Info adicional -->
    <div class="mt-16 max-w-4xl mx-auto">
      <div class="bg-gradient-to-r from-[#fdf2f8] to-[#f0fdfa] rounded-2xl p-8 border-2 border-[var(--rosa)]/20">
        <div class="text-center">
          <h3 class="text-2xl font-bold text-[var(--choco)] mb-4">¿No estás seguro cuál curso elegir?</h3>
          <p class="text-gray-600 mb-6">
            Contáctanos y te ayudaremos a encontrar el curso perfecto según tus objetivos y nivel de experiencia
          </p>
          <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('contacto') }}"
               class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-[var(--choco)] text-white rounded-full font-semibold hover:bg-[var(--rosa)] transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
              </svg>
              Contáctanos
            </a>
            <a href="https://wa.me/573001234567" target="_blank"
               class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-[#25D366] text-white rounded-full font-semibold hover:bg-[#128C7E] transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
              </svg>
              WhatsApp
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@push('scripts')
<script src="{{ asset('js/animations.js') }}"></script>
@endpush
