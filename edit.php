<?php
include "connect.php";

$id = $_GET['id'];

    $sql = "SELECT * FROM table_Students WHERE id = $id";
    $query = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc( $query);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy dữ liệu từ form
        $fullname = $_POST['fullname'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $hometown = $_POST['hometown'];
        $level = $_POST['level'];
        $group = $_POST['group'];

        $update_sql = "UPDATE table_Students SET fullname = '$fullname', dob = '$dob', gender = $gender, hometown = '$hometown', level = $level, `group` = $group WHERE id = $id";

        if ($conn->query($update_sql) === TRUE) {
            echo "Cập nhật thành công!";
            header("Location: index.php"); 
            exit();
        } else {
            echo "Lỗi cập nhật: " . $conn->error;
        }
    }  

?>


    <h1>Chỉnh sửa thông tin sinh viên</h1>

    <form method="post" action="edit.php?id=<?php echo $row['id']; ?>">
        <label for="fullname">Họ và tên:</label>
        <input type="text" id="fullname" name="fullname" value="<?php echo $row['fullname']; ?>" required><br><br>

        <label for="dob">Ngày sinh:</label>
        <input type="date" id="dob" name="dob" value="<?php echo $row['dob']; ?>" required><br><br>

        <label for="gender">Giới tính:</label>
        <input type="radio" id="male" name="gender" value="1" required>
        <label for="male">Nam</label>
        <input type="radio" id="female" name="gender" value="0" required>
        <label for="female">Nữ</label><br><br>

        <label for="hometown">Quê quán:</label>
        <input type="text" id="hometown" name="hometown" value="<?php echo $row['hometown']; ?>" required><br><br>

        <label for="level">Trình độ học vấn:</label>
        <select name="level" id="level" required>
          <option value="0">Tiến Sĩ</option>
          <option value="1">Thạc Sĩ</option>
          <option value="2">Kỹ Sư</option>
          <option value="3">Khác</option>
        </select><br><br>

        <label for="group">Nhóm:</label>
        <input type="number" id="group" name="group" value="<?php echo $row['group']; ?>" required><br><br>

        <input type="submit" value="Cập nhật">
    </form>

    <br>
    <a href="index.php">Trở về trang danh sách sinh viên</a>