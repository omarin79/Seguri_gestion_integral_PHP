<?php
// C:\xampp\htdocs\securigestion\index.php (Versión Definitiva)

// Inicia la sesión. Esta es la única vez que se debe llamar a session_start().
session_start();

// Incluye los archivos de funciones y base de datos.
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

// Determina la página a mostrar.
$page = $_GET['page'] ?? (is_logged_in() ? 'inicio' : 'login');

// Define las páginas que son públicas (no necesitan login).
$public_pages = ['login', 'registro', 'olvido-contrasena', 'reset-password'];

// Si la página solicitada NO es pública Y el usuario NO ha iniciado sesión,
// lo redirigimos forzosamente al login.
if (!in_array($page, $public_pages) && !is_logged_in()) {
    header('Location: index.php?page=login&error=session_expired');
    exit();
}

// Carga el encabezado.
require_once __DIR__ . '/includes/header.php';

// Carga el contenido de la página específica.
$page_file = __DIR__ . '/pages/' . $page . '.php';
if (file_exists($page_file)) {
    include $page_file;
} else {
    // Si la página no existe, muestra un error 404.
    echo '<div class="page-content active" style="text-align:center;"><h1>Error 404: Página no encontrada</h1></div>';
}

// Carga el pie de página.
require_once __DIR__ . '/includes/footer.php'; // <-- LÍNEA CORREGIDA
?>