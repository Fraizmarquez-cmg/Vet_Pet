<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Inicializar un historial de ejemplo si no existe en sesión
if (!isset($_SESSION['registros_historial'])) {
    $_SESSION['registros_historial'] = [
        ["mascota" => "Max", "peso" => "14.2 kg", "sintomas" => "Control general y revisión de rutina.", "prescripción" => "Ninguna, mascota saludable.", "fecha" => "2026-09-10"],
        ["mascota" => "Luna", "peso" => "4.5 kg", "sintomas" => "Leve estornudo y decaimiento.", "prescripción" => "Vitamina C y reposo por 3 días.", "fecha" => "2026-09-12"]
    ];
}

// Si se envió el formulario de la ficha médica, podemos capturarlo y guardarlo aquí también
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['paciente_historial'])) {
    $nuevo_historial = [
        "mascota" => $_POST['paciente_historial'] ?? '',
        "peso" => $_POST['peso'] ?? '',
        "sintomas" => $_POST['sintomas'] ?? '',
        "prescripción" => $_POST['prescripcion'] ?? '',
        "fecha" => date('Y-m-d')
    ];
    array_unshift($_SESSION['registros_historial'], $nuevo_historial);
}
?>

<div class="app-container">
    <?php include 'includes/menu.php'; ?>

    <section class="card">
        <h3>📂 Consulta de Datos y Registros Anteriores</h3>
        <p style="color: #64748b; font-size: 14px; margin-bottom: 20px;">Aquí puedes revisar el historial clínico previo de todas las mascotas atendidas en el sistema.</p>
        
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Mascota</th>
                        <th>Peso</th>
                        <th>Síntomas y Diagnóstico</th>
                        <th>Prescripción Médica</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($_SESSION['registros_historial'])): ?>
                        <?php foreach ($_SESSION['registros_historial'] as $h): ?>
                            <tr>
                                <td><?= htmlspecialchars($h['fecha']) ?></td>
                                <td><strong><?= htmlspecialchars($h['mascota']) ?></strong></td>
                                <td><?= htmlspecialchars($h['peso']) ?></td>
                                <td><?= htmlspecialchars($h['sintomas']) ?></td>
                                <td><?= htmlspecialchars($h['prescripción']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center; color: #64748b;">No hay registros anteriores guardados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>