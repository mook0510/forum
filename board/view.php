<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글보기 페이지</title>
    <style>
        .content-container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        .page-button {
            display: inline-block;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 10px;
        }

        .other-article-list {
            list-style: none;
            padding: 0;
        }

        .other-article-list li {
            margin-bottom: 10px;
        }

        .other-article-list a {
            text-decoration: none;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 10px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="content-container">

        <h1>글보기</h1>

        <?php
        session_start();
        // 클릭한 글번호
        $idx = $_REQUEST['idx'];
        include "db.php";
        $sql = "select * from board where idx = $idx";
        $res = mysqli_query($db, $sql);
        $row = mysqli_fetch_array($res);

        // 로그인한 사용자와 글 작성자가 다른 경우에만 조회수 증가
        if ($_SESSION['userid'] != $row['userid']) {
            $updateHit = "update board set hit = hit + 1 where idx = $idx";
            mysqli_query($db, $updateHit);
        }
        ?>

        <table border="1">
            <tr>
                <td>아이디</td>
                <td><?=$row['userid']?></td>
                <td>작성일</td>
                <td><?=$row['reg_date']?></td>
            </tr>
            <tr>
                <td>제목</td>
                <td colspan="3"><?=$row['title']?></td>
            </tr>
            <tr>
                <td>내용</td>
                <td colspan="3">
                    <?=nl2br($row['content'])?><br>
                    <?php if( $row['img'] ) { ?>
                        <img src="<?=$row['img']?>" width="90%">
                    <?php } ?>
                </td>
            </tr>
        </table>

        <?php
        if ($_SESSION['userid'] == $row['userid']) {
        ?>
            <div class="page-button">
                <a href="modify_form.php?idx=<?=$row['idx']?>">수정</a>
            </div>
            <div class="page-button">
                <a href="delete_form.php?idx=<?=$row['idx']?>">삭제</a>
            </div>
        <?php
        }
        ?>

        <h2>다른 글 목록</h2>
        <ul class="other-article-list">
            <?php
            $sql = "SELECT * FROM board WHERE idx != $idx ORDER BY reg_date DESC";
            $otherRes = mysqli_query($db, $sql);
            $counter = 1;
            while($otherRow = mysqli_fetch_assoc($otherRes)) {
                echo "<li>".$counter.". <a href='view.php?idx=".$otherRow['idx']."'>".$otherRow['title']."</a></li>";
                $counter++;
            }
            ?>
        </ul>

    </div>
</body>
</html>
