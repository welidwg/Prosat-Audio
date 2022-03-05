<?php
$current = "productAdd";
require_once("./nav.php");
require_once("../Scripts/utiles.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Add Product</title>
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
        </style>
        <div class="row">
            <div class="col-md-8" style="margin: 0 auto; ">
                <div class="card shadow mb-3" style="padding: 9px;">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Product Add</p>
                    </div>
                    <form enctype="multipart/form-data" id="prodAdd">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Name</label>
                            <input required minlength="4" type="text" class="form-control" id="" aria-describedby="" placeholder="Enter Product Name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Details</label>
                            <textarea required minlength="5" class="form-control" name="details" id="" rows="5" style="resize: none;" name="details"></textarea>
                        </div>
                        <div class="form-group ">
                            <label class="form-check-label" for="exampleCheck1">Product Pictures</label>
                            <input type="file" multiple accept="image/*" class="form-control" name="pictures[]">
                        </div>
                        <div class="form-group ">
                            <label class="form-check-label" for="exampleCheck1">Category</label>

                            <select class="form-control" data-live-search="true" id="categorySelect" name="category">
                                <?php $cat = runQuery("SELECT * from category");
                                if (!empty($cat)) {
                                    foreach ($cat as $kk => $vv) {
                                ?>

                                        <option><?= $cat[$kk]["category"] ?></option>


                                    <?php
                                    }
                                } else { ?>

                                    <option value="0">You need to add a category first</option>
                                <?php
                                } ?>

                            </select>
                        </div>
                        <div class="form-group ">
                            <label class="form-check-label" for="exampleCheck1">Price</label>
                            <input required type="number" min="0" class="form-control" name="price" placeholder="Enter  price">
                        </div>


                        <button type="submit" id="Add" class="btn btn-primary w-100">Add</button>
                    </form>
                    <script>
                        $(function() {
                            if ($("#categorySelect").children("option:selected").val() == 0) {
                                $("#Add").attr("disabled", true);
                            } else {
                                $("#Add").attr("disabled", false);

                            }
                            let spinner = $('#spinn');

                            $('#prodAdd').on("submit", (e) => {
                                e.preventDefault();
                                let form = $("#prodAdd")[0];
                                let formData = new FormData(form);
                                $.ajax({
                                    type: "post",
                                    url: "../Scripts/products.php?AddProd",
                                    data: formData,
                                    contentType: false,
                                    processData: false,
                                    beforeSend: () => {

                                        spinner.css("display", "block");

                                    },
                                    success: function(res) {
                                        if (res == 1) {
                                            alertify.success("Added Successfully ! ")
                                            setTimeout(() => {
                                                $("#prodAdd").trigger("reset");

                                            }, 500);
                                            spinner.css("display", "none");

                                        } else {
                                            alertify.error("Something went wrong !");
                                            spinner.css("display", "none");


                                        }
                                    },
                                    error: (r) => {
                                        alertify.error("Something went wrong !");
                                        spinner.css("display", "none");

                                    }
                                });
                            })
                        });
                    </script>


                </div>
            </div>
</body>

</html>