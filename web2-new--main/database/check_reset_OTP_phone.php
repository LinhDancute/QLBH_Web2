<?php
require_once __DIR__ . "/connectDB.php";

if (isset($_POST['check-verify-phone'])) {
    $otp = $_POST['OTP'];

    // Check if OTP is correct
    $sql = "SELECT * FROM clients WHERE OTP = '$otp'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {

        // Update status from 'pending' to 'active'
        $sql = "UPDATE clients SET status='active' WHERE OTP =' $otp'";
        if ($conn->query($sql) === TRUE) {
            echo "Account verified successfully.";
            header("Location: ../page/reset_password/FormReset.php");
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "Invalid OTP.";
    }

    $conn->close();
}
