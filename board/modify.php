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
        $title = $_REQUEST['title'];
        $content = $_REQUEST['content'];
        include "db.php";
        $sql = "update board set title = '$title',content = '$content' where idx=$idx";
        $res = mysqli_query($db,$sql);
        if($res){
            echo"글이 수정되었습니다.";
        }
        else {
            echo "수정 오류입니다.";
        }
    ?>
    <a href="view.php?idx=<?=$idx?>">글보기</a>
</body>
</html>