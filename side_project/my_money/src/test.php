<?php
    $file = $_FILES["file"];
    $file_path = "test/".$_FILES["file"]["name"];
    move_uploaded_file($file["tmp_name"], $_SERVER["DOCUMENT_ROOT"].$file_path);
    var_dump($_FILES);
    echo $file_path;
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="test.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file" id="file">
        <button type="submit">전송</button>
        <img src="./<?php $file_path ?>" width="100px">
    </form>
</body>
</html>