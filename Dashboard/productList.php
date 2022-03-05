<?php
$current = "productList";
require_once("./nav.php");
require_once("../Scripts/utiles.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Products list</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-primary m-0 fw-bold">Products List</p>
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
                                <th>Details</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Added</th>
                                <th>Views</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $array = runQuery("SELECT * from products");
                            $i = 0;
                            if (!empty($array)) {
                                foreach ($array as $k => $v) {
                                    $i++;
                                    $pic = explode(",", $array[$k]["pictures"])[0];
                            ?>
                                    <tr>
                                        <td><img class="rounded-circle me-2" width="30" height="30" src="../assets/img/uploads/products/<?= $pic ?>"><?= $array[$k]["name"] ?></td>
                                        <td style="max-width: 140px;"><?= $array[$k]["details"] ?></td>
                                        <td><?= $array[$k]["price"] ?></td>
                                        <td><?= $array[$k]["category"] ?></td>
                                        <td><?= $array[$k]["addDate"] ?></td>
                                        <td><?= $array[$k]["views"] ?></td>

                                        <td>
                                            <div style="font-size: 12px;">
                                                <input type="hidden" id="idProd<?= $i ?>" value="<?= $array[$k]["product_id"] ?>">
                                                <a class="btn btn-success text-light" role="button" href="./EditProd.php?prod=<?= $array[$k]["product_id"] ?>" id="editProd<?= $i ?>" style="text-decoration: none;">
                                                    <i class="fad fa-edit"></i>
                                                </a>
                                                <a class="btn btn-danger text-light" role="button" id="deleteProd<?= $i ?>" style="text-decoration: none;">
                                                    <i class="fad fa-trash"></i>
                                                </a>

                                            </div>
                                        </td>
                                        <script>
                                            $(function() {
                                                $("#deleteProd<?= $i ?>").on("click", () => {
                                                    alertify.confirm('Confirmation', "Would you like really to delete this product ?", function(param) {
                                                        $.ajax({
                                                            type: "post",
                                                            url: "../Scripts/products.php",
                                                            data: {
                                                                query: "deleteProd",
                                                                idProd: $('#idProd<?= $i ?>').val()
                                                            },
                                                            success: function(res) {
                                                                if (res == 1) {
                                                                    alert("deleted")
                                                                    window.location.reload();
                                                                } else {
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
                                <th>Details</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Added</th>
                                <th>Views</th>
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