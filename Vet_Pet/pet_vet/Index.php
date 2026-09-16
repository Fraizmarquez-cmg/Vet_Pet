<?php
// Iniciar sesión para mantener los registros de pacientes disponibles en todo el sistema
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Capturar de forma segura la página actual desde la URL (por defecto carga 'login')
$page = isset($_GET['page']) ? $_GET['page'] : 'login';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetCare Vet - Sistema Veterinario</title>
    <!-- Hoja de estilos principal -->
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

    <?php
    // Enrutador principal del sistema
    switch ($page) {
        case 'clientes':
            include 'views/clientes.php';
            break;
        case 'citas':
            include 'views/citas.php';
            break;
        case 'historial':
            include 'views/historial.php';
            break;
        case 'consultar_historial':
            include 'views/historial_clinico.php';
            break;
        case 'login':
        default:
            include 'views/login.php';
            break;
    }
    ?>

</body>
</html>