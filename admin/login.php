<?php


include_once '../classes/AdminLogin.php';
$al = new Adminlogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $chkLogin = $al->LoginUser($email, $password);
}


?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Log In - Admin Panel</title>
</head>

<body>

    <div class="container py-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">

                <span>

                    <?php

                    if (isset($_SESSION['status'])) {
                    ?>

                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <?= $_SESSION['status'] ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                    <?php
                    }

                    ?>

                </span>


                <span>

                    <?php

                    if (isset($chkLogin)) {
                    ?>

                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <?= $chkLogin?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                    <?php
                    }

                    ?>

                </span>


                <div class="card">
                    <h5 class="card-header">Login Form</h5>
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" name="email" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-success">Log In</button>
                            <a class="btn btn-primary" href="register.php">Sign Up</a>

                            <a href="#" class="float-right">Forget Your Password?</a>
                        </form>

                        <hr>

                        <h6> Did Not Receive Your Varification Email? <a href="#">Resend</a></h6>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>


</body>

</html>