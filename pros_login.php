<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Limpiamos los datos del formulario
    $correoInput   = trim($_POST['gmail']);
    $passwordInput = trim($_POST['password']);

    // Validación básica de campos vacíos
    if (empty($correoInput) || empty($passwordInput)) {
        header("Location: login.php?error=Por favor, llena todos los campos");
        exit;
    }

    // Configuración de tu Base de Datos
   
    require __DIR__ . '/abrir_base.php';

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);

        // Consulta limpia: Buscamos al usuario por su correo electrónico
        $stmt = $pdo->prepare("SELECT id_usuario, PASSWORD, rol FROM usuarios WHERE gmail = :correo LIMIT 1");
        
        $stmt->execute(['correo' => $correoInput]);
        $usuario = $stmt->fetch();

        // Verificamos si existe el usuario y si la contraseña (hash) coincide
        if ($usuario && password_verify($passwordInput, $usuario['PASSWORD'])) {
            
            // Login exitoso: Guardamos los datos estrictamente necesarios en la sesión
            $_SESSION['usuario_id']  = $usuario['id_usuario'];
            $_SESSION['usuario_rol']   = $usuario['rol'];
            // $_SESSION['usuario_dni']   = $usuario['dni'];
            $_SESSION['usuario_email'] = $correoInput;

            // Redirección automática según el rol que tenga en tu tabla
            if ($usuario['rol'] === 'admin') {
                header("Location: menu_cafeteria.php");
            } else {
                header("Location: Cafeteria.html");
            }
            exit;

        } else {
            // Error genérico para no dar pistas a posibles atacantes
            header("Location: login.php?error=El correo o la contraseña son incorrectos");
            exit;
        }

    } catch (PDOException $e) {
        // En producción, cambia esto por un registro de log interno
        header("Location: login.php?error=Error interno en el servidor");
        exit;
    }
} else {
    header("Location: menu.php");
    exit;
}