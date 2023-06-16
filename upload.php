<?php

// 載入 db.php 來連結資料庫
require_once 'db.php';

$userName = @$_POST['userName'];
$userPhone = @$_POST['userPhone'];
$password = @$_POST['password'];
$savsFileName = $userName . '_' . $password . '.pdf';

if (empty($_POST['userName']) || empty($_POST['userPhone']) || empty($_POST['password'])) {
    echo '<script>alert("請輸入正確的姓名與電話號碼");window.location.href="index.php";</script>';
    exit();
}

# 檢查檔案是否上傳成功
if ($_FILES['my_file']['error'] > 0) {
    // 匹配的錯誤代碼
    switch ($_FILES['my_file']['error']) {
        case 1:
            $mes = '上傳的檔案超過了 php.ini 中 upload_max_filesize 允許上傳檔案容量的最大值';
            break;
        case 2:
            $mes = '上傳檔案的大小超過了 HTML 表單中 MAX_FILE_SIZE 選項指定的值';
            break;
        case 3:
            $mes = '檔案只有部分被上傳';
            break;
        case 4:
            $mes = '沒有檔案被上傳';
            break;
        case 6:
            $mes = '找不到臨時目錄';
            break;
        case 7:
            $mes = '檔案寫入失敗';
            break;
        case 8:
            $mes = '上傳的文件被 PHP 擴展程式中斷';
            break;
    }
    echo "<script>alert('$mes');window.location.href='index.php';</script>";
    exit($mes);
} elseif ($_FILES['my_file']['type'] != 'application/pdf') {
    echo '<script>alert("只能上傳PDF檔案");window.location.href="index.php";</script>';
    exit;
}

// 檢查使用者名稱是否已存在
$sql = "SELECT * FROM `userData` WHERE `userName` = '$userName'";
$result = mysqli_query($link, $sql);
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        // 使用者名稱已存在，要求重新輸入密碼
        echo '<script>alert("你所設定的姓名已被使用，請重新想一個姓名，再輸入。");window.location.href="index.php";</script>';
        exit();
    }
} else {
    echo "{$sql} 語法執行失敗，錯誤訊息: " . mysqli_error($link) . '<br/>';
    exit();
}

if ($_FILES['my_file']['error'] === UPLOAD_ERR_OK) {
    echo '姓名: ' . $userName . '<br/>';
    echo '電話: ' . $userPhone . '<br/>';
    echo '檔案名稱: ' . $_FILES['my_file']['name'] . '<br/>';
    echo '檔案類型: ' . $_FILES['my_file']['type'] . '<br/>';
    echo '檔案大小: ' . ($_FILES['my_file']['size'] / 1024) . ' KB<br/>';
    echo '暫存名稱: ' . $_FILES['my_file']['tmp_name'] . '<br/>';

    # 檢查檔案是否已經存在
    if (file_exists('/opt/lampp/temp/' . $savsFileName)) {
        echo '檔案已存在。<br/>';
    } else {
        $file = $_FILES['my_file']['tmp_name'];
        //$dest = 'upload/' . $_FILES['my_file']['name'];

        # 將檔案移至指定位置
        move_uploaded_file($file, '/opt/lampp/temp/' . $savsFileName);
        echo '儲存名稱: ' . $savsFileName . '<br/>';

        // 將姓名、手機和密碼存入資料庫
        $sql = "INSERT INTO `userData` (`userName`, `userPhone`, `password`) VALUES ('$userName', '$userPhone', '$password')";

        $result = mysqli_query($link, $sql);

        if ($result) {
            echo "資料新增成功。<br/>";
        } else {
            echo "{$sql} 語法執行失敗，錯誤訊息: " . mysqli_error($link) . '<br/>';
        }
    }
} else {
    echo '錯誤代碼：' . $_FILES['my_file']['error'] . '<br/>';
}

exit;
?>

