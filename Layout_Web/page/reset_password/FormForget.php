<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <section class="vh-100 gradient-custom mh-75">
        <div class="container py-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Reset Password Form <i class="bi bi-person-circle"></i></h3>
                            <form action="database/reset_clients_phone.php" method="post" id="forget-form">
                                <div class="row">
                                    <div class="col-md-3 mb-1 pb-2 w-100">
                                        <div class="form-outline">
                                            <span id="check-phone-exist"></span>
                                            <input type="tel" id="phone" class="form-control form-control-lg" name="phone" onInput="checkPhoneExist()" />
                                            <label class="form-label" for="phoneNumber"><i class="bi bi-telephone-fill"> Phone Number</i></label>
                                            <div class="fst-italic">
                                                <div class="d-flex justify-content-start input-group mb-3">
                                                    <input class="btn btn-primary btn-lg" type="submit" value="Send OTP to your phone" name="verify-phone" id="verify-phone" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function checkPhoneExist() {
            // ensure the phone number starts with '+84'
            let phone = $("#phone").val();
            if (!phone.startsWith("+84")) {
                phone = "+84" + phone;
            }
            jQuery.ajax({
                url: "./database/check_availability_login.php",
                data: {
                    phone: phone
                },
                type: "POST",
                success: function(data) {
                    $("#check-phone-exist").html(data);
                },
                error: function() {}
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>