<?php
/**
 * Seed de contenido inicial.
 *
 * Corre UNA sola vez, cuando se activa el theme (after_switch_theme),
 * y crea los posts de cada CPT con el mismo contenido que tenía la
 * maqueta HTML estática, para no tener que cargarlo todo a mano.
 *
 * Es idempotente: si vuelves a activar el theme no duplica nada,
 * porque revisa la opción "einas_content_seeded" antes de correr.
 * Si quieres forzar que vuelva a correr (ej. en un ambiente de pruebas
 * limpio), borra esa opción: delete_option('einas_content_seeded');
 */

add_action('after_switch_theme', 'einas_seed_all_content');

function einas_seed_all_content() {
    if (get_option('einas_content_seeded')) {
        return; // ya se sembró antes, no hacer nada
    }

    einas_seed_servicios();
    einas_seed_equipo();
    einas_seed_recursos();

    update_option('einas_content_seeded', current_time('mysql'));
}

/**
 * Helper: adjunta una imagen que vive en /assets/seed-images/ del theme
 * a la Media Library y la deja como imagen destacada de un post.
 * Evita duplicar la subida si ya existe un attachment con ese nombre de archivo.
 */
function einas_seed_attach_image($relative_path, $post_id, $alt = '') {
    $file_path = get_template_directory() . '/assets/seed-images/' . $relative_path;
    if (!file_exists($file_path)) {
        return false;
    }

    $filename = basename($file_path);

    // ¿Ya existe un attachment con este archivo? (evita duplicar en reseeds manuales)
    $existing = get_posts([
        'post_type'      => 'attachment',
        'meta_key'       => '_einas_seed_source',
        'meta_value'     => $relative_path,
        'posts_per_page' => 1,
    ]);
    if (!empty($existing)) {
        set_post_thumbnail($post_id, $existing[0]->ID);
        return $existing[0]->ID;
    }

    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    $upload_dir = wp_upload_dir();
    $contents   = file_get_contents($file_path);
    $upload     = wp_upload_bits($filename, null, $contents);

    if ($upload['error']) {
        return false;
    }

    $filetype   = wp_check_filetype($filename, null);
    $attachment = [
        'post_mime_type' => $filetype['type'],
        'post_title'     => sanitize_file_name($filename),
        'post_content'   => '',
        'post_status'    => 'inherit',
    ];

    $attach_id = wp_insert_attachment($attachment, $upload['file'], $post_id);
    $attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);
    wp_update_attachment_metadata($attach_id, $attach_data);

    update_post_meta($attach_id, '_wp_attachment_image_alt', $alt);
    update_post_meta($attach_id, '_einas_seed_source', $relative_path);

    set_post_thumbnail($post_id, $attach_id);
    return $attach_id;
}

/**
 * Crea (o reutiliza) un post por título dentro de un post_type dado.
 * Devuelve el ID del post.
 */
function einas_seed_get_or_create_post($post_type, $title, $extra_args = []) {
    $existing = get_page_by_title($title, OBJECT, $post_type);
    if ($existing) {
        return $existing->ID;
    }
    $args = array_merge([
        'post_type'   => $post_type,
        'post_title'  => $title,
        'post_status' => 'publish',
        'post_content' => '',
    ], $extra_args);
    return wp_insert_post($args);
}

