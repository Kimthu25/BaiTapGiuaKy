<?php
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname']; 
    $dob = $_POST['dob'];  
    $dob = DateTime::createFromFormat('d/m/Y', $dob)->format('Y-m-d'); 
    $gender = $_POST['gender']; 
    $hometown = $_POST['hometown']; 
    $level = $_POST['level']; 
    $group = $_POST['group']; 

    $insert_sql = "INSERT INTO table_Students (fullname, dob, gender, hometown, level, `group`) 
                   VALUES ('$fullname', '$dob', '$gender', '$hometown', '$level', '$group')";

    if ($conn->query($insert_sql) === TRUE) {
        echo "Sinh viên đã được thêm thành công!";
        header("Location: index.php"); 
        exit();
    } else {
        echo "Lỗi thêm sinh viên: " . $conn->error;
    }
}
?>

<h1>Thêm thông tin sinh viên</h1>

<form method="post" action="">
    <label for="fullname">Họ và tên:</label>
    <input type="text" id="fullname" name="fullname" required><br><br>

    <label for="dob">Ngày sinh:</label>
    <input type="text" id="dob" name="dob" placeholder="DD/MM/YYYY" required><br><br>

    <label for="gender">Giới tính:</label>
    <input type="radio" id="male" name="gender" value="1" required>
    <label for="male">Nam</label>
    <input type="radio" id="female" name="gender" value="0" required>
    <label for="female">Nữ</label><br><br>

    <label for="hometown">Quê quán:</label>
    <input type="text" id="hometown" name="hometown" required><br><br>

    <label for="level">Trình độ học vấn:</label>
    <select name="level" id="level" required>
        <option value="0">Tiến Sĩ</option>
        <option value="1">Thạc Sĩ</option>
        <option value="2">Kỹ Sư</option>
        <option value="3">Khác</option>
    </select><br><br>

    <label for="group">Nhóm:</label>
    <input type="number" id="group" name="group" required><br><br>

    <input type="submit" value="Lưu">
</form>

<br>
<a href="index.php">Trở về trang danh sách sinh viên</a>