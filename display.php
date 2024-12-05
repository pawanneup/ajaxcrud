<?php
require_once('db.php');
require_once('helper.php');

$sql = "SELECT * FROM crud";  
$stmt  = $pdo->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

return response_json($result,200);