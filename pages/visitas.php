<?php
// Obtener clientes para el desplegable
$stmt_clientes = $pdo->query("SELECT ID_Cliente, NombreEmpresa FROM Clientes ORDER BY NombreEmpresa");
$clientes = $stmt_clientes->fetchAll(PDO::FETCH_ASSOC);

// Obtener tipos de checklist para el desplegable
$stmt_checklists = $pdo->query("SELECT ID_Checklist, NombreChecklist FROM Checklists WHERE Activo = 1 ORDER BY NombreChecklist");
$checklists = $stmt_checklists->fetchAll(PDO::FETCH_ASSOC);
?>

<div id="visitas-page" class="page-content active">
    <main>
        <section>
            <h1>Registro de Visita de Supervisión</h1>
            <p>Complete el siguiente formulario para registrar una nueva visita y su checklist asociado.</p>
        </section>

        <form id="form-visita-supervision" action="actions/visita_action.php" method="POST">

            <h2>1. Detalles de la Visita</h2>

            <label for="visita-cliente">Cliente Visitado:</label>
            <select id="visita-cliente" name="id_cliente" required>
                <option value="">-- Seleccione un Cliente --</option>
                <?php foreach ($clientes as $cliente): ?>
                    <option value="<?= htmlspecialchars($cliente['ID_Cliente']) ?>">
                        <?= htmlspecialchars($cliente['NombreEmpresa']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="visita-vigilante-cedula">Cédula del Vigilante Auditado:</label>
            <input type="text" id="visita-vigilante-cedula" name="cedula_auditado" 
                   data-autocomplete-nombre="visita-vigilante-nombre" 
                   placeholder="Buscar por cédula..." autocomplete="off" required>

            <label for="visita-vigilante-nombre">Nombre del Vigilante:</label>
            <input type="text" id="visita-vigilante-nombre" name="nombre_auditado" readonly>

            <label for="visita-vigilante-telefono">Teléfono Celular:</label>
            <input type="text" id="visita-vigilante-telefono" name="telefono_auditado" placeholder="Ej: 3001234567">

            <label for="visita-direccion-puesto">Dirección del Puesto:</label>
            <input type="text" id="visita-direccion-puesto" name="direccion_puesto" placeholder="Dirección del puesto de trabajo">

            <input type="hidden" id="visita-latitud" name="latitud_gps">
            <input type="hidden" id="visita-longitud" name="longitud_gps">
            <button type="button" id="btn-obtener-gps">Obtener Coordenadas GPS</button>
            <div id="gps-status" style="margin-top: 5px;"></div>

            <hr>

            <h2>2. Checklist de la Visita</h2>
            <label for="visita-checklist-tipo">Tipo de Checklist a Realizar:</label>
            <select id="visita-checklist-tipo" name="id_checklist" required>
                <option value="">-- Seleccione un Checklist --</option>
                <?php foreach ($checklists as $checklist): ?>
                    <option value="<?= htmlspecialchars($checklist['ID_Checklist']) ?>">
                        <?= htmlspecialchars($checklist['NombreChecklist']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <div id="checklist-container" style="margin-top: 20px;"></div>

            <hr>

            <h2>3. Hallazgos y Recomendaciones</h2>
            <label for="visita-hallazgos">Hallazgos (Positivos y Negativos):</label>
            <textarea id="visita-hallazgos" name="hallazgos_generales" rows="5"></textarea>

            <label for="visita-recomendaciones">Recomendaciones (Acciones Correctivas y Preventivas):</label>
            <textarea id="visita-recomendaciones" name="recomendaciones" rows="5"></textarea>

            <button type="submit" style="margin-top: 20px;">Guardar Visita y Checklist</button>
        </form>
    </main>
</div>