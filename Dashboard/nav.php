<?php session_start();
if (isset($_SESSION["login"])) { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap1.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
        <link rel="stylesheet" href="../assets/fonts/simple-line-icons.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
        <link rel="stylesheet" href="../assets/css/vanilla-zoom.min.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="./styles/dash.css">
        <link rel="stylesheet" href="../assets/fa/css/all.css">
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
        <script>
            alertify.defaults.transition = 'slide';
            alertify.defaults.theme.ok = 'btn btn-primary';
            alertify.defaults.theme.cancel = 'btn btn-danger';
            alertify.defaults.theme.input = 'form-control';
        </script>
        <link rel="icon" type="image/x-icon" href="../assets/img/logo.png">

        <style>
            .alertify-notifier .ajs-message.ajs-error,
            .alertify-notifier .ajs-message.ajs-success {
                color: #ffffff;
                border-radius: 9px;
                padding: 19px;
            }

            body {
                overflow: hidden;

            }

            html {
                -webkit-animation-name: fadeInUp;
                animation-name: fadeInUp;
            }
        </style>
    </head>

    <body class="">
        <style>
            #spinn {
                z-index: 9;
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

        <div id="wrapper" style="animation: fadeInLeft .2s ;">
            <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion  p-0" style="background-color: #394fa2;">
                <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="../Main/">
                        <div class="sidebar-brand-icon "><i class="fad fa-arrow-alt-circle-left"></i></div>
                        <div class="sidebar-brand-text mx-3"><span>Back to Main</span></div>
                    </a>
                    <hr class="sidebar-divider my-0">
                    <ul class="navbar-nav text-light" id="accordionSidebar">
                        <li class="nav-item"><a class="nav-link <?php if ($current == "home") echo "active"; ?>" href="./home.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                        <li class="nav-item"><a class="nav-link <?php if ($current == "productAdd") echo "active"; ?>" href="./addProduct.php"><i class="far fa-plus-circle"></i><span>Add Product</span></a></li>
                        <li class="nav-item"><a class="nav-link <?php if ($current == "productList") echo "active"; ?>" href="./productList.php"><i class="fad fa-box"></i><span>Products List</span></a></li>
                        <li class="nav-item"><a class="nav-link <?php if ($current == "categoryAdd") echo "active"; ?>" href="./addCategory.php"><i class="far fa-plus-circle"></i><span>Add Category</span></a></li>
                        <li class="nav-item"><a class="nav-link <?php if ($current == "catList") echo "active"; ?>" href="./CategoryList.php"><i class="far fa-toolbox"></i><span>Categories List</span></a></li>
                    </ul>
                    <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type=""></button></div>
                </div>
            </nav>
            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">
                    <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                        <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>

                            <ul class="navbar-nav flex-nowrap ms-auto">

                                <div class="d-none d-sm-block topbar-divider"></div>
                                <li class="nav-item dropdown no-arrow">
                                    <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo $_SESSION["name"] ?></span><img class="border rounded-circle img-profile" src="../assets/img/avatars/<?php echo $_SESSION["avatar"] ?>"></a>
                                        <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="./Profile.php"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a>
                                            <div class="dropdown-divider"></div><a class="dropdown-item" href="../Scripts/auth.php?logout"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>

                    <div class="container-fluid" style="max-height:85vh;overflow: auto;scroll-behavior: smooth;">
                        <div id="page-top"></div>



                        <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
                        <script src="../assets/js/theme1.js"></script>
                        <script src="../assets/bootstrap/js/bootstrap1.min.js"></script>


    </body>

    </html>
<?php } else { ?>
    <script>
        window.location.href = "../Main/";
    </script>
<?php } ?>