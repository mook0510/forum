<?php
    session_start();
    if (!isset($_SESSION['userid'])) {
        header("Location: login.php");
        exit;
    }
?>

<style>
    .content-container {
            width: 80%; /* 전체 너비의 80%를 사용 */
            margin: 0 auto; /* 상하 마진 0, 좌우 마진 자동으로 설정하여 가운데 정렬 */
            padding: 20px; /* 내용과 테두리 사이에 패딩 추가 */
    }

    .header-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .header-logo {
        height: 100px;
    }

    .header-text {
        margin-left: 20px;
        font-size: 20px;
    }
</style>

<div class="header-container">
    <a href="board_list.php">
        <img src="pokemon.png" alt="홈페이지 로고" class="header-logo">
    </a>
    <div class="header-text">
        Pokémon are our friends
    </div>
</div>

<p style="text-align: right; margin-right: 500px;">현재 로그인한 사용자: <?= $_SESSION['userid'] ?></p>