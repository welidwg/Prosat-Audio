<?php
require_once("./utiles.php");
$connect = Connect();

if (isset($_GET["AddCatgeory"])) {
    $name = $_POST["name"];
    $details = mysqli_real_escape_string($connect, $_POST["details"]);
    $category = $_POST["category"];
    $price = $_POST["price"];
    $date = date("Y-m-d");
    $pics = "";
    foreach ($_FILES["pictures"]["tmp_name"] as $k => $v) {
        # code...
        $file_tmp = $_FILES["pictures"]["tmp_name"][$k];
        $file_name = RandomString() . $_FILES["pictures"]["name"][$k];
        $pics == "" ? $pics = $file_name : $pics .= "," . $file_name;
        move_uploaded_file($file_tmp = $_FILES["pictures"]["tmp_name"][$k], "../assets/img/uploads/products/" . $file_name);
    }
    $sql = "INSERT INTO `products`( `name`, `details`, `pictures`, `category`, `addDate`, `price`) VALUES ('$name','$details','$pics','$category','$date','$price')";
    if (mysqli_query($connect, $sql)) {
        echo 1;
    } else {
        echo mysqli_error($connect);
    }
} else if (isset($_GET["AddCat"])) {

    $nom = $_POST["category"];
    if (mysqli_query($connect, "INSERT INTO category (category) values('$nom')")) {
        echo 1;
    } else {
        echo mysqli_error($connect);
    }
} else if (isset($_GET["EditProd"])) {
    $id = $_POST["idProd"];
    $prod = mysqli_fetch_array(mysqli_query($connect, "SELECT * from products where product_id=$id"));
    $pic = explode(",", $prod["pictures"]);
    $pics = "";
    $name = $_POST["name"];
    $details = mysqli_real_escape_string($connect, $_POST["details"]);
    $category = $_POST["category"];
    $price = $_POST["price"];
    if (isset($_POST["pic"])) {
        $newPics = array_diff($pic, $_POST["pic"]);
        foreach ($newPics as $key => $value) {
            $pics == "" ? $pics = $value : $pics .= "," . $value;

            # code...
        }
        foreach ($_POST["pic"] as $kkk => $vvv) {
            unlink("../assets/img/uploads/products/" . $vvv);
        }
    } else {
        $pics = $prod["pictures"];
    }
    if (isset($_FILES["pictures"]) && !empty($_FILES["pictures"]["name"][0])) {
        foreach ($_FILES["pictures"]["tmp_name"] as $k => $v) {
            # code...
            $file_tmp = $_FILES["pictures"]["tmp_name"][$k];
            $file_name = RandomString() . $_FILES["pictures"]["name"][$k];
            $pics == "" ? $pics = $file_name : $pics .= "," . $file_name;
            move_uploaded_file($file_tmp = $_FILES["pictures"]["tmp_name"][$k], "../assets/img/uploads/products/" . $file_name);
        }
    }

    if (mysqli_query($connect, "UPDATE products SET name='$name',details='$details',category='$category',price=$price,pictures='$pics' 
       where product_id=$id")) {
        echo 1;
    } else {
        echo mysqli_error($connect);
    }
}

if (isset($_POST["query"])) {
    $query = $_POST["query"];
    switch ($query) {
        case 'deleteProd':
            $id = $_POST["idProd"];
            $prod = mysqli_fetch_array(mysqli_query($connect, "SELECT * from products where product_id=$id"));
            $pics = explode(",", $prod["pictures"]);

            if (strpos($prod["pictures"], ',') !== false) {
                foreach ($pics  as $k => $v) {
                    unlink("../assets/img/uploads/products/" . $v);
                    # code...
                }
            } else {
                unlink("../assets/img/uploads/products/" . $prod["pictures"]);
            }



            if (mysqli_query($connect, "DELETE from products WHERE product_id=$id")) {
                echo 1;
            } else {
                echo mysqli_error($connect);
            }
            # code...
            break;
        case 'deleteCat':
            $id = $_POST["idCat"];
            if (mysqli_query($connect, "DELETE FROM category where idCat=$id")) {
                echo 1;
            } else {
                echo mysqli_error($connect);
            }

            break;
        default:
            # code...
            break;
    }
}
