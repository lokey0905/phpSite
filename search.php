<?php

// 載入db.php來連結資料庫
require_once 'db.php';

//$filename = '/opt/lampp/temp/' . $_POST['userName'] . '_' . $_POST['password'] . '.pdf';
$filename = 'My_form.pdf';

?>

<h3>sql查詢結果</h3>

<?php

if (empty($_POST['userName']) || empty($_POST['password'])) {
    echo '<script>alert("請輸入正確的姓名和密碼。");window.location.href="index.php";</script>';
    exit();
}

// 設置一個空陣列來放資料
$datas = array();

// sql語法存在變數中
$sql = "SELECT `userName`, `password` FROM `userData` AS test WHERE `userName` LIKE '%".$_POST['userName']."%' AND `password` LIKE '%".$_POST['password']."%'";

// 用mysqli_query方法執行(sql語法)將結果存在變數中
$result = mysqli_query($link, $sql);

// 如果有資料
if ($result) {
    // mysqli_num_rows方法可以回傳我們結果總共有幾筆資料
    if (mysqli_num_rows($result) > 0) {
        // 取得大於0代表有資料
        // while迴圈會根據資料數量，決定跑的次數
        // mysqli_fetch_assoc方法可取得一筆值
        while ($row = mysqli_fetch_assoc($result)) {
            // 每跑一次迴圈就抓一筆值，最後放進data陣列中
            $datas[] = $row;
        }
    }

    // 釋放資料庫查到的記憶體
    mysqli_free_result($result);
} else {
    echo "{$sql} 語法執行失敗，錯誤訊息: " . mysqli_error($link);
}

?>

<script>
    let datas = <?php echo json_encode($datas); ?>;
    if (datas.length === 0) {
        alert("查無資料");
        window.location.href = 'index.php';
    } else {
        let shouldDownload = confirm("找到資料，是否下載？");
        if (shouldDownload) {
            window.location.href = 'download.php?filename=<?php echo $filename; ?>';
        } else {
            window.location.href = 'index.php';
        }
    }
</script>

<!-- 代表結束連線 -->
<?php mysqli_close($link); exit; ?>

