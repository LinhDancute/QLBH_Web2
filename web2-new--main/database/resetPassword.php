<?php
require_once __DIR__ . "/connectDB.php";

if (isset($_POST['Accept'])) {
    $password = $_POST['password'];
    $confirmPassword = $_POST['repeat_password'];

    if ($password != $confirmPassword) {
        echo "Passwords do not match.";
    } else {
        // Update password for the user
        $sql = "UPDATE clients SET password='$password' WHERE status='active'";
        if ($conn->query($sql) === TRUE) {
            echo "Password updated successfully.";
            header("Location: ../index.php");
        } else {
            echo "Error updating password: " . $conn->error;
        }
    }

    $conn->close();
}
