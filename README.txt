CLOUDBIZ - CORRECCIÓN DE PRODUCTOS Y CATEGORÍAS

Archivos para copiar conservando las mismas rutas dentro del proyecto.
NO reemplazar la base de datos ni ejecutar migrate:fresh.

REQUISITOS: Laravel 12, tablas products y categories con las columnas mostradas en las capturas; Alpine.js cargado desde resources/js/app.js para el menú plegable.

PASOS:
1. Respaldar los archivos actuales.
2. Copiar las carpetas app, resources y routes del paquete a la raíz del proyecto.
3. Comprobar resources/js/app.js: debe cargar Alpine.js si quieres minimizar el menú (ver nota abajo).
4. Ejecutar: php -l app\Models\Product.php
5. Ejecutar: php -l app\Models\Category.php
6. Ejecutar: php -l app\Http\Controllers\ProductController.php
7. Ejecutar: php -l app\Http\Controllers\CategoryController.php
8. Ejecutar: php artisan optimize:clear
9. Ejecutar: php artisan route:list
10. Ejecutar: php artisan storage:link (si no existe ya el enlace)
11. Ejecutar: php artisan serve

NOTA ALPINE: Si resources/js/app.js no incluye Alpine, instala npm install alpinejs y añade:
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();
Luego npm run dev en otra terminal. Evita iniciar Alpine dos veces si ya existe.

NO HEMOS PODIDO EJECUTAR EL PROYECTO ORIGINAL NI VER SU CONFIGURACIÓN COMPLETA. Este paquete está alineado con la estructura de MySQL y rutas mostradas, pero debes probarlo en tu entorno.
