<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>글쓰기</h1>
    <?php
    
        session_start();
        // 로그인한 사용자가 아니면 로그인 페이지로 돌아가기
        if (!isset($_SESSION['userid'])) {
            header("Location: login.php");
            exit;
        }

        // db 접속파일 포함
        include "db.php";

        $userid = $_REQUEST['userid'];
        $title = $_REQUEST['title'];
        $content = $_REQUEST['content'];
        // 전송된 file 처리
        // 저장된 임시파일 경로
        $tmp_file = $_FILES['img']['tmp_name'];
        // 전송된 파일명
        $filename = $_FILES['img']['name'];
        // 임시 파일 존재 여부 확인
        if( is_uploaded_file($tmp_file) ) {
            $up_path = $_SERVER['CONTEXT_DOCUMENT_ROOT']."/upload";
            // 최종 저장될 파일 경로
            $des_file = $up_path."/".$filename;
            move_uploaded_file($tmp_file, $des_file);
            $img_url = $_SERVER['CONTEXT_PREFIX']."/upload/".$filename;
            //echo "<img src='$img_url'><br>";

        }


        // 클라이언트 ip 주소
        $ip = $_SERVER['REMOTE_ADDR'];
        // board tabel에 추가
        $sql = "insert into board values(null,'$userid','$title','$content','$img_url',0,now(),'$ip')";
        $res = mysqli_query($db, $sql);
        if( $res ) {
            echo "글이 등록되었습니다.<br>";
        } else {
            echo "글 등록 오류 입니다.<br>";
        }
        mysqli_close($db);
    ?>
    <!-- 게시판 목록으로 돌아가는 버튼 -->
    <a href="board_list.php" style="display: block; margin-top: 20px; text-align: center; padding: 10px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">목록으로 돌아가기</a>
</body>
</html>