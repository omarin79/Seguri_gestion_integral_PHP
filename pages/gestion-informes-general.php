<div id="gestion-informes-general-page" class="page-content active">
    <main>
        <section>
            <h1>Gestión de Informes (General)</h1>
            <p>Genere y consulte informes variados del sistema.</p>
            
            <form id="informes-general-form" action="actions/informes_action.php" method="POST">
                <label for="informe-tipo">Tipo de Informe:</label>
                <select id="informe-tipo" name="informe-tipo" required>
                    <option value="">Seleccione...</option>
                    <option value="novedades-historicas">Novedades Históricas</option>
                    <option value="rendimiento-personal">Rendimiento de Personal</option>
                    <option value="resumen-turnos">Resumen de Turnos</option>
                    <option value="visitas-supervision">Visitas de Supervisión</option>
                    <option value="alertas-generadas">Alertas Generadas</option>
                    <option value="otro">Otro</option>
                </select>

                <label for="informe-fecha-inicio">Fecha de Inicio:</label>
                <input type="date" id="informe-fecha-inicio" name="informe-fecha-inicio">

                <label for="informe-fecha-fin">Fecha de Fin:</label>
                <input type="date" id="informe-fecha-fin" name="informe-fecha-fin">

                <label for="informe-cedula">Cédula de Ciudadanía (Opcional):</label>
                <input type="text" id="informe-cedula" name="informe-cedula" placeholder="Ingrese C.C. si aplica">

                <label for="informe-puesto">Puesto de Trabajo (Opcional):</label>
                <select id="informe-puesto" name="informe-puesto">
                    <option value="">Todos</option>
                    <option value="1">Recepción Principal Edificio ABC</option>
                    <option value="2">Portería Vehicular La Floresta</option>
                </select>

                <label for="informe-turno">Turno (Opcional):</label>
                <select id="informe-turno" name="informe-turno">
                    <option value="">Todos</option>
                    <option value="mañana">Mañana</option>
                    <option value="tarde">Tarde</option>
                    <option value="noche">Noche</option>
                </select>

                <button type="submit">Generar Informe</button>
            </form>
        </section>
    </main>
</div>