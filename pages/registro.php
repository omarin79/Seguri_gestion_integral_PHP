<div id="registro-page" class="page-content active">
    <div class="login-container">
        <img src="images/logo_jh.png" alt="Logo SecuriGestiónIntegral" class="logo">
        <h1>Registro de Nuevo Usuario</h1>

        <form id="registro-form" action="actions/registro_action.php" method="POST">
            <?php if (isset($_GET['error'])): ?>
                <div class="error-message" style="display:block;"><?php echo htmlspecialchars($_GET['error']); ?></div>
            <?php endif; ?>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required>

            <label for="documento">Documento de Identidad:</label>
            <input type="text" id="documento" name="documento" required>

            <label for="email-registro">Correo Electrónico:</label>
            <input type="email" id="email-registro" name="email" required>

            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono">

            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion">

            <label for="fecha_contratacion">Fecha de Contratación:</label>
            <input type="date" id="fecha_contratacion" name="fecha_contratacion" required>
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