// ─────────────────────────────────────────────────────────
// SERVICIOS
// ─────────────────────────────────────────────────────────
function einas_seed_servicios() {
    $servicios = [
        [
            'titulo'      => 'Evaluación de Impacto Ambiental (SEIA)',
            'orden'       => 1,
            'color'       => 'blue',
            'eyebrow'     => 'Evaluación SEIA',
            'bajada_hero' => 'Preparamos e ingresamos tus proyectos al Sistema de Evaluación de Impacto Ambiental, y te acompañamos en toda la tramitación ante el SEA.',
            'intro'       => 'Todo proyecto de inversión que pueda generar impacto ambiental debe pasar por el SEIA antes de ejecutarse. Ahí es donde entramos nosotros. Armamos los antecedentes técnicos, definimos la vía de ingreso que corresponde y acompañamos la tramitación ante el Servicio de Evaluación Ambiental (SEA) hasta que el proyecto obtiene su Resolución de Calificación Ambiental.',
            'alcance'     => [
                ['titulo' => 'Factibilidad ambiental de proyectos', 'descripcion' => 'Revisamos la viabilidad ambiental antes de que inviertas, para anticipar riesgos y los permisos que vas a necesitar.'],
                ['titulo' => 'Consultas de pertinencia SEIA', 'descripcion' => 'Definimos si tu proyecto, o una modificación, está obligado a entrar al SEIA. Mejor tener esa certeza antes que después.'],
                ['titulo' => 'Declaraciones de Impacto Ambiental (DIA)', 'descripcion' => 'Elaboramos y tramitamos la DIA cuando el proyecto no genera los efectos del artículo 11 de la Ley 19.300.'],
                ['titulo' => 'Respuesta a Adendas', 'descripcion' => 'Respondemos las observaciones del SEA y de los servicios con competencia ambiental con un respaldo técnico que se sostiene.'],
                ['titulo' => 'Análisis territoriales', 'descripcion' => 'Leemos el territorio donde se emplaza el proyecto, con foco en áreas protegidas, comunidades y componentes ambientales sensibles.'],
            ],
            'proceso'     => [
                ['titulo' => 'Diagnóstico y pertinencia', 'descripcion' => 'Miramos el proyecto y definimos si corresponde una consulta de pertinencia, una DIA o un EIA.'],
                ['titulo' => 'Línea de base y antecedentes', 'descripcion' => 'Levantamos la información ambiental que falta y ordenamos el expediente técnico.'],
                ['titulo' => 'Ingreso al SEIA', 'descripcion' => 'Presentamos el proyecto ante el SEA y gestionamos la admisibilidad.'],
                ['titulo' => 'Adendas y aprobación', 'descripcion' => 'Respondemos las observaciones y seguimos el proceso hasta la Resolución de Calificación Ambiental (RCA).'],
            ],
        ],
        [
            'titulo'      => 'Cumplimiento de exigencias RCA',
            'orden'       => 2,
            'color'       => 'green',
            'eyebrow'     => 'Exigencias RCA',
            'bajada_hero' => 'Ordenamos y seguimos los compromisos de tu Resolución de Calificación Ambiental, para que tu proyecto se mantenga en regla.',
            'intro'       => 'Cuando el proyecto ya está aprobado, la Resolución de Calificación Ambiental (RCA) deja una lista de compromisos y condiciones que hay que cumplir mientras el proyecto opere. Nosotros tomamos esa lista, la convertimos en algo que se puede seguir y revisamos que efectivamente se cumpla. Es la mejor forma de evitar sanciones de la Superintendencia del Medio Ambiente (SMA).',
            'alcance'     => [
                ['titulo' => 'Levantamiento de compromisos RCA', 'descripcion' => 'Reunimos todas las obligaciones de tu RCA en una matriz clara, con sus plazos y responsables.'],
                ['titulo' => 'Auditoría a cumplimiento de RCAs', 'descripcion' => 'Revisamos estado de cumplimiento, detectamos brechas y proponemos mejoras, antes y/o después de una fiscalización.'],
                ['titulo' => 'Planes de seguimiento ambiental', 'descripcion' => 'Diseñamos e implementamos los planes que comprometiste en la evaluación.'],
                ['titulo' => 'Reportes ETFA', 'descripcion' => 'Preparamos los reportes de fiscalización ambiental con el estándar exigido por la Superintendencia del Medio Ambiente.'],
                ['titulo' => 'Charlas de inducción ambiental', 'descripcion' => 'Capacitamos a tu equipo, contratistas y subcontratistas en materias establecidas en RCA y otros.'],
            ],
            'proceso'     => [
                ['titulo' => 'Mapeo de compromisos', 'descripcion' => 'Sacamos cada compromiso de la RCA con sus plazos.'],
                ['titulo' => 'Matriz de cumplimiento', 'descripcion' => 'Armamos una matriz que se puede seguir, ordenada según el riesgo de cada punto.'],
                ['titulo' => 'Seguimiento y reporte', 'descripcion' => 'Hacemos seguimiento periódico y entregamos los reportes que exige la autoridad.'],
                ['titulo' => 'Mejora continua', 'descripcion' => 'Cerramos las brechas y te dejamos preparado para cualquier fiscalización.'],
            ],
        ],
        [
            'titulo'      => 'Soporte Ambiental Operativo',
            'orden'       => 3,
            'color'       => 'amber',
            'eyebrow'     => 'Soporte Operativo',
            'bajada_hero' => 'Nos hacemos cargo de la gestión ambiental del día a día de tu operación, desde los residuos y el sistema RETC hasta los permisos sectoriales y el terreno.',
            'intro'       => 'La evaluación es solo el comienzo. Una vez que el proyecto opera, la gestión ambiental no para. Siempre hay declaraciones que presentar, residuos que manejar y compromisos que sostener. Funcionamos como tu área ambiental externa y nos encargamos de todo eso, para que tu equipo se concentre en operar.',
            'alcance'     => [
                ['titulo' => 'Administración sistema RETC', 'descripcion' => 'Llevamos tus declaraciones en el Registro de Emisiones y Transferencias de Contaminantes.'],
                ['titulo' => 'Auditoría a gestión de residuos', 'descripcion' => 'Revisamos cómo manejas los residuos peligrosos e industriales y dónde estás expuesto.'],
                ['titulo' => 'Capacitaciones e inducciones', 'descripcion' => 'Formamos a tu equipo en buenas prácticas y en lo que la normativa exige.'],
                ['titulo' => 'Permisos sectoriales', 'descripcion' => 'Tramitamos los permisos ambientales sectoriales (PAS) que tu actividad necesita.'],
                ['titulo' => 'Control operativo en terreno', 'descripcion' => 'Realizamos visitas y técnicas para detectar no conformidades, proponer mejoras y así proteger tu proyecto.'],
            ],
            'proceso'     => [
                ['titulo' => 'Diagnóstico operativo', 'descripcion' => 'Vemos qué obligaciones ambientales tienes activas hoy.'],
                ['titulo' => 'Plan de gestión', 'descripcion' => 'Definimos quién hace qué, en qué plazos y con qué procedimiento.'],
                ['titulo' => 'Ejecución y terreno', 'descripcion' => 'Implementamos, declaramos y acompañamos en faena.'],
                ['titulo' => 'Reporte y control', 'descripcion' => 'Te entregamos reportes periódicos y avisamos a tiempo cuando algo necesita atención.'],
            ],
        ],
    ];

    foreach ($servicios as $s) {
        $post_id = einas_seed_get_or_create_post('servicio', $s['titulo'], [
            'menu_order' => $s['orden'],
        ]);
        if (!$post_id || is_wp_error($post_id)) continue;

        update_post_meta($post_id, '_color_acento', $s['color']);
        update_post_meta($post_id, '_eyebrow', $s['eyebrow']);
        update_post_meta($post_id, '_bajada_hero', $s['bajada_hero']);
        update_post_meta($post_id, '_intro', $s['intro']);
        update_post_meta($post_id, '_alcance', $s['alcance']);
        update_post_meta($post_id, '_proceso', $s['proceso']);
    }
}

