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
$product = $_POST['product'];
$cfg = $_POST['cfg'];
$sn = $_POST['sn'];
$company = $_POST['company'];
$hardware = $_POST['hardware'];
$model = $_POST['model'];
$step = $_POST['step'];
$date = $_POST['date'];
$sql = "INSERT INTO `WSTRON` (`sn`) VALUES ('$sn')";
$sql_smt = "INSERT INTO `WSTRON` (`product`, `cfg`, `sn`, `company`, `hardware`, `model`, `lb_date_smt`)
SELECT $product, $cfg, '$sn', $company, $hardware, $model, '$date'
WHERE NOT EXISTS(
SELECT 1 FROM `WSTRON` WHERE ((`sn` = '$sn'))
)";
if($step == 'SMT') {
	echo "step:" . $step;
	$sql = $sql_smt;
} elseif($step == 'SELL') {
	echo "step:" . $step;
	$sql = $sql_sell;
}
if ($conn->query($sql) === TRUE) {
	//echo "插入成功:" . $sql;
	echo "插入成功";
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>