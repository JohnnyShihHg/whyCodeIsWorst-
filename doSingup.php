<?php
$account = $_PSOT['account'];
$password = $_PSOT['password'];
$email = $_PSOT['email'];

/*連接資料庫*/
$conn = new mysqli("localhost","root","root","test");
$conn->set_charset("utf8mb4");

/*確認新使用者輸入的帳號是否曾在資料庫內*/
$sql = "SELECT * FROM `users` WHERE account = '$account';";
$check = $conn->query($sql)->fetch_assoc();
/*判斷是否重複 1.未重複成功新增 0.重複*/
echo json_encode($check);


if ($check != $account) {
    /*如果登入成功插入資料表。格式設定*/
    $newUser = "INSERT users (users_id,account,password,email) VALUES ('','$account','$password','$email');";
    /*連接資料庫插入資料表*/
    $conn->query($newUser);
    /*$responcse = ["status" => 1];*/
    echo json_encode(["status" => 1, "account" => $account]);
    exit();
} else {

    echo json_encode(["status" => 0]);
    exit();
}

/*回傳資料給前端接收確認狀態*/
/*echo json_encode($responcse);*/
?>