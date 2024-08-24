<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $userid = $_REQUEST['userid'];
    $passwd = $_REQUEST['passwd'];
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    // mysql dbms 접속
    $db= mysqli_connect('localhost', 'prog132', '2021100928');
    if( !$db ) {
        // dbms 접속 실패
        echo "DBMS 접속 오류!<br>";
        exit(0);
    }
    // 기본 charset을 utf-8로 설정
    mysqli_set_charset($db, 'utf8');
    // 작업할 db 선택
    if( !mysqli_select_db($db, 'prog132')){
        // db 선택 실패
        echo "작업 DB 선택 오류!<br>";
        mysqli_close($db);
        exit(0);
    }
    // 아이디 중복 검색
    $sql = "select * from user where userid='$userid'";
    $res = mysqli_query($db, $sql);
    if( mysqli_num_rows($res) > 0 ){
        echo "이미 사용중인 아이디 입니다.<br>";
    }
    else {
        // DB에 사용자 추가
        $sql = "insert into user 
        values('$userid',password('$passwd'),'$name','$email',now())";
        $res = mysqli_query($db, $sql);
        if( $res ) {
            echo "회원가입이 완료되었습니다.<br>";
        } else {
            echo "회원가입이 오류입니다.<br>";
        }
    }
    mysqli_close($db);
    ?>
    <a href="login.html">로그인 페이지 이동</a>
</body>
</html>