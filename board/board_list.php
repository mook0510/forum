<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        a.write-button, a.logout-button {
            display: block;
            margin-top: 20px;
            text-align: center;
            padding: 10px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        a.write-button {
            background-color: #4CAF50;
        }

        a.logout-button {
            background-color: #ff0000;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="content-container">
        <h1>게시판</h1>
        <form action="board_list.php" method="get">
            <input type="text" name="search" placeholder="제목 검색" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
            <input type="submit" value="검색">
        </form>

        <?php
            include "db.php";
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            $rows_per_page = 5;
            $cur_page = isset($_GET['cp']) ? $_GET['cp'] : 1;
            $start = ($cur_page - 1) * $rows_per_page;

            // 데이터베이스 쿼리 (검색어 반영)
            $sql = "SELECT * FROM board ";
            if ($search !== '') {
                $sql .= "WHERE title LIKE '%$search%' ";
            }
            $sql .= "ORDER BY idx DESC LIMIT $start, $rows_per_page";
            $res = mysqli_query($db, $sql);
        ?>

        <table>
            <tr>
                <th>번호</th>
                <th>제목</th>
                <th>작성자</th>
                <th>작성일</th>
                <th>조회</th>
            </tr>
            <?php while($row = mysqli_fetch_array($res)): ?>
                <tr>
                    <td><?= $row['idx'] ?></td>
                    <td><a href="view.php?idx=<?= $row['idx'] ?>"><?= htmlspecialchars($row['title']) ?></a></td>
                    <td><?= htmlspecialchars($row['userid']) ?></td>
                    <td><?= $row['reg_date'] ?></td>
                    <td><?= $row['hit'] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>

        <?php
            // 전체 게시글 수 계산 (검색어 반영)
            $sql = "SELECT COUNT(*) FROM board ";
            if ($search !== '') {
                $sql .= "WHERE title LIKE '%$search%'";
            }
            $res = mysqli_query($db, $sql);
            $row = mysqli_fetch_array($res);
            $total = $row[0];
            $total_page = ceil($total / $rows_per_page);

            $prev = $cur_page - 1;
            $next = $cur_page + 1;
        ?>

        <div>
            <?php if($prev > 0): ?>
                <a href="?cp=<?= $prev ?>&search=<?= $search ?>" class="page-button">이전</a>
            <?php endif; ?>
            <?php if($next <= $total_page): ?>
                <a href="?cp=<?= $next ?>&search=<?= $search ?>" class="page-button">다음</a>
            <?php endif; ?>
        </div>

        <a href="write_form.php" class="write-button">글작성</a>
        <a href="logout.php" class="logout-button">로그아웃</a>
    </div>
</body>
</html>