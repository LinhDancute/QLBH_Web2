<?php
require_once __DIR__ . "/connectDB.php";

if (!empty($_POST['email'])) {
    $query_users = "SELECT * FROM users WHERE email='" . $_POST['email'] . "'";
    $result_users = mysqli_query($conn, $query_users);
    $count_users = mysqli_num_rows($result_users);

    $query_clients = "SELECT * FROM clients WHERE email='" . $_POST['email'] . "'";
    $result_clients = mysqli_query($conn, $query_clients);
    $count_clients = mysqli_num_rows($result_clients);


    if ($count_users > 0 || $count_clients > 0) {
        echo "<span style='color:green'> User ready to log in.</span>";
        echo "<script>$('#check-email-exist').prop('disabled', false);</script>";
    } else {
        echo "<span style='color:red'> User does not exist, please register.</span>";
        echo "<script>$('#check-email-exist').prop('disabled', true);</script>";
    }

}

if (!empty($_POST['phone'])) {
    // check if phone number has the correct format
    if (!preg_match('/^\+84\d{9}$/', $_POST['phone'])) {
        echo "<span style='color:red'> Phone number must start with '+84' and followed by 9 digits.</span>";
        echo "<script>$('#check-phone-exist').prop('disabled', true);</script>";
    } else {
        // check if phone number already exists in database
        $query_users = "SELECT * FROM users WHERE phone='" . $_POST['phone'] . "'";
        $result_users = mysqli_query($conn, $query_users);
        $count_users = mysqli_num_rows($result_users);

        $query_clients = "SELECT * FROM clients WHERE phone='" . $_POST['phone'] . "'";
        $result_clients = mysqli_query($conn, $query_clients);
        $count_clients = mysqli_num_rows($result_clients);

        if ($count_users > 0 || $count_clients > 0) {
            echo "<span style='color:green'> Phone Number ready to reset password.</span>";
            echo "<script>$('#check-phone-exist').prop('disabled', false);</script>";
        } else {
            echo "<span style='color:red'> User does not exist, please register.</span>";
            echo "<script>$('#check-phone-exist').prop('disabled', true);</script>";
        }
    }
}