// ─────────────────────────────────────────────────────────
// EQUIPO
// ─────────────────────────────────────────────────────────
function einas_seed_equipo() {
    $equipo = [
        ['nombre' => 'Carlos Alberto Muñoz Reyes',        'cargo' => 'Ingeniero Civil Ambiental',                 'puesto' => 'Gerente General',                          'foto' => '00_carlos_muñoz.webp',              'home' => true],
        ['nombre' => 'Cristian Marcelo Muñoz Cárdenas',   'cargo' => 'Ingeniero en RRNN',                         'puesto' => 'Gerente de Proyectos',                     'foto' => '01_cristian_munoz.webp',            'home' => true],
        ['nombre' => 'María Isabel Parra Colmenares',     'cargo' => 'Planificación y Finanzas',                  'puesto' => 'Jefa Dpto. Planificación y Finanzas',      'foto' => '02_maria_isabel_parra.webp',        'home' => true],
        ['nombre' => 'Cristian Andrés Villarroel de Mayo','cargo' => 'Salud y Seguridad en el Trabajo',           'puesto' => 'Jefe Unidad HS',                           'foto' => '03_cristian_villaroel.webp',        'home' => true],
        ['nombre' => 'Catalina Fernanda Urbina Fuentealba','cargo' => 'Ingeniera Ambiental',                      'puesto' => 'Jefa de Proyectos',                        'foto' => '03_catalina_urbina.webp',           'home' => true],
        ['nombre' => 'Siujan Sarapura Huacucano',         'cargo' => 'Ingeniera Civil Ambiental',                 'puesto' => 'Jefa de Proyectos',                        'foto' => '02_siujan_sarapura.webp',           'home' => true],
        ['nombre' => 'Carla Valeska Aguilera Torres',     'cargo' => 'Ingeniera Agrónoma | Mg. Botánica',         'puesto' => 'Jefe Especialidad Botánica',               'foto' => '05_carla_aguilera.webp',            'home' => true],
        ['nombre' => 'Karina Rodriguez Díaz',             'cargo' => 'Arqueóloga',                                'puesto' => 'Jefa Especialidad Arqueología',            'foto' => '08_karina_rodriguez.webp',          'home' => true],
        ['nombre' => 'Paulina Javiera Ruiz Lobos',        'cargo' => 'Ingeniera de Proyectos',                    'puesto' => 'Ingeniera de Proyectos',                   'foto' => '08_paulina_ruiz.webp',              'home' => false],
        ['nombre' => 'María Constanza Fernandez Stefani', 'cargo' => 'Ingeniera de Proyectos',                    'puesto' => 'Ingeniera de Proyectos',                   'foto' => '09_maria_constanza_fernandez.webp', 'home' => false],
        ['nombre' => 'Javier Legaza Carrasco',            'cargo' => 'Ingeniero de Proyectos',                    'puesto' => 'Ingeniero de Proyectos',                   'foto' => '10_javier_legaza.webp',             'home' => false],
        ['nombre' => 'Rafael Rodriguez Díaz',             'cargo' => 'Ing. Ambiental | Mg. Energías Renovables',  'puesto' => 'Ingeniero de Proyectos',                   'foto' => '06_rafael_rodriguez.webp',          'home' => false],
        ['nombre' => 'Rocio Fuentes Riquelme',            'cargo' => 'Técnica en Medio Ambiente',                 'puesto' => 'Técnica de Proyectos',                     'foto' => '04_rocio_fuentes.webp',             'home' => false],
        ['nombre' => 'Eduardo Cáceres Díaz',              'cargo' => 'Técnico Ambiental',                         'puesto' => 'Técnico de Proyectos',                     'foto' => '07_eduardo_caceres.webp',           'home' => false],
        ['nombre' => 'Daniela Castillo Hernández',        'cargo' => 'Ingeniera de Proyectos',                    'puesto' => 'Ingeniera de Proyectos',                   'foto' => '14_daniela_castillo.webp',          'home' => false],
    ];

    foreach ($equipo as $i => $m) {
        $post_id = einas_seed_get_or_create_post('equipo', $m['nombre'], [
            'menu_order' => $i + 1,
        ]);
        if (!$post_id || is_wp_error($post_id)) continue;

        update_post_meta($post_id, '_cargo', $m['cargo']);
        update_post_meta($post_id, '_puesto', $m['puesto']);
        update_post_meta($post_id, '_destacar_en_home', $m['home'] ? '1' : '0');

        einas_seed_attach_image('equipo/' . $m['foto'], $post_id, $m['nombre']);
    }
}

