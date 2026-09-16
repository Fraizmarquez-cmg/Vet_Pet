<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Inicializar el listado de pacientes si no existe en la sesión
if (!isset($_SESSION['pacientes'])) {
    $_SESSION['pacientes'] = [
        ["id" => 103, "mascota" => "Tobby", "propietario" => "Danel Cano", "direccion" => "Calderon", "telefono" => "0993287336", "especie" => "Canino"],
        ["id" => 101, "mascota" => "Max", "propietario" => "Ana Martínez", "direccion" => "Av. De los Shyris N32", "telefono" => "0991234567", "especie" => "Canino"],
        ["id" => 102, "mascota" => "Luna", "propietario" => "Roberto Gómez", "direccion" => "Calle Guayaquil E4-12", "telefono" => "0987654321", "especie" => "Felino"]
    ];
}

// 2. LÓGICA PARA ELIMINAR
if (isset($_GET['eliminar'])) {
    $id_a_eliminar = $_GET['eliminar'];
    $_SESSION['pacientes'] = array_values(array_filter($_SESSION['pacientes'], function($p) use ($id_a_eliminar) {
        return $p['id'] != $id_a_eliminar;
    }));
    header("Location: index.php?page=clientes");
    exit();
}

// 3. LÓGICA PARA CARGAR DATOS EN EL FORMULARIO (EDITAR)
$paciente_editar = null;
if (isset($_GET['editar'])) {
    $id_editar = $_GET['editar'];
    foreach ($_SESSION['pacientes'] as $p) {
        if ($p['id'] == $id_editar) {
            $paciente_editar = $p;
            break;
        }
    }
}

// 4. LÓGICA PARA GUARDAR (NUEVO O ACTUALIZAR)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_paciente = $_POST['id_paciente'] ?? '';
    $propietario = $_POST['txtnom'] ?? '';
    $direccion = $_POST['txtdir'] ?? '';
    $telefono = $_POST['txtfone'] ?? '';
    $especie = $_POST['cbogen'] ?? '';
    $mascota = $_POST['mascota'] ?? '';

    if (!empty($id_paciente)) {
        // Actualizar paciente existente
        foreach ($_SESSION['pacientes'] as &$p) {
            if ($p['id'] == $id_paciente) {
                $p['propietario'] = $propietario;
                $p['direccion'] = $direccion;
                $p['telefono'] = $telefono;
                $p['especie'] = $especie;
                $p['mascota'] = $mascota;
                break;
            }
        }
    } else {
        // Crear nuevo paciente
        $nuevo_paciente = [
            "id" => rand(104, 999),
            "propietario" => $propietario,
            "direccion" => $direccion,
            "telefono" => $telefono,
            "especie" => $especie,
            "mascota" => $mascota
        ];
        $_SESSION['pacientes'][] = $nuevo_paciente;
    }

    header("Location: index.php?page=clientes");
    exit();
}
?>

