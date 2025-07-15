<?php
// Obtener los roles desde la base de datos para el menú desplegable
try {
    $stmt_roles = $pdo->query("SELECT ID_Rol, NombreRol FROM Roles ORDER BY NombreRol");
    $roles = $stmt_roles->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Manejar el error si no se pueden cargar los roles
    $roles = [];
    echo "<p style='color:red;'>Error al cargar los roles de usuario.</p>";
}
?>

<div id="registro-page" class="page-content active">
    <main>
        <section>
            <h1>Registro de Nuevo Usuario</h1>
            <p>Complete el formulario para crear un nuevo empleado en el sistema.</p>
        </section>

        <?php if (isset($_GET['status'])): ?>
            <div class="<?= $_GET['status'] === 'success' ? 'success-message' : 'error-message' ?>" style="display:block;">
                <?= htmlspecialchars($_GET['message']) ?>
            </div>
        <?php endif; ?>

        <form id="form-registro-usuario" action="actions/registro_action.php" method="POST" enctype="multipart/form-data">
            
            <h2>Información Personal</h2>
            <label for="reg-nombre">Nombres:</label>
            <input type="text" id="reg-nombre" name="nombre" required>

            <label for="reg-apellido">Apellidos:</label>
            <input type="text" id="reg-apellido" name="apellido" required>

            <label for="reg-documento">Documento de Identidad:</label>
            <input type="text" id="reg-documento" name="documento" required>

            <label for="reg-telefono">Teléfono:</label>
            <input type="tel" id="reg-telefono" name="telefono">

            <label for="reg-direccion">Dirección:</label>
            <input type="text" id="reg-direccion" name="direccion">

            <h2>Información de la Cuenta</h2>
            <label for="reg-email">Correo Electrónico:</label>
            <input type="email" id="reg-email" name="email" required>

            <label for="reg-password">Contraseña:</label>
            <input type="password" id="reg-password" name="password" required>

            <label for="reg-rol">Rol en el Sistema:</label>
            <select id="reg-rol" name="id_rol" required>
                <option value="">-- Seleccione un Rol --</option>
                <?php foreach ($roles as $rol): ?>
                    <option value="<?= htmlspecialchars($rol['ID_Rol']) ?>">
                        <?= htmlspecialchars($rol['NombreRol']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            
            <label for="reg-fecha-contratacion">Fecha de Contratación:</label>
            <input type="date" id="reg-fecha-contratacion" name="fecha_contratacion">

            <label for="reg-foto">Foto de Perfil (Opcional):</label>
            <input type="file" id="reg-foto" name="foto_perfil" accept="image/jpeg, image/png">

            <button type="submit">Registrar Usuario</button>
        </form>
    </main>
</div>