<?php
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
?>