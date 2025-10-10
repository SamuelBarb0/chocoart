<?php

use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', function () {
    return view('home');
})->name('home');

// Productos
Route::get('/productos', function () {
    return view('productos');
})->name('productos');

// Cursos
Route::get('/cursos', function () {
    return view('cursos');
})->name('cursos');

// Galería
Route::get('/galeria', function () {
    return view('galeria');
})->name('galeria');

// Blog
Route::get('/blog', function () {
    return view('blog');
})->name('blog');

// Blog Post Individual
Route::get('/blog/{slug}', function ($slug) {
    // Array de posts con su contenido
    $posts = [
        'arte-templado-chocolate' => [
            'title' => 'El Arte del Templado del Chocolate',
            'category' => 'Técnicas',
            'date' => '15 de Septiembre, 2024',
            'readTime' => 8,
            'icon' => '🍫',
            'gradient' => 'from-[#e28dc4] to-[#81cacf]',
            'content' => '
                <h2>¿Qué es el templado del chocolate?</h2>
                <p>El templado es un proceso térmico controlado que permite al chocolate adquirir propiedades físicas deseables como brillo, textura crujiente y resistencia al calor. Es fundamental para obtener productos de calidad profesional.</p>

                <h3>Los tres pasos del templado</h3>
                <p>El proceso de templado consta de tres fases esenciales:</p>
                <ol>
                    <li><strong>Fundido:</strong> Calentar el chocolate a 45-50°C para derretir todos los cristales de manteca de cacao</li>
                    <li><strong>Enfriamiento:</strong> Bajar la temperatura a 27-28°C para formar cristales estables</li>
                    <li><strong>Recalentamiento:</strong> Subir nuevamente a 31-32°C para trabajar el chocolate</li>
                </ol>

                <h3>Métodos de templado</h3>
                <p>Existen varios métodos para templar el chocolate, cada uno con sus ventajas:</p>

                <h4>Método del marmoleado</h4>
                <p>Consiste en verter 2/3 del chocolate fundido sobre una superficie fría (mármol o granito) y trabajarlo con espátulas hasta bajar la temperatura. Luego se mezcla con el tercio restante.</p>

                <h4>Método de la siembra</h4>
                <p>Se agregan piezas pequeñas de chocolate ya templado al chocolate fundido. Los cristales estables actúan como "semillas" para formar nuevos cristales correctos.</p>

                <h4>Método Mycryo</h4>
                <p>Utiliza manteca de cacao en polvo en forma de cristales estables. Es el método más sencillo para principiantes.</p>

                <h3>Señales de un buen templado</h3>
                <p>Un chocolate bien templado debe presentar:</p>
                <ul>
                    <li>Brillo intenso y uniforme</li>
                    <li>Textura crujiente al romperlo</li>
                    <li>Contracción al solidificar (fácil desmolde)</li>
                    <li>Resistencia al tacto sin derretirse inmediatamente</li>
                </ul>

                <blockquote>
                    "El templado es la base de la chocolatería profesional. Un chocolate mal templado puede arruinar horas de trabajo." - Maestro Chocolatero
                </blockquote>

                <h3>Consejos prácticos</h3>
                <p>Para obtener mejores resultados al templar chocolate:</p>
                <ul>
                    <li>Usa un termómetro de precisión digital</li>
                    <li>Trabaja en un ambiente fresco (18-20°C)</li>
                    <li>Evita que entre agua o humedad en el chocolate</li>
                    <li>Practica con pequeñas cantidades hasta dominar la técnica</li>
                    <li>Realiza pruebas de templado antes de trabajar grandes cantidades</li>
                </ul>

                <p>Con práctica y paciencia, dominarás esta técnica fundamental que transformará tus creaciones de chocolate en productos profesionales de altísima calidad.</p>
            ',
            'relatedPosts' => [
                [
                    'title' => 'Técnicas de Decoración con Transfer',
                    'excerpt' => 'Aprende a crear diseños impresionantes usando la técnica de transfer',
                    'slug' => 'tecnicas-decoracion-transfer',
                    'icon' => '🎨',
                    'gradient' => 'from-[#81cacf] to-[#c6d379]',
                ],
                [
                    'title' => '5 Rellenos Gourmet para Bombones',
                    'excerpt' => 'Ideas innovadoras de rellenos que harán que tus bombones sean inolvidables',
                    'slug' => 'rellenos-gourmet-bombones',
                    'icon' => '🍬',
                    'gradient' => 'from-[#e28dc4] to-[#c6d379]',
                ],
                [
                    'title' => 'Chocolate de Origen: Qué es y Por Qué Importa',
                    'excerpt' => 'Explora el fascinante mundo del cacao de origen único',
                    'slug' => 'chocolate-origen',
                    'icon' => '🌱',
                    'gradient' => 'from-[#c6d379] to-[#e28dc4]',
                ],
            ],
        ],
        'tecnicas-decoracion-transfer' => [
            'title' => 'Técnicas de Decoración con Transfer',
            'category' => 'Decoración',
            'date' => '10 de Septiembre, 2024',
            'readTime' => 6,
            'icon' => '🎨',
            'gradient' => 'from-[#81cacf] to-[#c6d379]',
            'content' => '<h2>Introducción al Transfer</h2><p>El transfer es una técnica decorativa que permite transferir diseños impresos al chocolate. Es ideal para personalizar bombones y tabletas.</p><h3>Materiales necesarios</h3><p>Para trabajar con transfer necesitas hojas especiales de acetato con diseños impresos en colores comestibles.</p>',
            'relatedPosts' => [],
        ],
        'chocolate-origen' => [
            'title' => 'Chocolate de Origen: Qué es y Por Qué Importa',
            'category' => 'Ingredientes',
            'date' => '5 de Septiembre, 2024',
            'readTime' => 7,
            'icon' => '🌱',
            'gradient' => 'from-[#c6d379] to-[#e28dc4]',
            'content' => '<h2>¿Qué es el chocolate de origen?</h2><p>El chocolate de origen único proviene de una región específica, lo que le confiere características únicas de sabor.</p>',
            'relatedPosts' => [],
        ],
        'iniciar-negocio-chocolateria' => [
            'title' => 'Cómo Iniciar tu Negocio de Chocolatería',
            'category' => 'Negocio',
            'date' => '28 de Agosto, 2024',
            'readTime' => 10,
            'icon' => '💼',
            'gradient' => 'from-[#5f3917] to-[#c6d379]',
            'content' => '<h2>Primeros pasos</h2><p>Iniciar un negocio de chocolatería requiere planificación, pasión y conocimiento del mercado.</p>',
            'relatedPosts' => [],
        ],
        'rellenos-gourmet-bombones' => [
            'title' => '5 Rellenos Gourmet para Bombones',
            'category' => 'Recetas',
            'date' => '20 de Agosto, 2024',
            'readTime' => 5,
            'icon' => '🍬',
            'gradient' => 'from-[#e28dc4] to-[#c6d379]',
            'content' => '<h2>Rellenos innovadores</h2><p>Descubre cinco recetas de rellenos que sorprenderán a tus clientes.</p>',
            'relatedPosts' => [],
        ],
        'historia-chocolate' => [
            'title' => 'La Historia del Chocolate: Del Cacao a tu Mesa',
            'category' => 'Historia',
            'date' => '12 de Agosto, 2024',
            'readTime' => 9,
            'icon' => '📚',
            'gradient' => 'from-[#81cacf] to-[#e28dc4]',
            'content' => '<h2>Orígenes del chocolate</h2><p>El chocolate tiene una historia fascinante que se remonta a las civilizaciones mesoamericanas.</p>',
            'relatedPosts' => [],
        ],
    ];

    // Verificar si el post existe
    if (!isset($posts[$slug])) {
        abort(404);
    }

    $post = $posts[$slug];

    return view('blog-post', [
        'title' => $post['title'],
        'category' => $post['category'],
        'date' => $post['date'],
        'readTime' => $post['readTime'],
        'icon' => $post['icon'],
        'gradient' => $post['gradient'],
        'content' => $post['content'],
        'relatedPosts' => $post['relatedPosts'],
    ]);
})->name('blog.post');

// Contacto
Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

// Contact form submission
Route::post('/contacto', function () {
    // TODO: Process contact form
    return redirect()->back()->with('success', 'Mensaje enviado correctamente');
})->name('contacto.store');
