<?php
require_once __DIR__ . "/../database/connectDB.php";
session_start(); // start the session 

if (!isset($_SESSION['user_token']) && !isset($_SESSION['email'])) {
    // user is not logged in, redirect to login page
    header("Location: index.php");
    die();
}

// display user info
if (isset($_SESSION['user_token'])) {
    // user logged in via Google
    $userinfo = $_SESSION['userinfo'];
    $email = $userinfo['email'];
    $fullname = $userinfo['Fullname'];

    $sql = "SELECT * FROM googleuser WHERE email ='{$userinfo['email']}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $address = isset($_SESSION['address']) ? $_SESSION['address'] : null;
    // you can add more fields here if needed
} else {
    // user logged in normally
    $email = $_SESSION['email'];
    // query the clients table for user info
    $sql = "SELECT * FROM clients WHERE email='$email'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $phone = $row['phone'];
    $address = $row['address'];
    // you can add more fields here

}

// close database connection
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>My Account</title>
</head>

<body>
    <?php if (isset($_SESSION['user_token'])) { ?>
        <h1>Welcome, <?= $fullname ?></h1>
        <img src="<?= $userinfo['picture'] ?>" alt="" width="90px" height="90px">
        <ul>
            <li>Full Name: <?= $fullname ?></li>
            <li>Email Address: <?= $email ?></li>
            <?php if ($row['address'] != NULL) : ?>
                <li>
                    Address:
                    <span id="address-gg"><?php echo $row['address'] ?></span>
                    <a href="" id="edit-address-gg">Edit</a>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="update-address-form-gg" style="display: none;">
                        <input type="text" name="address" id="address-input-gg" value="<?= $address ?>">
                        <button type="submit">Save</button>
                    </form>
                </li>
                <script>
                    const editAddressLink_GG = document.querySelector('#edit-address-gg');
                    const addressElement_GG = document.querySelector('#address-gg');
                    const addressInput_GG = document.querySelector('#address-input-gg');
                    const updateAddressForm_GG = document.querySelector('#update-address-form-gg');


                    editAddressLink_GG.addEventListener('click', function(e) {
                        e.preventDefault();
                        addressElement_GG.style.display = 'none';
                        editAddressLink_GG.style.display = 'none';
                        updateAddressForm_GG.style.display = 'block';
                        addressInput_GG.style.width = '35%';
                    });

                    updateAddressForm_GG.addEventListener('submit', function(e) {
                        e.preventDefault();
                        const xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function() {
                            if (this.readyState === 4 && this.status === 200) {
                                location.reload();
                            }
                        };
                        xhr.open('POST', './page/updateInformationGG.php');
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.send('address=' + encodeURIComponent(addressInput_GG.value));
                    });
                </script>
            <?php else : ?>
                <li><a href="#" id="add-address">Add Address</a></li>
                <li>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="add-address-form" style="display: none;">
                        <input type="text" name="new-address" id="new-address-input">
                        <button type="submit">Add</button>
                        <a href="#" id="cancel-add-address">Cancel</a>
                    </form>
                </li>
            <?php endif; ?>
            <li><a href="./page/logout.php">Logout</a></li>
        </ul>



        <script>
            const addAddressLink_GG = document.querySelector('#add-address');
            const cancelAddAddressLink_GG = document.querySelector('#cancel-add-address');
            const newAddressInput_GG = document.querySelector('#new-address-input');
            const addAddressForm_GG = document.querySelector('#add-address-form');

            addAddressLink_GG.addEventListener('click', function(e) {
                e.preventDefault();
                addAddressLink_GG.style.display = 'none';
                addAddressForm_GG.style.display = 'block';
            });

            cancelAddAddressLink_GG.addEventListener('click', function(e) {
                e.preventDefault();
                addAddressForm_GG.style.display = 'none';
                addAddressLink_GG.style.display = 'block';
            });

            addAddressForm_GG.addEventListener('submit', function(e) {
                e.preventDefault();
                const xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (this.readyState === 4) {
                        if (this.status === 200) {
                            location.reload();

                        } else {
                            console.log('Error: ' + this.status);
                        }
                    }
                };
                xhr.open('POST', './page/updateInformationGG.php');
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send('new-address=' + encodeURIComponent(newAddressInput_GG.value));
            });
        </script>


    <?php } else { ?>

        <h1>Welcome, <?= isset($email) ? $email : $email ?></h1>
        <img src="/img/default_profile_picture.png" alt="" width="150px" height="150px">
        <ul>
            <li>Email Address: <?= $email ?></li>
            <?php if (isset($phone)) : ?>
                <li>Phone Number: <?= $phone ?></li>
            <?php endif; ?>
            <?php if (isset($address)) : ?>
                <li>
                    Address:
                    <span id="address"><?= $address ?></span>
                    <a href="#" id="edit-address">Edit</a>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="update-address-form" style="display: none;">
                        <input type="text" name="address" id="address-input" value="<?= $address ?>">
                        <button type="submit">Save</button>
                    </form>
                </li>
            <?php endif; ?>
            <!-- add more fields here -->
            <li><a href="./page/logout.php">Logout</a></li>
        </ul>

        <script>
            const editAddressLink = document.querySelector('#edit-address');
            const addressElement = document.querySelector('#address');
            const addressInput = document.querySelector('#address-input');
            const updateAddressForm = document.querySelector('#update-address-form');

            editAddressLink.addEventListener('click', function(e) {
                e.preventDefault();
                addressElement.style.display = 'none';
                editAddressLink.style.display = 'none';
                updateAddressForm.style.display = 'block';
                addressInput.style.width = '35%';
            });

            updateAddressForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (this.readyState === 4 && this.status === 200) {
                        location.reload();
                    }
                };
                xhr.open('POST', './page/updateInformation.php');
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send('address=' + encodeURIComponent(addressInput.value));
            });
        </script>
    <?php } ?>
</body>

</html>