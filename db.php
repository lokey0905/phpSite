<?php

$host = 'localhost:3306';
$dbuser ='root';
$dbpassword = '';
$dbname = 'test';

$link = mysqli_connect($host, $dbuser, $dbpassword, $dbname);

if ($link) {
    mysqli_query($link, 'SET NAMES utf8');
    echo "正確連接資料庫</br>";

    if (isset($_POST['userName']) && isset($_POST['password'])) {
        $userName = $_POST['userName'];
        $password = $_POST['password'];

        // 使用 mysqli_real_escape_string 函式來避免 SQL 注入攻擊
        $userName = mysqli_real_escape_string($link, $userName);
        $password = mysqli_real_escape_string($link, $password);

        // 建立查詢語句
        $sql = "SELECT * FROM `userData` WHERE `userName` = '$userName' AND `password` = '$password'";

        // 執行查詢
        $result = mysqli_query($link, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            // 查詢結果有資料
            echo "密碼驗證成功";
        } else {
            // 查詢結果無資料
            echo "密碼驗證失敗";
        }
    }
} else {
    echo "不正確連接資料庫</br>" . mysqli_connect_error();
}

?>

