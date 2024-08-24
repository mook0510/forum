<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글쓰기 페이지</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        table {
            width: 70%;
            margin-left: auto;
            margin-right: auto;
            border-collapse: collapse;
        }
        td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        input[type="text"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        input[type="submit"],
        input[type="reset"] {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <h1>글쓰기</h1>
    <form id="postForm" action="write.php" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>아이디</td>
                <td><input type="text" name="userid"></td>
            </tr>
            <tr>
                <td>제목</td>
                <td><input type="text" name="title" id="title" size="60"></td>
            </tr>
            <tr>
                <td>내용</td>
                <td><textarea name="content" cols="30" rows="10"></textarea></td>
            </tr>
            <tr>
                <td>이미지</td>
                <td><input type="file" name="img" accept="image/jpeg,image/png,image/gif"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" value="글등록">
                    <input type="reset" value="초기화">
                </td>
            </tr>
        </table>
    </form>

    <script>
        document.getElementById("postForm").onsubmit = function() {
            var title = document.getElementById("title").value;
            if (title.trim() === "") {
                alert("제목을 입력해야 합니다.");
                return false; // Prevent form submission
            }
            return true; // Allow form submission
        };
    </script>
</body>
</html>
