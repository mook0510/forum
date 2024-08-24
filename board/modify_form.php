<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>글수정</h1>
    <?php
    $idx = $_REQUEST['idx'];
    include "db.php";
    $sql = "select * from board where idx = $idx";
    $res = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($res);

    ?>
    <form action="modify.php" method="POST">
        <input type="hidden" name="idx" value="<?=$row['idx']?>"> 
    <table>
            <tr>
                <td>아이디</td>
                <td><input type="text" name="userid" value="<?=$row['userid']?>"></td>
            </tr>
            <tr>
                <td>제목</td>
                <td><input type="text" name="title" size="60"value="<?=$row['title']?>"></td>
            </tr>
            <tr>
                <td>내용</td>
                <td><textarea name="content" id="" cols="30" rows="10" ><?=$row['content']?></textarea></td>
            <tr>
                <td colspan = "2">
                    <input type="submit" value="수정">
                    <input type="button" value="취소" onClick = "history.go(-1);"> 
                </td>
            </tr>
        </table>
    </form>
</body>
</html>