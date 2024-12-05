<?php
$host = 'localhost';     
$dbname = 'ajaxcrud'; 
$username = 'root'; 
$password = ''; 
try {
    $dsn = "mysql:host=$host;dbname=$dbname";  
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
