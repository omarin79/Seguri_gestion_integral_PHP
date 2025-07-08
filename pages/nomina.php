<div id="nomina-page" class="page-content active">
    <main>
        <section>
            <h1>Nómina</h1>
            <p>Realice consultas y genere reportes relacionados con su nómina.</p>
        </section>

        <section id="consultar-desprendibles">
            <h2>Consultar/Descargar Desprendibles de Pago</h2>
            <form id="form-consultar-desprendibles" action="actions/nomina_action.php" method="POST">
                <input type="hidden" name="action" value="consultar_desprendible">
                
                <label for="nomina-cedula-desprendible">Cédula del Empleado:</label>
                <input type="text" id="nomina-cedula-desprendible" name="cedula_empleado_desprendible" placeholder="Ingrese su cédula" required>
                
                <label for="nomina-nombre-desprendible">Nombre del Empleado:</label>
                <input type="text" id="nomina-nombre-desprendible" name="nombre_empleado_desprendible" readonly placeholder="Se autocompletará">

                <label for="nomina-ano-desprendible">Año:</label>
                <select id="nomina-ano-desprendible" name="ano_desprendible" required>
                    <option value="2025">2025</option>
                    <option value="2024">2024</option>
                    <option value="2023">2023</option>
                </select>

                <label for="nomina-mes-desprendible">Mes:</label>
                <select id="nomina-mes-desprendible" name="mes_desprendible" required>
                    <option value="">Seleccione Mes...</option>
                    <option value="01">Enero</option>
                    <option value="02">Febrero</option>
                    <option value="03">Marzo</option>
                    <option value="04">Abril</option>
                    <option value="05">Mayo</option>
                    <option value="06">Junio</option>
                    <option value="07">Julio</option>
                    <option value="08">Agosto</option>
                    <option value="09">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
                <button type="submit">Consultar Desprendible</button>
            </form>
            <div id="nomina-desprendible-resultado" style="margin-top:15px; display:none;">
                 </div>
        </section>

        <section id="generar-certificado-ingresos">
            <h2>Generar Certificado de Ingresos y Retenciones</h2>
            <form id="form-generar-certificado-ingresos" action="actions/nomina_action.php" method="POST">
                <input type="hidden" name="action" value="generar_certificado">

                <label for="nomina-cedula-certificado">Cédula del Empleado:</label>
                <input type="text" id="nomina-cedula-certificado" name="cedula_empleado_certificado" placeholder="Ingrese su cédula" required>

                <label for="nomina-nombre-certificado">Nombre del Empleado:</label>
                <input type="text" id="nomina-nombre-certificado" name="nombre_empleado_certificado" readonly placeholder="Se autocompletará">

                <label for="nomina-ano-certificado">Año Gravable:</label>
                <select id="nomina-ano-certificado" name="ano_certificado" required>
                    <option value="2024">2024</option>
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                </select>
                <button type="submit">Generar Certificado</button>
            </form>
             <div id="nomina-certificado-resultado" style="margin-top:15px; display:none;">
                </div>
        </section>
    </main>
</div>