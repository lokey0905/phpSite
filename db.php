<?php
$host = 'localhost:3306';
$dbuser ='root';
$dbpassword = '';
$dbname = 'test';
$link = mysqli_connect($host,$dbuser,$dbpassword,$dbname);
if($link){
    mysqli_query($link,'SET NAMES utf8');
    echo "正確連接資料庫</br>";
}
else {
    echo "不正確連接資料庫</br>" . mysqli_connect_error();
}
?>