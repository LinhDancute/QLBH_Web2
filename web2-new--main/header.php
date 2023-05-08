
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="header.css">
    <script src="https://kit.fontawesome.com/1d92659247.js" crossorigin="anonymous"></script>
    <script src=""></script>
    <title>Document</title>
</head>

<body>
    <?php
    echo "<div class='header-top'>
        <div class='container'>
            <div class='header-middle-wrap'>

                <div class='theme-logo'>
                    <a href=''>
                        <img src='image/logo.png'>
                    </a>
                </div>

                <div class='search-bar'>
                    <form action='/search' method='get' class='header-search' role='search' style='position: relative;'>
                        <input class='input-field' type='search' name='q' value='' placeholder='Search our store' aria-label='Search our store' autocomplete='off'>

                        <button class='btn btn-outline-whisper btn-primary-hover' type='submit'>
                            <i class=fa fa-search' aria-hidden='true'></i>
                        </button>
                    </form>
                </div>

                <div class='header-right'>
                    <ul>
                        <li>
                            <i class='fa-solid fa-user-group'></i>
                            <ul class='sub-menu'>
                                <li><a href='index.php?number=showAccount'>My Account</a></li>
                                <li><a href='index.php?number=login'>Login</a></li>
                                <li><a href='index.php?number=signup'>Register</a></li>
                            </ul>
                        </li>
                        <li>
                            <i class='fa-solid fa-bag-shopping'></i>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>"
    ?>
</body>

</html>