// ─────────────────────────────────────────────────────────
// RECURSOS (guías)
// ─────────────────────────────────────────────────────────
function einas_seed_recursos() {
    $recursos = [
        [
            'titulo'   => '¿Qué es una RCA y cómo se obtiene en Chile?',
            'excerpt'  => 'Qué es la RCA, para qué sirve, cómo se obtiene a través del SEIA y qué obligaciones impone a un proyecto.',
            'nota'     => 'Esta guía tiene fines informativos y no constituye asesoría legal. Cada proyecto debe evaluarse en su mérito.',
            'contenido' =>
                '<h2>¿Qué es la RCA?</h2><p>La Resolución de Calificación Ambiental (RCA) es el acto administrativo mediante el cual el Servicio de Evaluación Ambiental (SEA) aprueba o rechaza un proyecto que ha ingresado al Sistema de Evaluación de Impacto Ambiental (SEIA). Dicho simple, es el permiso ambiental que te deja ejecutar el proyecto, y a la vez el documento que fija bajo qué condiciones puedes operar.</p>' .
                '<h2>¿Cómo se obtiene una RCA?</h2><p>Se obtiene al final del proceso de evaluación ambiental. El titular ingresa su proyecto al SEIA mediante una Declaración de Impacto Ambiental (DIA) o un Estudio de Impacto Ambiental (EIA); los órganos del Estado con competencia ambiental revisan el expediente, el titular responde observaciones (Adendas) y, si el proyecto cumple con la normativa, se emite una RCA favorable.</p>' .
                '<h2>¿Qué obligaciones impone?</h2><p>Una RCA favorable no es el final del camino: establece compromisos, medidas y planes de seguimiento que el titular debe cumplir durante toda la vida útil del proyecto. La Superintendencia del Medio Ambiente (SMA) fiscaliza ese cumplimiento, y los incumplimientos pueden derivar en sanciones.</p>',
        ],
        [
            'titulo'   => 'Diferencia entre DIA y EIA',
            'excerpt'  => 'Diferencias entre Declaración y Estudio de Impacto Ambiental, y cómo saber cuál aplica a tu proyecto.',
            'nota'     => 'Esta guía tiene fines informativos y no constituye asesoría legal. Cada proyecto debe evaluarse en su mérito.',
            'contenido' =>
                '<h2>Dos vías de ingreso al SEIA</h2><p>Todo proyecto que ingresa al SEIA lo hace por una de dos vías: una Declaración de Impacto Ambiental (DIA) o un Estudio de Impacto Ambiental (EIA). <strong>Elegir la vía correcta es una de las decisiones más importantes</strong> y de mayor impacto en plazos y costos del proceso.</p>' .
                '<h2>¿Cuándo corresponde un EIA?</h2><p>Corresponde un EIA cuando el proyecto genera o presenta alguno de los efectos, características o circunstancias del artículo 11 de la Ley 19.300: riesgo para la salud de la población; efectos adversos significativos sobre la cantidad y calidad de recursos naturales renovables; reasentamiento de comunidades o alteración significativa de los sistemas de vida; localización próxima a poblaciones o áreas protegidas; o alteración de monumentos y sitios con valor patrimonial, entre otros.</p>' .
                '<h2>¿Cuándo corresponde una DIA?</h2><p>Si el proyecto no genera ninguno de los efectos del artículo 11, ingresa mediante una DIA. Es un proceso más acotado, pero igualmente riguroso: debe demostrar que el proyecto cumple con la normativa ambiental y que no produce los efectos que obligarían a un EIA.</p>',
        ],
        [
            'titulo'   => 'Gestión Ambiental Integral: desde la idea, la tramitación SEIA, RCA y el seguimiento',
            'excerpt'  => 'Pasos para ingresar un proyecto al Sistema de Evaluación de Impacto Ambiental en Chile, desde la pertinencia hasta la RCA.',
            'nota'     => 'Esta guía tiene fines informativos y no constituye asesoría legal. Cada proyecto debe evaluarse en su mérito.',
            'contenido' =>
                '<h2>¿Cuándo debe ingresar un proyecto al SEIA?</h2><p>El artículo 10 de la Ley 19.300 y el artículo 3 del RSEIA (DS 40/2013), lista los tipos de proyectos y actividades que, por su naturaleza, deben someterse al SEIA (por ejemplo, líneas de transmisión, proyectos energéticos, mineros, acuícolas o de infraestructura). Si tienes dudas sobre si tu proyecto o su modificación debe ingresar, lo recomendable es presentar una consulta de pertinencia ante el SEA.</p>' .
                '<h2>DIA o EIA, ¿cuál corresponde?</h2><p>Si el proyecto genera alguno de los efectos, características o circunstancias del artículo 11 de la Ley 19.300 —riesgo para la salud de la población, efectos adversos significativos sobre recursos naturales, reasentamiento de comunidades, cercanía a áreas protegidas, entre otros— debe ingresar mediante un Estudio de Impacto Ambiental (EIA). Si no los genera, ingresa mediante una Declaración de Impacto Ambiental (DIA), un proceso más acotado.</p>' .
                '<h2>Etapas del proceso</h2><p>A grandes rasgos, el camino es este: primero se prepara, programa y desarrollan las diferentes líneas de base, en paralelo se lleva a cabo el resto de expediente (descripción del proyecto, análisis legal, áreas de influencia, etc). Posteriormente el proyecto ingresa y el SEA revisa su admisibilidad; después lo evalúan los servicios con competencia ambiental; vienen las Adendas, donde el titular responde las observaciones; y al final llega la calificación, que termina en la Resolución de Calificación Ambiental.</p>',
        ],
    ];

    // Asegura que exista el término "Guía" en la taxonomía (por si el seeder corre antes del seed de términos)
    if (!term_exists('Guía', 'tipo_recurso')) {
        wp_insert_term('Guía', 'tipo_recurso');
    }

    foreach ($recursos as $r) {
        $existing = get_page_by_title($r['titulo'], OBJECT, 'recurso');
        if ($existing) continue;

        $post_id = wp_insert_post([
            'post_type'    => 'recurso',
            'post_title'   => $r['titulo'],
            'post_content' => $r['contenido'],
            'post_excerpt' => $r['excerpt'],
            'post_status'  => 'publish',
        ]);
        if (!$post_id || is_wp_error($post_id)) continue;

        wp_set_object_terms($post_id, 'Guía', 'tipo_recurso');
        update_post_meta($post_id, '_nota_legal', $r['nota']);
    }
}
