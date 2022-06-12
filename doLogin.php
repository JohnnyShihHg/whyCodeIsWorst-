<?php
$account = $_POST['account'];
$password = $_POST['password'];

$conn = new mysqli("localhost","root","root","test");

$sql = "SELECT * FROM `users` WHERE account = '$account' && password ='$password';";
//該帳號的表資料取得email
$getUserInfo = "SELECT * FROM `users` WHERE account IN ('$account');";
$userResult = $conn->query($getUserInfo)->fetch_assoc();
$check = $conn->query($sql)->fetch_assoc();

if ($check) {
    //將表資料的值寫入userInfo
    $userInfo = $userResult['account']+$userResult['email'];
    //將userInfo轉成hash讓localStorage存成token
    $userKey = hash('sha256',$userInfo);
    //丟回
    echo json_encode($userKey);
}
?>