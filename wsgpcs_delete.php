<?php
$servername = "localhost";
$username = "root";
$password = "wesage";
$dbname = "wsg_pcs_wstron";

$conn = new mysqli($servername, $username, $password, $dbname);

// 检测连接是否成功
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 在insert.php中处理请求
// $name = $_POST['name'];
// $age = $_POST['age'];

// $sql = "INSERT INTO users (name, age) VALUES ('$name', '$age')";

$who = $_POST['who'];
$table = $_POST['table'];
$sn = $_POST['sn'];

$sql = "DELETE FROM $table
WHERE ((`sn` = '$sn'));";


if ($conn->query($sql) === TRUE) {
    echo "删除成功:" . $sql;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
