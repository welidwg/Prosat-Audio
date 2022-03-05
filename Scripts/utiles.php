<?php

function Connect()
{
    $connect = mysqli_connect("localhost", "root", "", "prosat") or die("Connection Error");
    return $connect;
}
function RandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function runQuery($query)
{
    $connect = Connect();

    $result = mysqli_query($connect, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $resultset[] = $row;
    }
    if (!empty($resultset))
        return $resultset;
}
function checkUsername($username)
{
    $connect = Connect();
    $user = mysqli_num_rows(mysqli_query($connect, "SELECT * from users where username like '$username'"));
    if ($user == 1) {
        return true;
    }
    return false;
}
function GetUser($id)
{
    $connect = Connect();
    return mysqli_fetch_array(mysqli_query($connect, "SELECT  * from users where user_id = $id"));
    # code...
}
function checkEmail($email)
{
    $connect = Connect();
    $user = mysqli_num_rows(mysqli_query($connect, "SELECT * from users where email like '$email'"));
    if ($user == 1) {
        return true;
    }
    return false;
}
