<?php
    include_once('db.php');

    
    if (isset($_POST['nameADD'], $_POST['emailADD'], $_POST['phoneADD'], $_POST['addressADD'])) {
        

        $nameADD = trim($_POST['nameADD']);
        $emailADD = trim($_POST['emailADD']);
        $phoneADD = trim($_POST['phoneADD']);
        $addressADD = trim($_POST['addressADD']);


        if (!filter_var($emailADD, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format.";
            exit;
        }


        if (!preg_match('/^\+?[0-9]{1,3}?[-. ]?(\(?\d{1,4}?\)?[-. ]?)?[\d]{1,4}[-. ]?[\d]{1,4}[-. ]?[\d]{1,9}$/', $phoneADD)) {
            echo "Invalid phone number format.";
            exit;
        }

        try {

            $sql = "INSERT INTO `crud` (name, email, phone, address) VALUES (:name, :email, :phone, :address)";
            $stmt = $pdo->prepare($sql);


            $stmt->bindParam(':name', $nameADD);
            $stmt->bindParam(':email', $emailADD);
            $stmt->bindParam(':phone', $phoneADD);
            $stmt->bindParam(':address', $addressADD);


            $stmt->execute();

            echo "Record added successfully.";
        } catch (PDOException $e) {

            error_log("Database Error: " . $e->getMessage(), 3, "errors.log");
            echo "An error occurred. Please try again later.";
        }
    } else {
        echo "Please fill in all the fields.";
    }
?>
