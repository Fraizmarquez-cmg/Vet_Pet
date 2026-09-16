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
        <h3>📅 Agendamiento de Citas (frmcitas)</h3>
        <form id="frmcitas" action="index.php?page=citas" method="POST">
            <div class="form-grid">
                <div class="form-group">
                    <label>Mascota / Paciente</label>
                    <select name="mascota_cita">
                        <?php foreach ($_SESSION['pacientes'] as $p): ?>
                            <option value="<?= htmlspecialchars($p['mascota']) ?>">
                                <?= htmlspecialchars($p['mascota']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tipo de Servicio</label>
                    <select name="servicio">
                        <option>Consulta General</option>
                        <option>Vacunación</option>
                        <option>Peluquería</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Fecha</label>
                    <input type="date" name="fecha">
                </div>
                <div class="form-group">
                    <label>Hora</label>
                    <input type="time" name="hora">
                </div>
            </div>
            <button type="submit" class="btn-primary">Confirmar Cita</button>
        </form>
    </section>
</div>