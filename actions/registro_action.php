<?php
// C:\xampp\htdocs\securigestion\actions\registro_action.php (Versión Actualizada)

require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Recoger todos los datos del formulario (incluidos los nuevos)
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $documento = trim($_POST['documento']);
    $email = trim($_POST['email']);
    $telefono = trim($_POST['telefono']);
    $direccion = trim($_POST['direccion']);
    $fecha_contratacion = $_POST['fecha_contratacion'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // 2. Validaciones
    if (empty($nombre) || empty($apellido) || empty($documento) || empty($email) || empty($password)) {
        header('Location: ../index.php?page=registro&error=Por favor, complete todos los campos obligatorios.');
        exit();
    }

    if ($password !== $confirm_password) {
        header('Location: ../index.php?page=registro&error=Las contraseñas no coinciden.');
        exit();
    }

    // 3. Preparar los datos para la inserción
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $id_rol_defecto = 4; // Por defecto se registra como 'Vigilante'
    $activo = 1; // 1 significa TRUE (activo por defecto)

    // 4. Insertar en la base de datos
    try {
        $stmt = $pdo->prepare(
            "INSERT INTO Usuarios (Nombre, Apellido, DocumentoIdentidad, CorreoElectronico, Telefono, Direccion, FechaContratacion, ContrasenaHash, ID_Rol, Activo) 
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([$nombre, $apellido, $documento, $email, $telefono, $direccion, $fecha_contratacion, $hashed_password, $id_rol_defecto, $activo]);
        
        // Si todo sale bien, redirige al login con un mensaje de éxito
        header('Location: ../index.php?page=login&success=Registro exitoso. Ahora puedes iniciar sesión.');
        exit();

    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // Error de entrada duplicada
            header('Location: ../index.php?page=registro&error=El documento o correo electrónico ya están registrados.');
        } else {
            // Otro tipo de error
            header('Location: ../index.php?page=registro&error=Error en el registro: ' . $e->getMessage());
        }
        exit();
    }
}
?>