window.onload = function() {
    document.getElementById('downloadButton').onclick = function() {
        document.getElementById('downloadLink').style.display = 'block';
        document.getElementById('uploadForm').style.display = 'none';
        document.getElementById('searchForm').style.display = 'none';
    };

    document.getElementById('uploadButton').onclick = function() {
        document.getElementById('downloadLink').style.display = 'none';
        document.getElementById('uploadForm').style.display = 'block';
        document.getElementById('searchForm').style.display = 'none';
    };

    document.getElementById('searchButton').onclick = function() {
        document.getElementById('downloadLink').style.display = 'none';
        document.getElementById('uploadForm').style.display = 'none';
        document.getElementById('searchForm').style.display = 'block';
    };

    document.getElementById('uploadForm').addEventListener('submit', function(e) {
        const userName = document.querySelector('input[name="userName"]').value;
        const userPhone = document.querySelector('input[name="userPhone"]').value;
        const fileInput = document.querySelector('input[name="my_file"]');
        const file = fileInput.files && fileInput.files[0];
    
        if (!userName) {
            alert('請輸入姓名。');
            e.preventDefault();
        } 
        if (!userPhone) {
            alert('請輸入電話。');
            e.preventDefault();
        } 
        if (!file) {
            alert('請上傳檔案。');
            e.preventDefault();
        }
    });
    
};
