
  //  $conne = mysqli_connect("localhost","root","","cafeteria");
  //  if (!$conne) {
    //  die("error al conectarse a la base de datos!!!");
  //  }
// 

<?php
$host = 'localhost';
$db   = 'cafeteria';    
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // errores claros
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // arrays asociativos
    PDO::ATTR_EMULATE_PREPARES   => false,                  // seguridad real
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}