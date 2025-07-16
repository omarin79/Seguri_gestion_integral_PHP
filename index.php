<?php
// C:\xampp\htdocs\securigestion\Seguri_gestion_integral_PHP\index.php (Versión Corregida y Estable)

session_start();

require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

// 1. Determina la página a mostrar, con valores por defecto seguros.
$page = $_GET['page'] ?? (is_logged_in() ? 'inicio' : 'login');

// 2. Define las páginas que son públicas y no necesitan iniciar sesión.
$public_pages = ['login', 'olvido-contrasena', 'reset-password'];

// 3. Lógica de Seguridad:
// Si la página que se pide NO es pública Y el usuario NO ha iniciado sesión,
// se le envía forzosamente a la página de login.
if (!is_logged_in() && !in_array($page, $public_pages)) {
    header('Location: index.php?page=login&error=session_expired');
    exit();
}

// 4. Cargar el encabezado solo en las páginas internas (no en el login, etc.).
if (!in_array($page, $public_pages)) {
    require_once __DIR__ . '/includes/header.php';
}

// 5. Cargar el contenido de la página solicitada usando una estructura limpia.
$page_path = __DIR__ . '/pages/' . $page . '.php';

if (file_exists($page_path)) {
    include $page_path;
} else {
    // Si el archivo de la página no existe, se muestra un error 404.
    echo '<div class="page-content active" style="text-align:center;"><h1>Error 404: Página no encontrada</h1><p>La página que buscas no existe o fue movida.</p></div>';
}

// 6. Cargar el pie de página solo en las páginas internas.
if (!in_array($page, $public_pages)) {
    require_once __DIR__ . '/includes/footer.php';
}
?>