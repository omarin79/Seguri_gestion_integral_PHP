<?php
// C:\xampp\htdocs\securigestion\actions\recuperar_action.php

// (Este es el mismo código de la respuesta anterior, pero lo incluyo para que lo tengas a mano)
session_start();
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email_recuperar'] ?? '';

    // Lógica para buscar el email y enviar el enlace de recuperación...
    
    // Por ahora, simulamos el éxito.
    $success_message = "Si su correo está registrado, hemos enviado las instrucciones de recuperación.";
    header('Location: ../index.php?page=login&success=' . urlencode($success_message));
    exit();
}
?>