<?php
$current = "productEdit";
require_once("./nav.php");
require_once("../Scripts/utiles.php");
$id = $_GET["prod"];
$connect = Connect();
$prod = mysqli_fetch_array(mysqli_query($connect, "SELECT * from products where product_id=$id"));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Edit Product</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

</head>

<body>
    <script>

    </script>
    <div class="row">
        <style>
            input,
            textarea,
            label,
            button {
                margin: 4px;
            }

            label {
                font-weight: bolder;
                font-size: 12px;
                margin-left: 19px;
                margin-top: 19px;
            }

            ul {
                list-style-type: none;
            }

            li {
                display: inline-block;
            }

            input[type="checkbox"][id^="cb"] {
                display: none;
            }

            label {
                border: 1px solid #fff;
                padding: 10px;
                display: block;
                position: relative;
                margin: 10px;
                cursor: pointer;
                -webkit-touch-callout: none;
                -webkit-user-select: none;
                -khtml-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            label::before {
                background-color: white;
                color: white;
                content: " ";
                display: block;
                border-radius: 50%;
                border: 1px solid grey;
                position: absolute;
                top: -5px;
                left: -5px;
                width: 25px;
                height: 25px;
                text-align: center;
                line-height: 28px;
                transition-duration: 0.4s;
                transform: scale(0);
            }

            label img {
                height: 100px;
                width: 100px;
                transition-duration: 0.2s;
                transform-origin: 50% 50%;
            }

            :checked+label {
                border-color: #ddd;
            }

            :checked+label::before {
                content: "✓";
                background-color: grey;
                transform: scale(1);
            }

            :checked+label img {
                transform: scale(0.9);
                box-shadow: 0 0 5px #333;
                z-index: -1;
            }
        </style>
        <div class="row">
            <div class="col-md-8" style="margin: 0 auto; ">
                <div class="card shadow mb-3" style="padding: 9px;">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Product Edit</p>
                    </div>
                    <form enctype="multipart/form-data" id="prodEdit">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Name</label>
                            <input required minlength="4" type="text" class="form-control" value="<?= $prod["name"] ?>" id="" aria-describedby="" placeholder="Enter Product Name" name="name">
                        </div>
                        <div class="form-group">
                            <label>Details</label>
                            <textarea required minlength="5" maxlength="500" class="form-control" name="details" id="" rows="5" style="resize: none;" name="details"><?= $prod["details"] ?></textarea>
                        </div>
                        <?php if ($prod["pictures"] != "") { ?>
                            <div class="form-group">
                                <label for="">Select images to remove</label>
                                <ul>
                                    <?php
                                    $i = 0;
                                    foreach (explode(",", $prod["pictures"]) as $k => $v) {
                                        $i++;
                                    ?>
                                        <li><input name="pic[]" type="checkbox" id="cb<?= $i ?>" value="<?= $v ?>" />
                                            <label for="cb<?= $i ?>"><img src="../assets/img/uploads/products/<?= $v ?>" /></label>
                                        </li>
                                    <?php
                                        # code...
                                    } ?>

                                </ul>
                            </div>
                        <?php } ?>
                        <div class="form-group ">
                            <label class="form-check-label">Add Pictures</label>
                            <input type="file" multiple accept="image/*" class="form-control" name="pictures[]">
                        </div>
                        <div class="form-group ">
                            <label class="form-check-label">Category</label>

                            <select class="form-control" data-live-search="true" name="category">
                                <option value="<?= $prod["category"] ?>"><?= $prod["category"] ?></option>
                                <?php

                                $c = $prod["category"];

                                $cat = runQuery("SELECT * from category where category !='$c'");
                                if (!empty($cat)) {
                                    foreach ($cat as $kk => $vv) {
                                ?>

                                        <option><?= $cat[$kk]["category"] ?></option>


                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group ">
                            <label class="form-check-label">Price</label>
                            <input required type="number" min="0" class="form-control" value="<?= $prod["price"] ?>" name="price" placeholder="Enter  price">
                        </div>
                        <input type="hidden" name="idProd" value="<?= $id ?>">


                        <button type="submit" class="btn btn-primary w-100">Edit</button>
                    </form>
                    <script>
                        $(function() {
                            let spinner = $('#spinn');

                            $('#prodEdit').on("submit", (e) => {
                                e.preventDefault();
                                let form = $("#prodEdit")[0];
                                let formData = new FormData(form);
                                $.ajax({
                                    type: "post",
                                    url: "../Scripts/products.php?EditProd",
                                    data: formData,
                                    contentType: false,
                                    processData: false,
                                    beforeSend: function() {
                                        spinner.css("display", "block");

                                    },
                                    success: function(res) {
                                        if (res == 1) {
                                            alertify.success("Succesfully Modified ! ");
                                            setTimeout(() => {
                                                window.location.href = "./productList.php";

                                            }, 500);
                                            spinner.css("display", "none");

                                        } else {
                                            alertify.error("Something went wrong !");
                                            spinner.css("display", "none");

                                            console.log(res);

                                        }
                                    }
                                });
                            })
                        });
                    </script>


                </div>
            </div>
</body>

</html>