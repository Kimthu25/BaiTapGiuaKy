<?php
include "connect.php";

$search_query = "";
if (isset($_POST['search_button'])) {
    $search_query = $_POST['search'];
}
if (empty($search_query)) {
    $sql = "SELECT id, fullname, dob, gender, hometown, level, `group` FROM table_Students";
} else {
    $sql = "SELECT id, fullname, dob, gender, hometown, level, `group` FROM table_Students 
            WHERE fullname LIKE '%$search_query%' OR hometown LIKE '%$search_query%'";$result = $conn->query($sql);
}
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<!DOCTYPE html>
    <html lang='vi'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Danh Sách Sinh Viên</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
                background-color: #fff;
            }
            th, td {
                padding: 10px;
                text-align: left;
                border: 1px solid #ddd;
                
            }
            th {
                background-color: #243665;
                color: #8BD8BD;
            }
            tr {
                background-color: #CCFFCC;
            }
            tr:hover {
                background-color: white;
            }
            a {
                text-decoration: none;
                color: #007BFF;
                margin: 5px;
            }
            a:hover {
                color: #0056b3;
            }
            .container {
                width: 80%;
                margin: auto;
                overflow: hidden;
                padding: 20px;
            }
            .button {
                background-color: #ADEFD1FF;
                color: #00203FFF;
                padding: 10px 20px;
                text-align: center;
                border-radius: 5px;
                text-decoration: none;
                margin-top: 20px;
                display: block;
                width: 200px;

            }
            .button:hover {
                background-color: #ADEFD1FF;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <h2>Danh Sách Sinh Viên</h2>
            <form method='post' class='search-box'>
                <label for='search'>Tìm kiếm theo tên hoặc quê quán:</label>
                <input type='text' id='search' name='search' value='" . htmlspecialchars($search_query) . "' required>
                <button type='submit' name='search_button'>Tìm kiếm</button>
            </form>   
                        
            <table>
                <tr>
<th>id</th>
                    <th>fullname</th>
                    <th>dob</th>
                    <th>gender</th>
                    <th>hometown</th>
                    <th>level</th>
                    <th>group</th>
                    <th>Update</th>
                </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['fullname'] . "</td>
                <td>" . $row['dob'] . "</td>
                <td>" . ($row['gender'] == 1 ? 'Nam' : 'Nữ') . "</td>
                <td>" . $row['hometown'] . "</td>
                <td>" . ($row['level'] == 0 ? 'Tiến Sĩ' : ($row['level'] == 1 ? 'Thạc Sĩ' : ($row['level'] == 2 ? 'Kỹ Sư' : 'Khác'))) . "</td>
                <td>" . $row['group'] . "</td>
                <td>
                    <a href='edit.php?id=" . $row['id'] . "'>Sửa</a>  
                    <a href='delete.php?id=" . $row['id'] . "'>Xóa</a>
                </td>
              </tr>";
    }

    echo "</table>
        <div>
            <a href='add.php' class='button'>Thêm Sinh Viên</a>
        </div>
        </div>
       
    </body>
    </html>";
} else {
    echo "Không có dữ liệu sinh viên nào!";
}

?>