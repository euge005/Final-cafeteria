<?php
session_start();
// Si el usuario ya tiene sesión activa, lo mandamos directo adentro
if (isset($_SESSION['usuario_id'])) {
    header("Location: Cafeteria.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
</head>
<body>

<div class="login-container">
    <h2>Iniciar Sesión</h2>

    <?php if (isset($_GET['error'])): ?>
        <div class="error-box"><?php echo htmlspecialchars($_GET['error']); ?></div>
    <?php endif; ?>

    <form action="pros_login.php" method="POST">
        <div class="form-group">
            <label for="gmail">Correo Electrónico:</label>
            <input type="email" name="gmail" id="gmail" required >
        </div>
        
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required >
        </div>

        <button type="submit">Ingresar</button>
    </form>
</div>

</body>
</html>

