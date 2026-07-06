# EINAS — Theme WordPress (branch `wp-theme`)

## Cómo probarlo en local

1. Instala un WordPress limpio (Local by WP, XAMPP, `wp-env`, lo que uses).
2. Copia **todo el contenido de esta branch** dentro de `wp-content/themes/einas/`
   (todo excepto `_reference-html/`, que es solo material de referencia — no
   es parte del theme, no rompe nada si la copias pero no cumple ninguna función).
3. Activa el theme en **Apariencia → Temas**.
4. Al activarlo, el seeder (`inc/seed-content.php`) crea automáticamente:
   - 3 `Servicios` (Evaluación SEIA, Cumplimiento RCA, Soporte Operativo) con
     todo su contenido (alcance, proceso, colores de acento).
   - 15 `Equipo`, con foto real, cargo, puesto y el flag de si aparecen en el home.
   - 3 `Recursos` (guías), con su contenido completo y categorizados como "Guía".
   - 5 `Páginas`: Contacto, Casos, Sector Minería y Energía, Sector Acuicultura
     y Consultora Ambiental en Punta Arenas — cada una con el slug exacto para
     que WordPress aplique automáticamente su template (`page-{slug}.php`),
     sin que tengas que asignar nada a mano en el admin.
5. Revisa que:
   - `Servicios`, `Equipo` y `Recursos` aparecen como menús en el admin.
   - Cada post seedeado tiene su contenido y (en equipo) su foto.
   - El home (`/`) muestra los 3 servicios y los 8 miembros destacados,
     tirando del CPT — no hay texto hardcodeado ahí.
   - `/servicios/`, `/equipo/`, `/recursos/` (archivos de cada CPT) cargan bien,
     con el listado completo y el diseño real (service-card, team-card, res-card).
   - `/contacto/`, `/casos/`, `/sector-mineria-energia/`, `/sector-acuicultura/`
     y `/consultora-ambiental-punta-arenas/` cargan con su contenido real.
   - El botón "Ver más equipo" del home despliega los 7 miembros restantes.
   - El carrusel del hero rota entre las 3 fotos de fondo.

## Si necesitas resetear el seed

El seeder solo corre una vez (usa la opción `einas_content_seeded` como flag).
Para que vuelva a correr en un ambiente de pruebas:

```php
delete_option('einas_content_seeded');
```

y vuelve a desactivar/activar el theme. **No borra los posts/páginas existentes**,
solo evita crear duplicados si el título (o el slug, en el caso de páginas) ya
existe — así que si quieres "limpio de verdad", borra los posts de los 3 CPT
y las 5 páginas a mano antes de reactivar.

## Pendiente / a confirmar antes de dar por cerrado

- **Quform**: `page-contacto.php` tiene `[quform id="1"]` como placeholder —
  falta el ID real (Quform → Forms en el wp-admin de producción).
- **Mapa**: hoy está como iframe simple de Google Maps embed (sin API key).
  Confirmar si el mapa real usa la API de Google o si este iframe basta.
- **Imágenes**: las fotos de equipo y del hero se movieron desde
  `raw.githubusercontent.com` a `assets/seed-images/` del theme, y el seeder
  las sube a la Media Library al crear cada post — ya no dependen de GitHub.
- **Logo**: por ahora sigue apuntando a `https://einas.cl/wp-content/uploads/...`
  (el sitio en vivo). Si quieres desacoplarlo también, dime y lo bajo al theme.
- El **menú de navegación** funciona out-of-the-box con enlaces por defecto
  (`inc/nav-fallbacks.php`), pero conviene configurar un Menú real en
  Apariencia → Menús una vez que el contenido esté cargado, así puedes
  reordenar/renombrar sin tocar código.
- **robots.txt / sitemap.xml**: quedaron en `_reference-html/` como referencia.
  En WordPress esto normalmente lo genera un plugin SEO (Yoast/RankMath) —
  no lo repliqué a mano para no generar un sitemap que compita con el del plugin.
