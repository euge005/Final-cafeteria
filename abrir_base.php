
<?php
$host = 'localhost';
$db   = 'cafeteria'; // <--- ¡Aquí sumamos tu base de datos!
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
    // Creamos la variable $conne usando PDO
    $conne = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // Si falla, frena el código y te avisa
    die("Error al conectarse a la base de datos!!! " . $e->getMessage());
}
?>