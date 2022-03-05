<?php
require_once("./utiles.php");
$connect = Connect();
session_start();


if (isset($_POST["query"])) {
    $query = $_POST["query"];
    switch ($query) {
        case 'login':
            $password = md5($_POST["password"]);
            $input = $_POST["auth"];
            filter_var($input, FILTER_VALIDATE_EMAIL) ? $field = "email" : $field = "username";
            $sql = "SELECT * from users where $field like '$input' and password like '$password'";
            $req = mysqli_query($connect, $sql);
            if (mysqli_num_rows($req) > 0) {
                $user = mysqli_fetch_array($req);
                $_SESSION["login"] = true;
                $_SESSION["id"] = $user["user_id"];
                $_SESSION["email"] = $user["email"];
                $_SESSION["username"] = $user["username"];
                $_SESSION["name"] = $user["name"];
                $_SESSION["role"] = $user["role"];
                $_SESSION["avatar"] = $user["avatar"];
                echo 1;
            } else {
                echo 0;
            }
            break;



        default:
            return 4;
            break;
    }
} else if (isset($_GET["logout"])) {
    session_destroy();
    session_unset();
    header("Location:../Main/index.php");
    exit();
} else if (isset($_GET["ChangeAvatar"])) {
    $file_name = RandomString() . $_FILES["avatar"]["name"];
    if (move_uploaded_file($file_tmp = $_FILES["avatar"]["tmp_name"], "../assets/img/avatars/" . $file_name)) {
        $id = $_SESSION["id"];
        if (mysqli_query($connect, "UPDATE users SET avatar='$file_name' where user_id=$id")) {
            $_SESSION["avatar"] = $file_name;
            echo 1;
        } else {
            echo mysqli_error($connect);
        }
    }
} else if (isset($_GET["editProfile"])) {
    $id = $_POST["userId"];
    $olduser = GetUser($id);
    $name = $_POST["name"];
    $email = $_POST["email"];
    if ($_POST["password"] == "") {
        $password = $olduser["password"];
    } else {
        $password = md5($_POST["password"]);
    }
    $username = $_POST["username"];
    $checkUsername = checkUsername($username);
    $checkEmail = checkEmail($email);
    if ($olduser["email"] == $email) {
        $checkEmail = false;
    }
    if ($olduser["username"] == $username) {
        $checkUsername = false;
    }
    if (!$checkEmail && !$checkUsername) {
        if (mysqli_query($connect, "UPDATE users SET name='$name',username='$username',email='$email',password='$password'")) {
            $_SESSION["email"] = $email;
            $_SESSION["username"] = $username;
            $_SESSION["name"] = $name;
            echo 1;
        } else {
            echo mysqli_error($connect);
        }
    } else {
        echo 0;
    }
} else if (isset($_GET['ResetViews'])) {
    mysqli_query($connect, "UPDATE views SET nViews=0");
    echo 1;
}
