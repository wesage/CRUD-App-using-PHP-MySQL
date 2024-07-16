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

$sn = $_GET['sn'];

// 在select.php中处理请求
$sql = "SELECT * FROM `WSTRON`
WHERE ((`sn` = '$sn'));";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $rows = array();
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    echo json_encode($rows);
} else {
    echo "0 结果";
}

$conn->close();
?>
