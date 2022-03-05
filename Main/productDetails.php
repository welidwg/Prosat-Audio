<?php
$current = "prodDetails";
require_once("./mainNav.php");
require_once("../Scripts/utiles.php");
$connect = Connect();
$id = $_GET["prod"];
$prod = mysqli_fetch_array(mysqli_query($connect, "SELECT * from products where product_id=$id"));
$old = $prod["views"];
$new = $old += 1;
mysqli_query($connect, "UPDATE products set views=$new where product_id=$id");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product | <?php echo $prod["name"]; ?> </title>
    <link rel="stylesheet" href="../assets/css/vanilla-zoom.min.css">
    <script src="../assets/js/vanilla-zoom.js"></script>
    <script>
        window.onload = function() {
            vanillaZoom.init('#product-preview');
        };
    </script>
</head>

<body>
    <section class="clean-block clean-product dark">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-info">Details</h2>
            </div>
            <div class="block-content">
                <div class="product-info">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="gallery">
                                <div id="product-preview" class="vanilla-zoom">
                                    <?php $pic = explode(",", $prod["pictures"])[0]; ?>
                                    <div class="zoomed-image"></div>

                                    <div class="sidebar">
                                        <?php foreach (explode(",", $prod["pictures"]) as $k => $v) {
                                            # code...
                                        ?>
                                            <img class="img-fluid d-block small-preview " src="../assets/img/uploads/products/<?php echo $v ?>">

                                        <?php
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info">
                                <h3><?php echo $prod["name"] ?> <?php if (isset($_SESSION["login"])) { ?><a href="../Dashboard/EditProd.php?prod=<?php echo $prod["product_id"] ?>"><i class="fad fa-edit"></i></a><?php } ?> </h3>
                                <div class="rating"><?php echo $prod["category"] ?></div>
                                <div class="price">
                                    <h3><?php echo $prod["price"] . " DT" ?></h3>
                                </div>
                                <div class="summary">
                                    <p><?php echo $prod["details"] ?></p>
                                </div>
                                <div>
                                    <p> Total Views : <?php echo $new ?></p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</body>

</html>