<div id="inicio-page" class="page-content active">
    <main>
        <h1>Inicio Principal</h1>
        <section id="seccion-mi-perfil-inicio">
            <h2>Información del Usuario:</h2>
            <ul>
                <li>Nombre: <span><?php echo htmlspecialchars($_SESSION['user_nombre'] ?? 'N/A'); ?></span></li>
                <li><a href="index.php?page=mi-perfil">Ver Perfil Completo</a></li>
            </ul>
        </section>

        <section id="seccion-plataforma-operativa-inicio">
            <h1>Plataforma Operativa</h1>
            <ul>
                <li><a href="index.php?page=gestion-informes-general">Gestión de Informes</a></li>
                <li><a href="index.php?page=registro-novedades-general">Registro/Consulta de Novedades</a></li>
                <li><a href="index.php?page=visualizacion-alertas">Visualización de Alertas</a></li>
            </ul>
        </section>

        <section id="seccion-talento-humano-inicio">
            <h1>Talento Humano</h1>
            <ul>
                <li><a href="index.php?page=talento-humano">Gestión de Cartas Laborales</a></li>
                <li><a href="index.php?page=mi-perfil">Actualizar Datos Personales</a></li>
            </ul>
        </section>

        <section id="seccion-nomina-inicio">
            <h1>Nómina</h1>
            <ul>
                <li><a href="index.php?page=nomina">Consultar/Descargar Desprendibles de Pago</a></li>
                <li><a href="index.php?page=nomina">Generar Certificado de Ingresos</a></li>
            </ul>
        </section>
    </main>
</div>