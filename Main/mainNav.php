<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="../assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="../assets/css/vanilla-zoom.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="icon" type="image/x-icon" href="../assets/img/logo.png">

    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/fa/css/all.css">

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <script>
        alertify.defaults.transition = 'slide';
        alertify.defaults.theme.ok = 'btn btn-success';
        alertify.defaults.theme.cancel = 'btn btn-light';
        alertify.defaults.theme.input = 'form-control';
    </script>
    <style>
        .alertify-notifier .ajs-message.ajs-error,
        .alertify-notifier .ajs-message.ajs-success {
            color: #ffffff;
            border-radius: 9px;
            padding: 19px;
        }
    </style>
</head>

<body>
    <script>

    </script>
    </script>
    <style>
        #spinn {
            z-index: 999999;
            height: 100vh;
            position: fixed;
            left: 0;
            right: 0;
            top: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
        }
    </style>
    <div id="spinn">
        <div class="d-flex justify-content-center ">
            <div class="spinner-border text-warning" style="margin-top:50vh;color:royalblue;width: 3rem; height: 3rem;">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-light bg-gradient clean-navbar">
        <div class="container"><a class="navbar-brand logo" href="#"><img src="../assets/img/logo.png" width="50" alt="Pro sat audio">&nbsp;Pro sat audio</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link <?php if ($current == "home") echo "active"; ?>" href="index.php"> <i class="fad fa-house"></i> Home</a></li>

                    <li class="nav-item"><a class="nav-link <?php if ($current == "ourProducts") echo "active"; ?>" href="ourProducts.php"><i class="fad fa-dolly"></i> Our Products</a></li>
                    <?php if (!isset($_SESSION["login"])) { ?> <li class="nav-item"><a class="nav-link <?php if ($current == "login") echo "active"; ?>" href="Login.php"><i class="fad fa-sign-in"></i> Login</a></li>
                    <?php } ?>
                    <?php if (isset($_SESSION["login"])) { ?>
                        <li class="nav-item"><a class="nav-link" href="../Dashboard/home.php"><i class="fad fa-tachometer-alt"></i> Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link <?php if ($current == "login") echo "active"; ?>" href="../Scripts/auth.php?logout"><i class="fad fa-sign-out"></i> Logout</a></li>

                    <?php } ?>



                </ul>
            </div>
        </div>
    </nav>
    <main class="page landing-page" style="animation: fadeInUp .2s ;height: auto;">

</body>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
<script src="../assets/js/vanilla-zoom.js"></script>
<script src="../assets/js/theme.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</html>
<?php  ?>