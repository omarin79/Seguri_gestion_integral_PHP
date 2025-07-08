// C:\xampp\htdocs\securigestion\js\main.js (Versión Final con Formularios Completos)

document.addEventListener('DOMContentLoaded', () => {

    // --- LÓGICA PARA CARGAR FORMULARIOS DE NOVEDADES DINÁMICAMENTE ---

    const tipoNovedadSelect = document.getElementById('tipo-novedad-registro');
    const formContainer = document.getElementById('novedad-form-container');

    // Este objeto ahora contiene el HTML completo y detallado de tus formularios originales.
    const formsHtml = {
        'ausencia': `
            <form id="form-registro-ausencia" action="actions/novedad_action.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="tipo_novedad" value="ausencia">
                <h3>Registrar Ausencia de Unidad</h3>
                <label for="reg-ausencia-cedula">Cédula de Ciudadanía de la Unidad Ausente:</label>
                <input type="text" id="reg-ausencia-cedula" name="cedula" data-autocomplete-nombre="reg-ausencia-nombre" autocomplete="off" required placeholder="Ej: 1012345678">
                <label for="reg-ausencia-nombre">Nombre de la Unidad Ausente:</label>
                <input type="text" id="reg-ausencia-nombre" name="nombre_unidad" readonly placeholder="Se autocompletará">
                <label for="reg-ausencia-puesto">Puesto de Trabajo Afectado:</label>
                <select id="reg-ausencia-puesto" name="puesto_afectado" required><option value="">Seleccione...</option><option value="recepcion-abc">Recepción Principal Edificio ABC</option><option value="porteria-floresta">Portería Vehicular La Floresta</option></select>
                <label for="reg-ausencia-turno">Turno Afectado:</label>
                <select id="reg-ausencia-turno" name="turno_afectado" required><option value="">Seleccione...</option><option value="mañana">Mañana</option><option value="tarde">Tarde</option><option value="noche">Noche</option></select>
                <label for="reg-ausencia-fecha-inicio">Fecha y Hora Inicio Ausencia:</label>
                <input type="datetime-local" id="reg-ausencia-fecha-inicio" name="fecha_inicio" required>
                <label for="reg-ausencia-fecha-fin">Fecha y Hora Fin Ausencia (Estimado):</label>
                <input type="datetime-local" id="reg-ausencia-fecha-fin" name="fecha_fin" required>
                <label for="reg-ausencia-observaciones">Observaciones Adicionales:</label>
                <textarea id="reg-ausencia-observaciones" name="observaciones" rows="3" placeholder="Detalles de la ausencia"></textarea>
                <label for="reg-ausencia-evidencia">Evidencia (Opcional):</label>
                <input type="file" id="reg-ausencia-evidencia" name="evidencia_ausencia" accept="image/*,application/pdf"><small>Adjunte una imagen o PDF si es necesario.</small>
                <button type="submit">Registrar Ausencia</button>
            </form>`,
        'incapacidad': `
            <form id="form-registro-incapacidad" action="actions/novedad_action.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="tipo_novedad" value="incapacidad">
                <h3>Registrar Incapacidad</h3>
                <label for="reg-incapacidad-cedula">Cédula de Ciudadanía del Empleado:</label>
                <input type="text" id="reg-incapacidad-cedula" name="cedula" data-autocomplete-nombre="reg-incapacidad-nombre" autocomplete="off" required>
                <label for="reg-incapacidad-nombre">Nombre del Empleado:</label>
                <input type="text" id="reg-incapacidad-nombre" name="nombre_empleado" readonly placeholder="Se autocompletará">
                <label for="reg-incapacidad-tipo">Tipo de Incapacidad:</label>
                <select id="reg-incapacidad-tipo" name="tipo_incapacidad" required><option value="">Seleccione...</option><option value="general">Enfermedad General</option><option value="laboral">Accidente Laboral</option><option value="maternidad">Maternidad/Paternidad</option></select>
                <label for="reg-incapacidad-fecha-inicio">Fecha de Inicio de Incapacidad:</label>
                <input type="date" id="reg-incapacidad-fecha-inicio" name="fecha_inicio_incapacidad" required>
                <label for="reg-incapacidad-dias">Número de Días Incapacidad:</label>
                <input type="number" id="reg-incapacidad-dias" name="dias_incapacidad" min="1" required>
                <label for="reg-incapacidad-diagnostico">Diagnóstico (Opcional):</label>
                <textarea id="reg-incapacidad-diagnostico" name="diagnostico" rows="2" placeholder="Breve descripción del diagnóstico"></textarea>
                <label for="reg-incapacidad-soporte">Soporte Médico (Certificado):</label>
                <input type="file" id="reg-incapacidad-soporte" name="soporte_incapacidad" accept="image/*,application/pdf" required><small>Adjunte el certificado médico.</small>
                <button type="submit">Registrar Incapacidad</button>
            </form>`,
        'licencia-remunerada': `
            <form id="form-registro-licencia-remunerada" action="actions/novedad_action.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="tipo_novedad" value="licencia_remunerada">
                <h3>Registrar Licencia Remunerada</h3>
                <label for="reg-lic-rem-cedula">Cédula de Ciudadanía del Empleado:</label>
                <input type="text" id="reg-lic-rem-cedula" name="cedula" data-autocomplete-nombre="reg-lic-rem-nombre" autocomplete="off" required>
                <label for="reg-lic-rem-nombre">Nombre del Empleado:</label>
                <input type="text" id="reg-lic-rem-nombre" name="nombre_empleado" readonly placeholder="Se autocompletará">
                <label for="reg-lic-rem-motivo">Motivo:</label>
                <select id="reg-lic-rem-motivo" name="motivo_licencia" required><option value="">Seleccione...</option><option value="luto">Luto</option><option value="matrimonio">Matrimonio</option></select>
                <label for="reg-lic-rem-fecha-inicio">Fecha Inicio:</label>
                <input type="date" id="reg-lic-rem-fecha-inicio" name="fecha_inicio_licencia" required>
                <label for="reg-lic-rem-dias">Días:</label>
                <input type="number" id="reg-lic-rem-dias" name="dias_licencia" min="1" required>
                <label for="reg-lic-rem-soporte">Soporte:</label>
                <input type="file" id="reg-lic-rem-soporte" name="soporte_licencia" accept="image/*,application/pdf">
                <button type="submit">Registrar Licencia Remunerada</button>
            </form>`,
        'permiso-remunerado': `
            <form id="form-registro-permiso-remunerado" action="actions/novedad_action.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="tipo_novedad" value="permiso_remunerado">
                <h3>Registrar Permiso Remunerado</h3>
                <label for="reg-perm-rem-cedula">Cédula Empleado:</label>
                <input type="text" id="reg-perm-rem-cedula" name="cedula" data-autocomplete-nombre="reg-perm-rem-nombre" autocomplete="off" required>
                <label for="reg-perm-rem-nombre">Nombre Empleado:</label>
                <input type="text" id="reg-perm-rem-nombre" name="nombre_empleado" readonly placeholder="Se autocompletará">
                <label for="reg-perm-rem-motivo">Motivo:</label>
                <textarea id="reg-perm-rem-motivo" name="motivo_permiso" rows="2" required></textarea>
                <label for="reg-perm-rem-fecha">Fecha:</label>
                <input type="date" id="reg-perm-rem-fecha" name="fecha_permiso" required>
                <label for="reg-perm-rem-hora-inicio">Hora Inicio:</label>
                <input type="time" id="reg-perm-rem-hora-inicio" name="hora_inicio" required>
                <label for="reg-perm-rem-hora-fin">Hora Fin:</label>
                <input type="time" id="reg-perm-rem-hora-fin" name="hora_fin" required>
                <button type="submit">Registrar Permiso Remunerado</button>
            </form>`,
        'licencia-no-remunerada': `
             <form id="form-registro-licencia-no-remunerada" action="actions/novedad_action.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="tipo_novedad" value="licencia_no_remunerada">
                <h3>Registrar Licencia No Remunerada</h3>
                <label for="reg-lic-no-rem-cedula">Cédula Empleado:</label>
                <input type="text" id="reg-lic-no-rem-cedula" name="cedula" data-autocomplete-nombre="reg-lic-no-rem-nombre" autocomplete="off" required>
                <label for="reg-lic-no-rem-nombre">Nombre Empleado:</label>
                <input type="text" id="reg-lic-no-rem-nombre" name="nombre_empleado" readonly placeholder="Se autocompletará">
                <label for="reg-lic-no-rem-motivo">Motivo:</label>
                <textarea id="reg-lic-no-rem-motivo" name="motivo_licencia" rows="3" required></textarea>
                <label for="reg-lic-no-rem-fecha-inicio">Fecha Inicio:</label>
                <input type="date" id="reg-lic-no-rem-fecha-inicio" name="fecha_inicio_licencia" required>
                <label for="reg-lic-no-rem-dias">Días (Estimado):</label>
                <input type="number" id="reg-lic-no-rem-dias" name="dias_licencia" min="1" required>
                <button type="submit">Registrar Licencia No Remunerada</button>
            </form>`,
        'permiso-no-remunerado': `
            <form id="form-registro-permiso-no-remunerado" action="actions/novedad_action.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="tipo_novedad" value="permiso_no_remunerado">
                <h3>Registrar Permiso No Remunerado</h3>
                <label for="reg-perm-no-rem-cedula">Cédula Empleado:</label>
                <input type="text" id="reg-perm-no-rem-cedula" name="cedula" data-autocomplete-nombre="reg-perm-no-rem-nombre" autocomplete="off" required>
                <label for="reg-perm-no-rem-nombre">Nombre Empleado:</label>
                <input type="text" id="reg-perm-no-rem-nombre" name="nombre_empleado" readonly placeholder="Se autocompletará">
                <label for="reg-perm-no-rem-motivo">Motivo:</label>
                <textarea id="reg-perm-no-rem-motivo" name="motivo_permiso" rows="2" required></textarea>
                <label for="reg-perm-no-rem-fecha">Fecha:</label>
                <input type="date" id="reg-perm-no-rem-fecha" name="fecha_permiso" required>
                <label for="reg-perm-no-rem-hora-inicio">Hora Inicio:</label>
                <input type="time" id="reg-perm-no-rem-hora-inicio" name="hora_inicio" required>
                <label for="reg-perm-no-rem-hora-fin">Hora Fin:</label>
                <input type="time" id="reg-perm-no-rem-hora-fin" name="hora_fin" required>
                <button type="submit">Registrar Permiso No Remunerado</button>
            </form>`,
        'unidad-evadida': `
            <form id="form-registro-unidad-evadida" action="actions/novedad_action.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="tipo_novedad" value="unidad_evadida">
                <h3>Registrar Unidad Evadida</h3>
                <label for="reg-evadida-cedula">Cédula Unidad Evadida:</label>
                <input type="text" id="reg-evadida-cedula" name="cedula" data-autocomplete-nombre="reg-evadida-nombre" autocomplete="off" required>
                <label for="reg-evadida-nombre">Nombre Unidad Evadida:</label>
                <input type="text" id="reg-evadida-nombre" name="nombre_unidad" readonly placeholder="Se autocompletará">
                <label for="reg-evadida-puesto">Puesto:</label>
                <select id="reg-evadida-puesto" name="puesto_evadido" required><option value="">Seleccione...</option><option value="recepcion-abc">Recepción ABC</option></select>
                <label for="reg-evadida-hora">Hora Evasión (Estimada):</label>
                <input type="time" id="reg-evadida-hora" name="hora_evasion" required>
                <label for="reg-evadida-circunstancias">Circunstancias:</label>
                <textarea id="reg-evadida-circunstancias" name="circunstancias" rows="4" required></textarea>
                <button type="submit">Registrar Unidad Evadida</button>
            </form>`,
        'condicion-insegura': `
            <form id="form-registro-condicion-insegura" action="actions/novedad_action.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="tipo_novedad" value="condicion_insegura">
                <h3>Reporte de Condición Insegura</h3>
                <label for="reg-condicion-ubicacion">Ubicación/Puesto:</label>
                <input type="text" id="reg-condicion-ubicacion" name="ubicacion" required>
                <label for="reg-condicion-descripcion">Descripción Detallada:</label>
                <textarea id="reg-condicion-descripcion" name="descripcion" rows="5" required></textarea>
                <label for="reg-condicion-tipo">Tipo Condición:</label>
                <select id="reg-condicion-tipo" name="tipo_condicion" required><option value="">Seleccione...</option><option value="infraestructura">Infraestructura</option></select>
                <label for="reg-condicion-severidad">Severidad:</label>
                <select id="reg-condicion-severidad" name="severidad" required><option value="">Seleccione...</option><option value="bajo">Bajo</option></select>
                <label for="reg-condicion-reportante-cedula">Cédula Reportante:</label>
                <input type="text" id="reg-condicion-reportante-cedula" name="cedula_reportante" data-autocomplete-nombre="reg-condicion-reportante-nombre" autocomplete="off" required>
                <label for="reg-condicion-reportante-nombre">Nombre Reportante:</label>
                <input type="text" id="reg-condicion-reportante-nombre" name="nombre_reportante" readonly placeholder="Se autocompletará">
                <label for="reg-condicion-evidencia">Evidencia Fotográfica (Opcional):</label>
                <input type="file" id="reg-condicion-evidencia" name="evidencia_condicion" accept="image/*">
                <button type="submit">Reportar Condición Insegura</button>
            </form>`
    };

    if (tipoNovedadSelect) {
        tipoNovedadSelect.addEventListener('change', () => {
            const selectedType = tipoNovedadSelect.value;
            if (formContainer && selectedType && formsHtml[selectedType]) {
                formContainer.innerHTML = formsHtml[selectedType];
                activarAutocompleteEnNuevosInputs();
            } else if (formContainer) {
                formContainer.innerHTML = '<p>Seleccione un tipo de novedad para ver el formulario.</p>';
            }
        });
    }

    // --- LÓGICA DE AUTOCOMPLETAR (REUTILIZABLE) ---
    function activarAutocompleteEnNuevosInputs() {
        const autocompleteInputs = document.querySelectorAll('input[data-autocomplete-nombre]');
        
        autocompleteInputs.forEach(inputCedula => {
            if (inputCedula.getAttribute('data-listener-added') === 'true') return;

            const idInputNombre = inputCedula.dataset.autocompleteNombre;
            const inputNombre = document.getElementById(idInputNombre);
            
            let resultsContainer = inputCedula.parentNode.querySelector('.autocomplete-results');
            if (!resultsContainer) {
                resultsContainer = document.createElement('div');
                resultsContainer.className = 'autocomplete-results';
                inputCedula.parentNode.style.position = 'relative';
                inputCedula.parentNode.appendChild(resultsContainer);
            }

            inputCedula.addEventListener('input', async () => {
                const term = inputCedula.value;
                resultsContainer.innerHTML = '';
                
                if (term.length < 2) return;

                try {
                    const response = await fetch(`actions/autocomplete_action.php?term=${term}`);
                    if (!response.ok) return;
                    const suggestions = await response.json();

                    suggestions.forEach(suggestion => {
                        const suggestionDiv = document.createElement('div');
                        suggestionDiv.className = 'autocomplete-suggestion';
                        suggestionDiv.textContent = suggestion.label;
                        
                        suggestionDiv.addEventListener('click', () => {
                            inputCedula.value = suggestion.value;
                            if (inputNombre) inputNombre.value = suggestion.nombre;
                            resultsContainer.innerHTML = '';
                        });
                        resultsContainer.appendChild(suggestionDiv);
                    });
                } catch (error) {
                    console.error("Error en autocompletar:", error);
                }
            });

            document.addEventListener('click', (e) => {
                if (e.target !== inputCedula) {
                    resultsContainer.innerHTML = '';
                }
            });
            inputCedula.setAttribute('data-listener-added', 'true');
        });
    }

    activarAutocompleteEnNuevosInputs();
});