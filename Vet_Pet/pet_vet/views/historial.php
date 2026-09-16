<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Inicializar la sesión si aún no existe
if (!isset($_SESSION['pacientes'])) {
    $_SESSION['pacientes'] = [
        ["id" => 101, "mascota" => "Max", "propietario" => "Ana Martínez", "direccion" => "Av. De los Shyris N32", "telefono" => "0991234567", "especie" => "Canino"],
        ["id" => 102, "mascota" => "Luna", "propietario" => "Roberto Gómez", "direccion" => "Calle Guayaquil E4-12", "telefono" => "0987654321", "especie" => "Felino"]
    ];
}
?>

<div class="app-container">
    <?php include 'includes/menu.php'; ?>

    <section class="card">
        <h3>🩺 Ficha Médica e Historial (frmhistorial)</h3>
        <form id="frmhistorial" action="index.php?page=historial" method="POST">
            <div class="form-grid" style="grid-template-columns: 1fr 1fr;">
                <div class="form-group">
                    <label>Seleccionar Paciente</label>
                    <select name="paciente_historial">
                        <?php foreach ($_SESSION['pacientes'] as $p): ?>
                            <option value="<?= htmlspecialchars($p['mascota']) ?>">
                                <?= htmlspecialchars($p['mascota']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Peso Actual (kg)</label>
                    <input type="text" name="peso" placeholder="Ej. 14.2 kg">
                </div>
                <div class="form-group" style="grid-column: span 2;">
                    <label>Síntomas y Diagnóstico</label>
                    <textarea name="sintomas" rows="3" placeholder="Detalles de la revisión médica..."></textarea>
                </div>
                <div class="form-group" style="grid-column: span 2;">
                    <label>Prescripción Médica</label>
                    <textarea name="prescripcion" rows="3" placeholder="Medicamentos e indicaciones..."></textarea>
                </div>
            </div>
            <button type="submit" class="btn-primary">Registrar en Historial</button>
        </form>
    </section>
</div>