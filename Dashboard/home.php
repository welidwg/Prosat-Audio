<?php
$current = "home";
require_once("./nav.php");
require_once("../Scripts/utiles.php");
$connect = Connect();
$view = mysqli_fetch_array(mysqli_query($connect, "SELECT * from views"));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - home</title>
</head>

<body>
    <div class="row">
        <div class="col-md-6 ">
            <div class="card shadow border-start-primary py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <?php
                            $total = mysqli_num_rows(mysqli_query($connect, "SELECT * from products")); ?>
                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Total products</span></div>
                            <div class="text-dark fw-bold h5 mb-0"><span><?= $total ?></span></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-box fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="card shadow border-start-success py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Total Site visits</span> <a style="text-decoration: none;font-size: 11px;color:darkred" id="reset" role="button">(reset)</a></div>
                            <div class="text-dark fw-bold h5 mb-0"><span><?= $view[0] ?></span> </div>
                        </div>
                        <div class="col-auto"><i class="fas fa-eye fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(function() {
                $("#reset").on("click", (e) => {
                    $.ajax({
                        type: "post",
                        url: "../Scripts/auth.php?ResetViews",
                        success: function(res) {
                            window.location.reload();
                        }
                    });
                });
            });
        </script>

    </div>
</body>

</html>