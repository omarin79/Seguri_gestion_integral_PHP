<div id="mi-perfil-page" class="page-content active">
    <main>
        <section>
            <h2>Mi Perfil</h2>
            <p>Aquí puedes actualizar tu información personal y foto de perfil.</p>

            <?php if (isset($_GET['success'])): ?>
                <div class="success-message" style="display:block; background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;"><?php echo htmlspecialchars(urldecode($_GET['success'])); ?></div>
            <?php elseif (isset($_GET['error'])): ?>
                 <div class="error-message" style="display:block;"><?php echo htmlspecialchars(urldecode($_GET['error'])); ?></div>
            <?php endif; ?>

            <fieldset>
                <legend>Cambiar Foto de Perfil</legend>
                <form action="actions/perfil_action.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="form_type" value="upload_photo">
                    
                    <img src="<?php echo htmlspecialchars($_SESSION['user_foto'] ?? 'images/user2-160x160.jpg'); ?>" alt="Foto de Perfil" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; margin-bottom: 15px;">
                    
                    <label for="foto_perfil">Selecciona una nueva imagen:</label>
                    <input type="file" name="foto_perfil" id="foto_perfil" accept="image/jpeg, image/png, image/gif" required>
                    <small>Archivos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB.</small>
                    
                    <button type="submit">Subir Foto</button>
                </form>
            </fieldset>
        </section>
    </main>
</div>