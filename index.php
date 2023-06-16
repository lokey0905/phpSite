<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <button id="downloadButton">下載</button>
    <button id="uploadButton">上傳</button>
    <button id="searchButton">查詢</button>

    <a id="downloadLink" href="download.php?filename=consent.pdf" style="display: none;">下載同意書</a>

    <form id="uploadForm" method="post" enctype="multipart/form-data" action="upload.php" style="display: none;">
    	</br>請上傳已簽名的PDF檔</br></br>
        <input type="file" name="my_file" accept="application/pdf">
        <input type="hidden" name="MAX_FILE_SIZE" value="10485759">
        <input type="text" placeholder="請輸入姓名" name="userName">
        <input type="tel" placeholder="請輸入電話" name="userPhone" inputmode="numeric" minlength="10" maxlength="10" size="10" pattern="[0-9]*">
        <input type="password" id="password" placeholder="請輸入密碼" name="password">
	<input type="checkbox" id="showPassword" onclick="togglePasswordVisibility('password','showPassword')">
	<label for="showPassword">顯示密碼</label>
	</br>
	</br>
        <input type="submit" value="上傳">
    </form>

    <form id="searchForm" method="post" enctype="multipart/form-data" action="search.php" style="display: none;">
        <input type="text" placeholder="請輸入姓名" name="userName">
        <input type="password" id="searchPassword" placeholder="請輸入密碼" name="password">
	<input type="checkbox" id="showSearchPassword" onclick="togglePasswordVisibility('searchPassword', 'showSearchPassword')">
	<label for="showSearchPassword">顯示密碼</label>
        </br>
        </br>
        <input type="submit" value="查詢">
    </form>

    <script src="js/script.js"></script>
    <script>
	function togglePasswordVisibility(passwordFieldId, checkboxId) {
	        var passwordInput = document.getElementById(passwordFieldId);
	        var showPasswordCheckbox = document.getElementById(checkboxId);
	
	        if (showPasswordCheckbox.checked) {
	            passwordInput.type = "text";
	        } else {
	            passwordInput.type = "password";
        	}
        }
    </script>
</body>
</html>
