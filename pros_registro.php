<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitizamos y limpiamos las entradas
    $nombreInput   = trim($_POST['nombre']);
    $gmailInput    = trim($_POST['gmail']);
    $passwordInput = trim($_POST['password']);

    // Validación de campos vacíos
    if (empty($nombreInput) || empty($gmailInput) || empty($passwordInput)) {
        header("Location: registro.php?error=Por favor, completa todos los campos");
        exit;
    }

    // Configuración de tu Base de Datos
    $host = 'localhost';
    $db   = 'cafeteria'; // <-- Cambia esto por el nombre de tu BD
    $user = 'root'; 
    $pass = '';     
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    // 1. Verificar si el Gmail ya existe
    $stmtCheckEmail = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE gmail = :gmail LIMIT 1");
    $stmtCheckEmail->execute(['gmail' => $gmailInput]);
    
    if ($stmtCheckEmail->fetch()) {
        header("Location: registro.php?error=Este correo ya está registrado");
        exit;
    }

    // 2. Encriptar la contraseña
    $passwordHash = password_hash($passwordInput, PASSWORD_DEFAULT);

    // 3. Insertar directamente (el rol será 'cliente' por defecto gracias al SQL)
    $sqlInsert = "INSERT INTO usuarios (nombre, gmail, contraseña) VALUES (:nombre, :gmail, :password)";
    $stmtInsert = $pdo->prepare($sqlInsert);
    
    $stmtInsert->execute([
        'gmail'    => $gmailInput,
        'password' => $passwordHash
    ]);

    header("Location: registro.php?success=Cuenta de cliente creada con éxito");
    exit;

} catch (PDOException $e) {
    header("Location: registro.php?error=Error interno en el servidor");
    exit;
}
}