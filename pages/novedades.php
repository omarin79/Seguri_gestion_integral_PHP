<div id="novedades-page" class="page-content active">
    <main>
        <section>
            <h1>Registro y Consulta de Novedades</h1>
            <p>Reporte eventos operativos y consulte el historial de novedades del sistema.</p>
        </section>

        <hr>

        <section id="registrar-novedad">
            <h2>Registrar Nueva Novedad</h2>
            
            <div class="form-group">
                <label for="tipo-novedad-registro">Seleccione el Tipo de Novedad:</label>
                <select id="tipo-novedad-registro" name="tipo_novedad_selector">
                    <option value="">-- Escoger una opción --</option>
                    <optgroup label="Novedades de Personal">
                        <option value="ausencia">Ausencia de Unidad</option>
                        <option value="incapacidad">Incapacidad Médica</option>
                        <option value="licencia-remunerada">Licencia Remunerada</option>
                        <option value="permiso-remunerado">Permiso Remunerado</option>
                        <option value="licencia-no-remunerada">Licencia No Remunerada</option>
                        <option value="permiso-no-remunerado">Permiso No Remunerado</option>
                    </optgroup>
                    <optgroup label="Novedades Operativas">
                        <option value="unidad-evadida">Unidad Evadida del Puesto</option>
                        <option value="condicion-insegura">Reporte de Condición Insegura</option>
                    </optgroup>
                </select>
            </div>

            <div id="novedad-form-container" style="margin-top: 20px;">
                <p>Por favor, seleccione un tipo de novedad para mostrar el formulario de registro.</p>
            </div>
        </section>

        <hr style="margin: 40px 0;">

        <section id="consultar-novedades">
            <h2>Últimas Novedades Registradas</h2>
            <p>Aquí puedes ver un historial de las últimas novedades reportadas en el sistema.</p>
            
            <button id="btn-consultar-novedades" type="button">Cargar Últimas Novedades</button>

            <div id="resultados-novedades" style="margin-top: 20px;">
                </div>
        </section>
    </main>
</div>