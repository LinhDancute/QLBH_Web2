<?php
session_start();

if (!isset($_SESSION['user_token'])) {
    // user is not logged in, redirect to login page
    header("Location: index.php");
    die();
}

// logout the user if they clicked the logout link
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_start();
    session_unset();
    session_destroy();
    header("Location: index.php");
}

// display user info
$userinfo = $_SESSION['userinfo'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>My Account</title>
</head>

<body>
    <h1>Welcome, <?= $userinfo['Fullname'] ?></h1>
    <img src="<?= $userinfo['picture'] ?>" alt="" width="90px" height="90px">
    <ul>
        <li>Full Name: <?= $userinfo['Fullname'] ?></li>
        <li>Email Address: <?= $userinfo['email'] ?></li>
        <li><a href="./page/logout.php">Logout</a></li>
    </ul>
</body>

</html>