<div class="app-container">
    <?php include 'includes/menu.php'; ?>

    <!-- FORMULARIO DE PACIENTES -->
    <section class="card">
        <h3>📋 <?= $paciente_editar ? 'Editar Paciente' : 'Registro de Pacientes y Dueños (frmclientes)' ?></h3>
        
        <form id="frmclientes" action="index.php?page=clientes" method="POST">
            <!-- Campo oculto con el ID si estamos editando -->
            <input type="hidden" name="id_paciente" value="<?= $paciente_editar ? htmlspecialchars($paciente_editar['id']) : '' ?>">

            <div class="form-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 15px;">
                <div class="form-group">
                    <label>Nombre del Dueño (txtnom)</label>
                    <input type="text" name="txtnom" placeholder="Ej. Ana Martínez" value="<?= $paciente_editar ? htmlspecialchars($paciente_editar['propietario']) : '' ?>" required>
                </div>

                <div class="form-group">
                    <label>Dirección Domiciliaria (txtdir)</label>
                    <input type="text" name="txtdir" placeholder="Ej. Av. De los Shyris N32" value="<?= $paciente_editar ? htmlspecialchars($paciente_editar['direccion']) : '' ?>" required>
                </div>

                <div class="form-group">
                    <label>Teléfono de Contacto (txtfone)</label>
                    <input type="text" name="txtfone" placeholder="Ej. 0991234567" value="<?= $paciente_editar ? htmlspecialchars($paciente_editar['telefono']) : '' ?>" required>
                </div>

                <div class="form-group">
                    <label>Categoría / Especie (cbogen)</label>
                    <select name="cbogen" required>
                        <option value="">-- Seleccionar Especie --</option>
                        <option value="Canino" <?= ($paciente_editar && $paciente_editar['especie'] == 'Canino') ? 'selected' : '' ?>>Canino</option>
                        <option value="Felino" <?= ($paciente_editar && $paciente_editar['especie'] == 'Felino') ? 'selected' : '' ?>>Felino</option>
                        <option value="Ave" <?= ($paciente_editar && $paciente_editar['especie'] == 'Ave') ? 'selected' : '' ?>>Ave</option>
                        <option value="Otro" <?= ($paciente_editar && $paciente_editar['especie'] == 'Otro') ? 'selected' : '' ?>>Otro</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Nombre de la Mascota</label>
                    <input type="text" name="mascota" placeholder="Ej. Max / Luna" value="<?= $paciente_editar ? htmlspecialchars($paciente_editar['mascota']) : '' ?>" required>
                </div>
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit" class="btn-primary" style="background-color: #0d9488; color: white; padding: 10px 15px; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">
                    <?= $paciente_editar ? 'Actualizar Paciente' : 'Guardar Paciente' ?>
                </button>
                
                <?php if ($paciente_editar): ?>
                    <a href="index.php?page=clientes" style="background-color: #64748b; color: white; padding: 10px 15px; border-radius: 4px; text-decoration: none; font-size: 14px; display: inline-block;">
                        Cancelar
                    </a>
                <?php endif; ?>
            </div>
        </form>
    </section>

    <!-- LISTADO / TABLA DE PACIENTES -->
    <section class="card" style="margin-top: 20px;">
        <h3>🐾 Listado de Pacientes Registrados (lstxgs)</h3>
        
        <div class="table-responsive">
            <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
                <thead>
                    <tr style="background-color: #f1f5f9; text-align: left;">
                        <th style="padding: 10px;">ID</th>
                        <th style="padding: 10px;">MASCOTA</th>
                        <th style="padding: 10px;">PROPIETARIO</th>
                        <th style="padding: 10px;">DIRECCIÓN</th>
                        <th style="padding: 10px;">TELÉFONO</th>
                        <th style="padding: 10px;">ESPECIE</th>
                        <th style="padding: 10px;">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($_SESSION['pacientes'])): ?>
                        <?php foreach ($_SESSION['pacientes'] as $p): ?>
                            <tr style="border-bottom: 1px solid #e2e8f0;">
                                <td style="padding: 10px;">#<?= htmlspecialchars($p['id']) ?></td>
                                <td style="padding: 10px;"><strong><?= htmlspecialchars($p['mascota']) ?></strong></td>
                                <td style="padding: 10px;"><?= htmlspecialchars($p['propietario']) ?></td>
                                <td style="padding: 10px;"><?= htmlspecialchars($p['direccion']) ?></td>
                                <td style="padding: 10px;"><?= htmlspecialchars($p['telefono']) ?></td>
                                <td style="padding: 10px;"><?= htmlspecialchars($p['especie']) ?></td>
                                <td style="padding: 10px;">
                                    <a href="index.php?page=clientes&editar=<?= $p['id'] ?>" style="background: #3b82f6; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 13px; margin-right: 5px; display: inline-block;">Editar</a>
                                    <a href="index.php?page=clientes&eliminar=<?= $p['id'] ?>" style="background: #ef4444; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 13px; display: inline-block;" onclick="return confirm('¿Estás seguro de eliminar a <?= htmlspecialchars($p['mascota']) ?>?');">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" style="text-align: center; color: #64748b; padding: 15px;">No hay pacientes registrados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>