<div id="preoperacional-vehiculos-page" class="page-content active">
    <main>
        <section>
            <h1>Registro Pre-operacional de Vehículos</h1>
            <p>Complete el checklist según el tipo de vehículo asignado.</p>

            <form id="preoperacional-form" action="actions/preoperacional_action.php" method="POST">
                <label for="tipo_vehiculo">1. Seleccione el Tipo de Vehículo:</label>
                <select id="tipo_vehiculo" name="tipo_vehiculo" required>
                    <option value="">-- Seleccione --</option>
                    <option value="carro">Carro</option>
                    <option value="moto">Moto</option>
                </select>

                <fieldset id="checklist_carro" style="display:none;">
                    <legend>Lista de Chequeo para Carro</legend>
                    <div><input type="checkbox" name="items_carro[]" value="luces_delanteras"> Luces delanteras (altas y bajas)</div>
                    <div><input type="checkbox" name="items_carro[]" value="luces_traseras"> Luces traseras (freno y direccionales)</div>
                    <div><input type="checkbox" name="items_carro[]" value="nivel_aceite"> Nivel de aceite</div>
                    <div><input type="checkbox" name="items_carro[]" value="nivel_refrigerante"> Nivel de líquido refrigerante</div>
                    <div><input type="checkbox" name="items_carro[]" value="presion_llantas"> Presión y estado de las llantas</div>
                    <div><input type="checkbox" name="items_carro[]" value="estado_frenos"> Estado de los frenos</div>
                    <div><input type="checkbox" name="items_carro[]" value="documentos_vehiculo"> Documentos del vehículo (SOAT, tecno)</div>
                </fieldset>

                <fieldset id="checklist_moto" style="display:none;">
                    <legend>Lista de Chequeo para Moto</legend>
                    <div><input type="checkbox" name="items_moto[]" value="luz_frontal"> Luz frontal</div>
                    <div><input type="checkbox" name="items_moto[]" value="luz_stop"> Luz de stop</div>
                    <div><input type="checkbox" name="items_moto[]" value="frenos"> Frenos (delantero y trasero)</div>
                    <div><input type="checkbox" name="items_moto[]" value="presion_llantas"> Presión y estado de las llantas</div>
                    <div><input type="checkbox" name="items_moto[]" value="cadena"> Tensión y lubricación de la cadena</div>
                    <div><input type="checkbox" name="items_moto[]" value="espejos"> Espejos retrovisores</div>
                    <div><input type="checkbox" name="items_moto[]" value="documentos_vehiculo"> Documentos de la moto (SOAT, tecno)</div>
                </fieldset>

                <label for="observaciones">Observaciones Adicionales:</label>
                <textarea id="observaciones" name="observaciones" rows="4"></textarea>

                <button type="submit" id="submit_preoperacional" style="display:none;">Guardar Registro</button>
            </form>
        </section>
    </main>

    <script>
        document.getElementById('tipo_vehiculo').addEventListener('change', function() {
            const checklistCarro = document.getElementById('checklist_carro');
            const checklistMoto = document.getElementById('checklist_moto');
            const submitButton = document.getElementById('submit_preoperacional');

            // Oculta ambos checklists y el botón de guardar
            checklistCarro.style.display = 'none';
            checklistMoto.style.display = 'none';
            submitButton.style.display = 'none';

            // Muestra el checklist y el botón según la selección
            if (this.value === 'carro') {
                checklistCarro.style.display = 'block';
                submitButton.style.display = 'block';
            } else if (this.value === 'moto') {
                checklistMoto.style.display = 'block';
                submitButton.style.display = 'block';
            }
        });
    </script>
</div>