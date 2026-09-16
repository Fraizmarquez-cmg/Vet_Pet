<div class="app-container" style="display: flex; justify-content: center; align-items: center; min-height: 90vh;">
    <section class="card" style="width: 100%; max-width: 400px; padding: 30px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; background: white;">
        <div style="text-align: center; margin-bottom: 20px;">
            <h3 style="color: #0d9488; margin: 0 0 5px 0;">🐾 Bienvenido a PetCare Vet</h3>
            <p style="color: #64748b; font-size: 14px; margin: 0;">Ingrese sus credenciales para acceder al sistema</p>
        </div>

        <form action="index.php?page=clientes" method="POST">
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="usuario" style="display: block; margin-bottom: 5px; font-weight: 500;">Usuario</label>
                <input type="text" id="usuario" name="usuario" value="Fraiz" required style="width: 100%; padding: 8px; border: 1px solid #cbd5e1; border-radius: 4px;">
            </div>

            <div class="form-group" style="margin-bottom: 25px;">
                <label for="password" style="display: block; margin-bottom: 5px; font-weight: 500;">Contraseña</label>
                <input type="password" id="password" name="password" value="123456" required style="width: 100%; padding: 8px; border: 1px solid #cbd5e1; border-radius: 4px;">
            </div>

            <button type="submit" class="btn-primary" style="width: 100%; padding: 10px; background-color: #0d9488; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">
                Ingresar al Sistema
            </button>
        </form>
    </section>
</div>