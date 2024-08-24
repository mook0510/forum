<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    // db 접속 파일 불러오기
    include "db.php";
    
    $userid = $_REQUEST['userid'];
    $passwd = $_REQUEST['passwd'];

    // 사용자 확인(조회) 작업
    $sql = "select * from user where userid='$userid' and passwd=password('$passwd')";
    $res = mysqli_query($db, $sql);
    if ( mysqli_num_rows($res) > 0 ) {
        $row = mysqli_fetch_array($res);
        echo "{$row['name']}님 접속을 환영합니다.<br>";
        // 로그인 확인 후 session에 정보 저장
        $_SESSION['userid'] = $userid;
        $_SESSION['name'] = $row['name'];
        echo '<button onclick="location.href=\'board_list.php\'">게시판 보러 가기</button>';
        exit;

    } else {
        echo "아이디나 암호가 일치하지 않습니다.<br>";
    }
    mysqli_close($db);
    ?>
    <a href="login.html">로그인 페이지 이동</a>
</body>
</html>