<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

if (!is_logged_in()) {
    header('Location: ../index.php?page=login');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_type']) && $_POST['form_type'] === 'upload_photo') {
    $user_id = $_SESSION['user_id'];

    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['foto_perfil'];

        if ($file['size'] > 2 * 1024 * 1024) { // 2MB
            header('Location: ../index.php?page=mi-perfil&error=' . urlencode('El archivo es demasiado grande.'));
            exit();
        }

        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($file['type'], $allowed_types)) {
            header('Location: ../index.php?page=mi-perfil&error=' . urlencode('Tipo de archivo no permitido.'));
            exit();
        }

        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $new_filename = 'user_' . $user_id . '_' . time() . '.' . $extension;
        $upload_path = '../uploads/' . $new_filename;

        if (move_uploaded_file($file['tmp_name'], $upload_path)) {
            $db_path = 'uploads/' . $new_filename;
            $stmt = $pdo->prepare("UPDATE Usuarios SET FotoPerfilRuta = ? WHERE ID_Usuario = ?");
            $stmt->execute([$db_path, $user_id]);
            $_SESSION['user_foto'] = $db_path;

            header('Location: ../index.php?page=mi-perfil&success=' . urlencode('Foto actualizada.'));
            exit();
        } else {
            header('Location: ../index.php?page=mi-perfil&error=' . urlencode('Error al subir el archivo.'));
            exit();
        }
    } else {
        header('Location: ../index.php?page=mi-perfil&error=' . urlencode('No se seleccionó ningún archivo.'));
        exit();
    }
}
?>