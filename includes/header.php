<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
require_once __DIR__ . '/functions.php';

// Define la ruta de la foto, usando la de la sesión o una por defecto
$foto_perfil = $_SESSION['user_foto'] ?? 'images/user2-160x160.jpg';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SecuriGestión Integral</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div id="content-wrapper">
    <?php if (is_logged_in()): ?>
    <header class="main-header" id="app-header">
        <div class="logo-container">
            <a href="index.php?page=inicio"><img src="images/logo_segurigestion.png" alt="Logo" id="header-logo"></a>
        </div>
        <div class="header-right">
            <nav class="main-nav">
                 <ul>
                    <li><a href="index.php?page=inicio">Inicio</a></li>
                    <li><a href="index.php?page=plataforma_operativa">Plataforma Operativa</a></li>
                    <li><a href="index.php?page=talento_humano">Talento Humano</a></li>
                    <li><a href="index.php?page=nomina">Nómina</a></li>
                    <li><a href="index.php?page=visitas">Registrar Visita</a></li>
                    <li><a href="index.php?page=mi-perfil">Mi Perfil</a></li>
                    <li><a href="actions/logout_action.php">Cerrar Sesión</a></li>
                </ul>
            </nav>
            <div class="user-info">
                <img src="<?php echo htmlspecialchars($foto_perfil); ?>" alt="Foto de Usuario">
                <span id="logged-in-username"><?php echo htmlspecialchars($_SESSION['user_nombre']); ?></span>
            </div>
        </div>
    </header>
    <?php endif; ?>