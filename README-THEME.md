# EINAS — Theme WordPress (branch `wp-theme`)

## Cómo probarlo en local

1. Instala un WordPress limpio (Local by WP, XAMPP, `wp-env`, lo que uses).
2. Copia **todo el contenido de esta branch** dentro de `wp-content/themes/einas/`
   (todo excepto `_reference-html/`, que es solo material de referencia mientras
   terminamos de portar cada página — no es parte del theme).
3. Activa el theme en **Apariencia → Temas**.
4. Al activarlo, el seeder (`inc/seed-content.php`) crea automáticamente:
   - 3 `Servicios` (Evaluación SEIA, Cumplimiento RCA, Soporte Operativo) con
     todo su contenido (alcance, proceso, colores de acento).
   - 15 `Equipo`, con foto real, cargo, puesto y el flag de si aparecen en el home.
   - 3 `Recursos` (guías), con su contenido completo y categorizados como "Guía".
5. Revisa que:
   - `Servicios`, `Equipo` y `Recursos` aparecen como menús en el admin.
   - Cada post seedeado tiene su contenido y (en equipo) su foto.
   - El home (`front-page.php`) muestra los 3 servicios y los 8 miembros
     destacados, tirando del CPT — no hay texto hardcodeado ahí.

## Si necesitas resetear el seed

El seeder solo corre una vez (usa la opción `einas_content_seeded` como flag).
Para que vuelva a correr en un ambiente de pruebas:

```php
delete_option('einas_content_seeded');
```

y vuelve a desactivar/activar el theme. **No borra los posts existentes**,
solo evita crear duplicados si el título ya existe — así que si quieres
"limpio de verdad", borra los posts de los 3 CPT a mano antes de reactivar.

## Pendiente / a confirmar antes de dar por cerrado

- **Quform**: `page-contacto.php` tiene `[quform id="1"]` como placeholder —
  falta el ID real (Quform → Forms en el wp-admin de producción).
- **Mapa**: hoy está como iframe simple de Google Maps embed (sin API key).
  Confirmar si el mapa real usa la API de Google o si este iframe basta.
- **Imágenes**: las fotos de equipo y del hero se movieron desde
  `raw.githubusercontent.com` a `assets/seed-images/` del theme, y el seeder
  las sube a la Media Library al crear cada post — ya no dependen de GitHub.
- **Templates pendientes de portar 1:1 desde `_reference-html/`**: `casos.html`,
  `sector-mineria-energia.html`, `sector-acuicultura.html`,
  `consultora-ambiental-punta-arenas.html` — quedan como páginas estáticas
  (no son CPT), pendientes de convertir a templates PHP.
- El **menú de navegación** funciona out-of-the-box con enlaces por defecto
  (`inc/nav-fallbacks.php`), pero conviene configurar un Menú real en
  Apariencia → Menús una vez que el contenido esté cargado.
