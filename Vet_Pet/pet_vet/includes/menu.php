<div class="top-menu" style="background: #0d9488; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; color: white; border-radius: 6px; margin-bottom: 20px;">
    <div class="brand-title" style="font-weight: bold; font-size: 18px;">🐾 PetCare Vet</div>
    <nav style="display: flex; gap: 15px; align-items: center;">
        <a href="index.php?page=clientes" style="color: white; text-decoration: none; font-weight: 500; <?= ($page == 'clientes') ? 'text-decoration: underline;' : '' ?>">Clientes y Mascotas</a>
        <a href="index.php?page=citas" style="color: white; text-decoration: none; font-weight: 500; <?= ($page == 'citas') ? 'text-decoration: underline;' : '' ?>">Agendar Citas</a>
        <a href="index.php?page=historial" style="color: white; text-decoration: none; font-weight: 500; <?= ($page == 'historial') ? 'text-decoration: underline;' : '' ?>">Ficha Médica</a>
        <a href="index.php?page=consultar_historial" style="color: white; text-decoration: none; font-weight: 500; <?= ($page == 'consultar_historial') ? 'text-decoration: underline;' : '' ?>">Ver Historiales</a>
        <a href="index.php?page=login" style="background: #e11d48; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 14px;">Salir</a>
    </nav>
</div>