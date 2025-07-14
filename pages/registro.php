<?php
// C:\xampp\htdocs\securigestion\pages\registro.php

// Este pequeño script se conecta a la BD para obtener los roles
// La variable $pdo ya está disponible gracias al index.php
try {
    $stmt = $pdo->query("SELECT ID_Rol, NombreRol FROM Roles ORDER BY NombreRol");
    $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // En caso de error, la lista de roles estará vacía
    $roles = [];
}
?>

<div id="registro-page" class="page-content active">
    <div class="login-container">
        <img src="images/logo_jh.png" alt="Logo SecuriGestiónIntegral" class="logo">
        <h1>Registro de Nuevo Usuario</h1>
        
        <form id="registro-form" action="actions/registro_action.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required>

            <label for="documento">Documento de Identidad:</label>
            <input type="text" id="documento" name="documento" required>

            <label for="email-registro">Correo Electrónico:</label>
            <input type="email" id="email-registro" name="email" required>
            
            <label for="id_rol">Rol del Usuario:</label>
            <select id="id_rol" name="id_rol" required>
                <option value="">-- Seleccione un Rol --</option>
                <?php foreach ($roles as $rol): ?>
                    <option value="<?php echo htmlspecialchars($rol['ID_Rol']); ?>">
                        <?php echo htmlspecialchars($rol['NombreRol']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <label for="password-registro">Contraseña:</label>
            <input type="password" id="password-registro" name="password" required>

            <label for="confirmar-password">Confirmar Contraseña:</label>
            <input type="password" id="confirmar-password" name="confirm_password" required>

            <button type="submit">Registrar Usuario</button>

            <div class="login-links">
                <a href="index.php?page=login">Ya tengo cuenta</a>
            </div>
        </form>
    </div>
</div>