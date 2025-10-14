<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // HOME - Hero Section
            [
                'key' => 'home_hero_title',
                'group' => 'home',
                'value' => 'Arte con Chocolate',
                'type' => 'text',
                'label' => 'Título Principal del Hero',
                'description' => 'Título principal en la sección hero de la página de inicio',
                'order' => 1,
            ],
            [
                'key' => 'home_hero_subtitle',
                'group' => 'home',
                'value' => 'Creaciones artesanales para todos los momentos especiales',
                'type' => 'text',
                'label' => 'Subtítulo del Hero',
                'description' => 'Subtítulo debajo del título principal',
                'order' => 2,
            ],
            [
                'key' => 'home_hero_description',
                'group' => 'home',
                'value' => 'Descubre el arte de trabajar con chocolate en todas sus formas. Desde dulces únicos hasta cursos especializados.',
                'type' => 'textarea',
                'label' => 'Descripción del Hero',
                'description' => 'Texto descriptivo en la sección hero',
                'order' => 3,
            ],
            [
                'key' => 'home_hero_video',
                'group' => 'home',
                'value' => 'videos/LC_1.mp4',
                'type' => 'text',
                'label' => 'Video de Fondo',
                'description' => 'Ruta del video de fondo (relativo a public/)',
                'order' => 4,
            ],

            // HOME - About Section
            [
                'key' => 'home_about_title',
                'group' => 'home',
                'value' => 'Sobre Nosotros',
                'type' => 'text',
                'label' => 'Título de Sobre Nosotros',
                'description' => 'Título de la sección sobre nosotros',
                'order' => 5,
            ],
            [
                'key' => 'home_about_text_1',
                'group' => 'home',
                'value' => 'En Chocoart, transformamos el chocolate en arte. Cada creación es una experiencia única que combina tradición, innovación y pasión por el detalle.',
                'type' => 'textarea',
                'label' => 'Sobre Nosotros - Párrafo 1',
                'description' => 'Primer párrafo de la sección sobre nosotros',
                'order' => 6,
            ],
            [
                'key' => 'home_about_text_2',
                'group' => 'home',
                'value' => 'Nuestro compromiso es ofrecer productos de la más alta calidad, elaborados con ingredientes premium y técnicas artesanales que resaltan el verdadero sabor del cacao.',
                'type' => 'textarea',
                'label' => 'Sobre Nosotros - Párrafo 2',
                'description' => 'Segundo párrafo de la sección sobre nosotros',
                'order' => 7,
            ],
            [
                'key' => 'home_about_image',
                'group' => 'home',
                'value' => 'images/about.jpg',
                'type' => 'image',
                'label' => 'Imagen de Sobre Nosotros',
                'description' => 'Imagen de la sección sobre nosotros',
                'order' => 8,
            ],

            // HOME - Feature Cards
            [
                'key' => 'home_feature_1_icon',
                'group' => 'home',
                'value' => '#e28dc4',
                'type' => 'text',
                'label' => 'Tarjeta 1 - Color',
                'description' => 'Color de fondo de la primera tarjeta (hex)',
                'order' => 9,
            ],
            [
                'key' => 'home_feature_1_title',
                'group' => 'home',
                'value' => '100% Artesanal',
                'type' => 'text',
                'label' => 'Tarjeta 1 - Título',
                'description' => 'Título de la primera tarjeta',
                'order' => 10,
            ],
            [
                'key' => 'home_feature_1_description',
                'group' => 'home',
                'value' => 'Cada pieza elaborada con dedicación y amor por el chocolate',
                'type' => 'textarea',
                'label' => 'Tarjeta 1 - Descripción',
                'description' => 'Descripción de la primera tarjeta',
                'order' => 11,
            ],
            [
                'key' => 'home_feature_2_icon',
                'group' => 'home',
                'value' => '#81cacf',
                'type' => 'text',
                'label' => 'Tarjeta 2 - Color',
                'description' => 'Color de fondo de la segunda tarjeta (hex)',
                'order' => 12,
            ],
            [
                'key' => 'home_feature_2_title',
                'group' => 'home',
                'value' => 'Ingredientes Premium',
                'type' => 'text',
                'label' => 'Tarjeta 2 - Título',
                'description' => 'Título de la segunda tarjeta',
                'order' => 13,
            ],
            [
                'key' => 'home_feature_2_description',
                'group' => 'home',
                'value' => 'Solo los mejores ingredientes para nuestras creaciones',
                'type' => 'textarea',
                'label' => 'Tarjeta 2 - Descripción',
                'description' => 'Descripción de la segunda tarjeta',
                'order' => 14,
            ],
            [
                'key' => 'home_feature_3_icon',
                'group' => 'home',
                'value' => '#c6d379',
                'type' => 'text',
                'label' => 'Tarjeta 3 - Color',
                'description' => 'Color de fondo de la tercera tarjeta (hex)',
                'order' => 15,
            ],
            [
                'key' => 'home_feature_3_title',
                'group' => 'home',
                'value' => 'Academia',
                'type' => 'text',
                'label' => 'Tarjeta 3 - Título',
                'description' => 'Título de la tercera tarjeta',
                'order' => 16,
            ],
            [
                'key' => 'home_feature_3_description',
                'group' => 'home',
                'value' => 'Aprende las técnicas profesionales de chocolatería',
                'type' => 'textarea',
                'label' => 'Tarjeta 3 - Descripción',
                'description' => 'Descripción de la tercera tarjeta',
                'order' => 17,
            ],

            // CONTACT - Contact Information
            [
                'key' => 'contact_email',
                'group' => 'contact',
                'value' => 'hola@chocoart.com',
                'type' => 'email',
                'label' => 'Email de Contacto',
                'description' => 'Dirección de email principal',
                'order' => 1,
            ],
            [
                'key' => 'contact_phone',
                'group' => 'contact',
                'value' => '+57 300 123 4567',
                'type' => 'phone',
                'label' => 'Teléfono',
                'description' => 'Número de teléfono',
                'order' => 2,
            ],
            [
                'key' => 'contact_whatsapp',
                'group' => 'contact',
                'value' => '573001234567',
                'type' => 'phone',
                'label' => 'WhatsApp',
                'description' => 'Número de WhatsApp (solo números, con código de país)',
                'order' => 3,
            ],
            [
                'key' => 'contact_whatsapp_message',
                'group' => 'contact',
                'value' => 'Hola, me gustaría obtener más información sobre sus productos',
                'type' => 'textarea',
                'label' => 'Mensaje por Defecto de WhatsApp',
                'description' => 'Mensaje predefinido al abrir WhatsApp',
                'order' => 4,
            ],
            [
                'key' => 'contact_address',
                'group' => 'contact',
                'value' => 'Calle 123 #45-67, Bogotá, Colombia',
                'type' => 'textarea',
                'label' => 'Dirección',
                'description' => 'Dirección física del negocio',
                'order' => 5,
            ],
            [
                'key' => 'contact_hours',
                'group' => 'contact',
                'value' => 'Lunes a Viernes: 9:00 AM - 6:00 PM\nSábados: 10:00 AM - 2:00 PM',
                'type' => 'textarea',
                'label' => 'Horario de Atención',
                'description' => 'Horarios de atención al público',
                'order' => 6,
            ],
            [
                'key' => 'contact_map_url',
                'group' => 'contact',
                'value' => 'https://maps.google.com/?q=Bogotá,Colombia',
                'type' => 'url',
                'label' => 'URL de Google Maps',
                'description' => 'Enlace a Google Maps para la ubicación',
                'order' => 7,
            ],

            // SOCIAL - Social Media Links
            [
                'key' => 'social_facebook',
                'group' => 'social',
                'value' => 'https://facebook.com/chocoart',
                'type' => 'url',
                'label' => 'Facebook',
                'description' => 'URL de la página de Facebook',
                'order' => 1,
            ],
            [
                'key' => 'social_instagram',
                'group' => 'social',
                'value' => 'https://instagram.com/chocoart',
                'type' => 'url',
                'label' => 'Instagram',
                'description' => 'URL del perfil de Instagram',
                'order' => 2,
            ],
            [
                'key' => 'social_tiktok',
                'group' => 'social',
                'value' => 'https://tiktok.com/@chocoart',
                'type' => 'url',
                'label' => 'TikTok',
                'description' => 'URL del perfil de TikTok',
                'order' => 3,
            ],
            [
                'key' => 'social_youtube',
                'group' => 'social',
                'value' => '',
                'type' => 'url',
                'label' => 'YouTube',
                'description' => 'URL del canal de YouTube (opcional)',
                'order' => 4,
            ],
            [
                'key' => 'social_twitter',
                'group' => 'social',
                'value' => '',
                'type' => 'url',
                'label' => 'Twitter/X',
                'description' => 'URL del perfil de Twitter/X (opcional)',
                'order' => 5,
            ],

            // FOOTER - Footer Information
            [
                'key' => 'footer_about',
                'group' => 'footer',
                'value' => 'Chocoart - Arte con chocolate. Creaciones artesanales únicas para momentos especiales.',
                'type' => 'textarea',
                'label' => 'Texto Sobre Nosotros en Footer',
                'description' => 'Breve descripción en el footer',
                'order' => 1,
            ],
            [
                'key' => 'footer_copyright',
                'group' => 'footer',
                'value' => '© 2024 Chocoart. Todos los derechos reservados.',
                'type' => 'text',
                'label' => 'Texto de Copyright',
                'description' => 'Texto de copyright en el footer',
                'order' => 2,
            ],
            [
                'key' => 'footer_logo',
                'group' => 'footer',
                'value' => 'images/LC_6Logo ChocoArt.png',
                'type' => 'image',
                'label' => 'Logo del Footer',
                'description' => 'Logo que aparece en el footer',
                'order' => 3,
            ],
        ];

        foreach ($settings as $setting) {
            \App\Models\Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
