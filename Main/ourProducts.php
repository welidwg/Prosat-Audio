<?php
$current = "ourProducts";

include_once("./mainNav.php");
include_once("../Scripts/utiles.php");
$connect = Connect();
if (isset($_GET['page']) && !empty($_GET['page'])) {
    $currentPage = (int) strip_tags($_GET['page']);
} else {
    $currentPage = 1;
}
$nbArticles = mysqli_num_rows(mysqli_query($connect, "SELECT * from products"));
$parPage  = 9;

$pages  = ceil($nbArticles  / $parPage);

$premier = ($currentPage * $parPage) - $parPage;

$array = runQuery("SELECT * from products order by category asc LIMIT $premier,$parPage");



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prosat audio | Products</title>

</head>

<body>
    <section class="clean-block clean-catalog dark" id="cont">
        <div class="container">
            <div class="block-heading" style="left:0">
                <h2 class="text-info">Our Products</h2>
            </div>
            <div class="content" style="zoom: 0.9;">
                <div class="row">
                    <div class="col-md-3">
                        <div class="d-md-block">
                            <div class="filters">
                                <div class="filter-item">
                                    <h3>Categories</h3>
                                    <div class=" form-check">
                                        <input class="form-check-input" type="radio" name="chk" id="formCheck" onchange="Search('','data')">
                                        <label class="form-check-label" for="formCheck">All</label>
                                    </div>
                                    <?php
                                    $i = 0;

                                    $prods = runQuery("SELECT * from category");
                                    if (!empty($prods)) {
                                        foreach ($prods as $kk => $vv) {
                                            # code...
                                            $i++;

                                    ?>
                                            <div class=" form-check">
                                                <input class="form-check-input" type="radio" name="chk" id="formCheck-<?= $i ?>">
                                                <label class="form-check-label" for="formCheck-<?= $i ?>"><?= $prods[$kk]["category"]; ?></label>
                                                <input type="hidden" id="category<?= $i ?>" value="<?= $prods[$kk]["category"]; ?>">
                                            </div>
                                            <script>
                                                $(function() {

                                                    $('#formCheck-<?= $i ?>').on("change", () => {
                                                        if ($("#formCheck-<?= $i ?>").is(":checked")) {
                                                            let cat = $("#category<?= $i ?>").val();
                                                            console.log(cat);

                                                            Search(cat, "data")
                                                        } else {
                                                            Search("", "data")


                                                        }
                                                    })
                                                });
                                            </script>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="col-md-9">
                        <div class="products " id="data">
                            <div class="row g-0 ">
                                <?php






                                if (!empty($array)) {
                                    foreach ($array as $k => $v) {
                                        $id = $array[$k]["product_id"];
                                        $pic = explode(",", $array[$k]["pictures"])[0];
                                        $detail = substr($array[$k]["details"], 0, 150);


                                ?>
                                        <div class="col-12 col-md-6 col-lg-4 data">
                                            <div class="clean-product-item">
                                                <div class="image" id="<?= $i ?>" style="max-height: 200px;height:200px;position: relative;"><a href="./productDetails.php?prod=<?php echo $id ?>"><img class="img-fluid d-block mx-auto" id="main-img" src="../assets/img/uploads/products/<?php echo $pic ?>"></a></div>
                                                <h4><?= $array[$k]["name"] ?></h4>

                                                <div class="product-name" style="font-size: 13px;max-height: 150px;height:150px;overflow: auto;">
                                                    <a href="./productDetails.php?prod=<?php echo $id ?>"><?php echo $detail . " ..." ?></a>
                                                </div>
                                                <div class="about">
                                                    <div class="rating"><?= $array[$k]["category"] ?></div>
                                                    <div class="price">
                                                        <h3><?php echo $array[$k]["price"] . " DT " ?></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <script>

                                        </script>


                                <?php
                                    }
                                }
                                ?>


                            </div>

                            <?php

                            ?>
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item <?php ($currentPage == 1) ? print("disabled") : "" ?>"><a class="page-link" href="?page=<?php echo $currentPage - 1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                    <?php for ($page = 1; $page <= $pages; $page++) : ?>

                                        <li class="page-item <?php ($currentPage == $page) ? print("active") : "" ?>"><a class="page-link" href="?page=<?php echo $page ?>"><?php echo $page ?></a></li>
                                    <?php endfor ?>

                                    <li class="page-item <?php ($currentPage == $pages) ? print("disabled") : "" ?>"><a class="page-link" href="?page=<?= $currentPage + 1 ?>" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function Search(category, ClassItem) {
                var filter = category.toLowerCase();
                var element = document.getElementsByClassName(ClassItem);

                for (i = 0; i < element.length; i++) {

                    if (element[i].innerText.toLowerCase().includes(filter)) {
                        element[i].style.display = "inherit";

                    } else {
                        element[i].style.display = "none";

                    }

                }

            }
        </script>
    </section>
    <br><br><br><br>

    <?php require_once("./footer.php"); ?>

</body>

</html>