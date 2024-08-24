<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>글삭제</h1>
    <?php
        $idx = $_REQUEST['idx'];
    ?>
    <form action="delete.php" method="post">
        <input type="hidden" name="idx" value="<?=$idx?>">
    <p>정말 삭제하시겠습니까?</p>
    <input type="submit" value="삭제">
    <input type="button" value="취소" onClick="history.go(-1)">
    </form>
</body>
</html>