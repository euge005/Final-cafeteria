<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f3f4f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .registro-container { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 100%; max-width: 340px; }
        h2 { text-align: center; margin-bottom: 20px; color: #333; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; color: #555; }
        .form-group input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #10b981; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; transition: background 0.2s; }
        button:hover { background: #059669; }
        .error-box { background: #fee2e2; color: #dc2626; padding: 10px; border-radius: 4px; margin-bottom: 15px; font-size: 14px; text-align: center; border: 1px solid #fca5a5; }
        .success-box { background: #d1fae5; color: #065f46; padding: 10px; border-radius: 4px; margin-bottom: 15px; font-size: 14px; text-align: center; border: 1px solid #6ee7b7; }
        .link { display: block; text-align: center; margin-top: 15px; color: #2563eb; text-decoration: none; font-size: 14px; }
    </style>
</head>
<body>

<div class="registro-container">
    <h2>Crear Cuenta</h2>

    <?php if (isset($_GET['error'])): ?>
        <div class="error-box"><?php echo htmlspecialchars($_GET['error']); ?></div>
    <?php endif; ?>
    
    <?php if (isset($_GET['success'])): ?>
        <div class="success-box"><?php echo htmlspecialchars($_GET['success']); ?></div>
    <?php endif; ?>

    <form action="pros_registro.php" method="POST" enctype>
        <div class="form-group">
            <label for="nombre">Nombre Completo:</label>
            <input type="text" name="nombre" id="nombre" required placeholder="Tu nombre">
        </div>

        <div class="form-group">
            <label for="gmail">Correo Electrónico (Gmail):</label>
            <input type="email" name="gmail" id="gmail" required >
        </div>
        
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password"  minlength="6">
        </div>

        <button type="submit">Registrarse</button>
    </form>
    
    <a href="login.php" class="link">¿Ya tienes cuenta? Inicia sesión</a>
</div>

</body>
</html>