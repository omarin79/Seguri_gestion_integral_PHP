<?php
// C:\xampp\htdocs\securigestion\actions\registro_action.php

require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos, incluyendo el nuevo campo 'id_rol'
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $documento = trim($_POST['documento']);
    $email = trim($_POST['email']);
    $id_rol = $_POST['id_rol']; // <--- DATO NUEVO
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validar que se haya seleccionado un rol
    if (empty($id_rol)) {
        header('Location: ../index.php?page=registro&error=Por favor, seleccione un rol para el usuario.');
        exit();
    }
    
    // ... resto de validaciones ...
    if ($password !== $confirm_password) {
        header('Location: ../index.php?page=registro&error=Las contraseñas no coinciden.');
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $pdo->beginTransaction();

        // Se usa la variable $id_rol en lugar de un valor fijo
        $stmt_usuarios = $pdo->prepare(
            "INSERT INTO Usuarios (Nombre, Apellido, DocumentoIdentidad, CorreoElectronico, ContrasenaHash, ID_Rol) 
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt_usuarios->execute([$nombre, $apellido, $documento, $email, $hashed_password, $id_rol]);
        
        // Sincronización con la tabla de autocompletar
        $nombre_completo = $apellido . ' ' . $nombre;
        // (Podrías obtener el nombre del rol con otra consulta si lo necesitas)
        $cargo = 'ROL_ID_' . $id_rol; 

        $stmt_autocompletar = $pdo->prepare(
            "INSERT INTO personal_autocompletar (nombre_completo, documento, email, cargo) 
             VALUES (?, ?, ?, ?)"
        );
        $stmt_autocompletar->execute([$nombre_completo, $documento, $email, $cargo]);
        
        $pdo->commit();
        
        header('Location: ../index.php?page=login&success=Registro exitoso. Ahora puedes iniciar sesión.');
        exit();

    } catch (PDOException $e) {
        $pdo->rollBack();
        if ($e->getCode() == 23000) {
            header('Location: ../index.php?page=registro&error=El documento o correo ya están registrados.');
        } else {
            header('Location: ../index.php?page=registro&error=Error en el registro.');
        }
        exit();
    }
}
?>