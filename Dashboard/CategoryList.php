<?php
$current = "catList";
require_once("./nav.php");
require_once("../Scripts/utiles.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Categories List</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-primary m-0 fw-bold">Categories List</p>
            </div>
            <div class="card-body">

                <script>
                    $(document).ready(function() {
                        $('#dataTable').DataTable();
                    });
                </script>
                <div class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
                    <table class="table my-0" id="dataTable">
                        <thead>
                            <tr>
                                <th>Name</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $array = runQuery("SELECT * from category");
                            $i = 0;
                            if (!empty($array)) {
                                foreach ($array as $k => $v) {
                                    $i++;

                            ?>
                                    <tr>
                                        <td><?= $array[$k]["category"] ?></td>


                                        <td>
                                            <div style="font-size: 12px;">
                                                <input type="hidden" id="idCat<?= $i ?>" value="<?= $array[$k]["idCat"] ?>">

                                                <a class="btn btn-danger text-light" role="button" id="deleteProd<?= $i ?>" style="text-decoration: none;">
                                                    <i class="fad fa-trash"></i>
                                                </a>

                                            </div>
                                        </td>
                                        <script>
                                            $(function() {
                                                $("#deleteProd<?= $i ?>").on("click", () => {
                                                    alertify.confirm('Confirmation', "Would you like really to delete this catgeory ?", function(param) {
                                                        $.ajax({
                                                            type: "post",
                                                            url: "../Scripts/products.php",
                                                            data: {
                                                                query: "deleteCat",
                                                                idCat: $('#idCat<?= $i ?>').val()
                                                            },
                                                            success: function(res) {
                                                                if (res == 1) {
                                                                    alertify.success("deleted")
                                                                    setTimeout(() => {
                                                                        window.location.reload();

                                                                    }, 700);
                                                                } else {
                                                                    alertify.error("Something went wrong!");
                                                                    console.log(res);
                                                                }
                                                            }
                                                        });
                                                    }, function(param) {})

                                                })
                                            });
                                        </script>
                                    </tr>
                            <?php
                                    # code...
                                }
                            }  ?>



                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Name</th>

                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </div>

</body>

</html>