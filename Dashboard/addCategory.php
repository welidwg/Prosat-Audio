<?php
$current = "categoryAdd";
require_once("./nav.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Add Category</title>
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
                        <p class="text-primary m-0 fw-bold">Category Add</p>
                    </div>
                    <form enctype="multipart/form-data" id="catAdd">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category</label>
                            <input required minlength="4" type="text" class="form-control" placeholder="Enter Category" name="category">
                        </div>



                        <button type="submit" class="btn btn-primary w-100">Add</button>
                    </form>
                    <script>
                        $(function() {
                            let spinner = $('#spinn');

                            $('#catAdd').on("submit", (e) => {
                                e.preventDefault();

                                $.ajax({
                                    type: "post",
                                    url: "../Scripts/products.php?AddCat",
                                    data: $("#catAdd").serialize(),
                                    beforeSend: () => {

                                        spinner.css("display", "block");

                                    },
                                    success: function(res) {
                                        if (res == 1) {
                                            alertify.success("Added Successfully ! ")
                                            setTimeout(() => {
                                                $("#catAdd").trigger("reset");

                                            }, 500);
                                            spinner.css("display", "none");

                                        } else {
                                            alertify.error("Something went wrong !");
                                            console.log(res);
                                            spinner.css("display", "none");


                                        }
                                    },
                                    error: (r) => {
                                        alertify.error("Something went wrong !");
                                        spinner.css("display", "none");
                                        console.log(r.responseText);

                                    }
                                });
                            })
                        });
                    </script>


                </div>
            </div>
</body>

</html>