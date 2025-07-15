<div id="talento-humano-page" class="page-content active">
    <main>
        <section>
            <h1>Talento Humano</h1>
            <p>Gestione la documentación y solicitudes del personal.</p>
        </section>

        <section id="solicitar-carta-laboral">
            <h2>Solicitar Carta Laboral</h2>
            <form id="form-solicitar-carta" action="actions/talento_humano_action.php" method="POST">
                <input type="hidden" name="action" value="solicitar_carta">
                <label for="th-cedula-carta">Cédula del Empleado:</label>
                <input type="text" id="th-cedula-carta" name="cedula_empleado_carta" 
                       data-autocomplete-nombre="th-nombre-carta" 
                       placeholder="Escribe la cédula para buscar..." autocomplete="off" required>
                
                <label for="th-nombre-carta">Nombre del Empleado:</label>
                <input type="text" id="th-nombre-carta" name="nombre_empleado_carta" readonly placeholder="Se autocompletará">

                <label for="th-tipo-carta">Tipo de Carta Laboral:</label>
                <select id="th-tipo-carta" name="tipo_carta" required>
                    <option value="">Seleccione...</option>
                    <option value="con_salario">Con funciones y salario</option>
                    <option value="sin_salario">Con funciones, sin salario</option>
                    <option value="basica">Básica (Solo cargo y tiempo)</option>
                </select>

                <button type="submit">Solicitar Carta</button>
            </form>
        </section>

        <section id="consultar-documentos-th">
            <h2>Consultar Documentos del Empleado</h2>
            <form id="form-consultar-documentos-th" method="POST">
                <label for="th-cedula-consulta-docs">Cédula del Empleado:</label>
                 <input type="text" id="th-cedula-consulta-docs" name="cedula_empleado_consulta_docs" 
                       data-autocomplete-nombre="th-nombre-consulta-docs" 
                       placeholder="Ingrese cédula para consultar" autocomplete="off" required>
                
                <label for="th-nombre-consulta-docs">Nombre del Empleado:</label>
                <input type="text" id="th-nombre-consulta-docs" name="nombre_empleado_consulta_docs" readonly placeholder="Se autocompletará">
                <button type="submit">Consultar Documentos</button>
            </form>

            <div id="resultados-documentos" style="margin-top: 20px;">
            </div>
        </section>
    </main>
</div>