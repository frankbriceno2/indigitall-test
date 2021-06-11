<?php
session_start();
$clientLang = strtoupper(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));
$ip = '37.223.252.148';
$userLocation = file_get_contents('http://ip-api.com/json/'.$ip);
//$userLocation = '{"status":"success","country":"Spain","countryCode":"ES","region":"MD","regionName":"Madrid","city":"Madrid","zip":"28028","lat":40.4163,"lon":-3.6934,"timezone":"Europe/Madrid","isp":"VODAFONE-NETWORK","org":"","as":"AS12430 VODAFONE ESPANA S.A.U.","query":"37.223.252.148"}';
$obj = json_decode($userLocation, true);
?>

<!doctype html>
<html lang="en" class="h-100">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="assets/css/app.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" integrity="sha512-RXf+QSDCUQs5uwRKaDoXt55jygZZm2V++WUZduaU/Ui/9EGp3f/2KZVahFZBKGH0s774sd3HmrhUy+SgOFQLVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>INDIGITAL RS</title>
</head>

<body class="d-flex flex-column h-100">
    <header>
        <div class="container-fluid bg-primary">
            <div class="row">
                <div class="col-12 text-center p-lg-5 p-3">
                    <h1 class="text-white">INDI SOCIAL NETWORK</h1>
                </div>
            </div>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <?php
                    if (isset($_SESSION['user'])) {
                    ?>
                        <li>
                            <a class="nav-link" href="#"><i class="fas fa-address-card"></i> Profile</a>
                        </li>
                        <li>
                            <a class="nav-link" href="#"><i class="fas fa-users"></i> Friends</a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <?php
                    if (!isset($_SESSION['user'])) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" data-bs-toggle="modal" data-bs-target="#sign_up" href="#"><i class="fas fa-sign-in-alt"></i> Sign up</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" data-bs-toggle="modal" data-bs-target="#login" href="#"><i class="fas fa-fingerprint"></i> Login</a>
                        </li>
                        <!--<li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>-->
                    <?php
                    } else {
                    ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-user-circle" aria-hidden="true"></i> <? echo $_SESSION['user']; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/?location=auth&action=logout">Logout</a></li>
                            </ul>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <!-- Modal sign in -->
        <div class="modal fade" id="sign_up" tabindex="-1" aria-labelledby="sign_upLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sign in</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form name="registerUser" id="registerUser">
                            <input type="hidden" value="<?php echo $obj['lat']; ?>" name="latitude" id="latitude">
                            <input type="hidden" value="<?php echo $obj['lon']; ?>" name="longitude" id="longitude">
                            <input type="hidden" value="<? echo $clientLang; ?>" name="language" id="language">
                            <div class="mb-3">
                                <label for="user_name" class="form-label">User name</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" aria-describedby="emailHelp required">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_pass" class="form-label">Confirm password</label>
                                <input type="password" class="form-control" id="confirm_pass" name="confirm_pass" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                                <label class="form-check-label" for="terms">I am agree with the <a href="#">Terms and Conditions</a></label>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="btnRegister" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal login -->
        <div class="modal fade" id="login" tabindex="-1" aria-labelledby="loginLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="controllers/authController.php">
                            <input type="hidden" value="login" name="action">
                            <div class="mb-3">
                                <label for="user_email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="user_email" name="user_email" aria-describedby="emailHelp">
                                <div id="user_emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            </div>
                            <div class="mb-3">
                                <label for="user_password" class="form-label">Password</label>
                                <input type="password" name="user_password" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <section id="content" class="p-3">
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 5">
            <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto"><i class="fas fa-info-circle"></i> Message</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                </div>
            </div>
        </div>
    </section>

    <footer class="footer mt-auto py-3 bg-body shadow">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <p class="p-3 m-0 text-center"><small>® 2021 - Frank A. Briceño G.<br />Full stack developer</small></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
    <script src="assets/js/app.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
        -->
</body>

</html>