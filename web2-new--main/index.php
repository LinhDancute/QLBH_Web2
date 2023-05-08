<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layout Web</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="landingPage">
            <?php include "header.php"; 
            ?>
        <div class="hor-navbar">
            <?php include "nav_header.php";
            ?>
        </div>
    </div>
    <div class="mainPage" >
        <div class="section" >
            <div class="aside" >
                <?php include "aside_mainPage.php";?>
            </div>
            <div class="article" >
                <?php require("content.php");?>
            </div>
        </div>
    </div>
    <div class="footer" >
        <?php include "footer.php"; ?>
    </div>
</body>