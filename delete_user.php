<?php

require_once('db.php');  


if (isset($_GET['userId']) && is_numeric($_GET['userId'])) {
    $userId = $_GET['userId']; 
    

    try {
   
        $sql = "DELETE FROM crud WHERE id = :userId";
        $stmt = $pdo->prepare($sql);
        
 
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);


        $stmt->execute();

      
        if ($stmt->rowCount() > 0) {
           
            echo json_encode([
                'status' => 'success',
                'message' => 'User deleted successfully'
            ]);
        } else {

            echo json_encode([
                'status' => 'error',
                'message' => 'User not found'
            ]);
        }
    } catch (PDOException $e) {

        echo json_encode([
            'status' => 'error',
            'message' => 'Error deleting user: ' . $e->getMessage()
        ]);
    }
} else {

    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid user ID'
    ]);
}
?>
