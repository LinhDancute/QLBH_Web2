<?php
require_once __DIR__ . "/connectDB.php";

if (isset($_POST['check-verify-email'])) {

        $otp = $_POST['OTP'];

        // Check if email exists
        $sql = "SELECT * FROM clients WHERE OTP = '$otp'";
        $result = $conn->query($sql);
        

        if ($result->num_rows == 1) {
            // The email exists, update OTP and timestamp
            $sql = "UPDATE clients SET status = 'active', created_at=NOW()";
            if ($conn->query($sql) === TRUE) {
                echo "Account verified successfully.";
                header("Location: ../index.php");
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } 
    else {
        echo "Email parameter is missing.";
    }

    $conn->close();
}
