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
$product = $_POST['product'];
$UUID = $_POST['UUID'];
$cfg = $_POST['cfg'];
$sn = $_POST['sn'];
$company = $_POST['company'];
$oem = $_POST['oem'];
// 录入时已输入,UUID更新暂时不用
$CHANNEL = $_POST['CHANNEL'];
$hardware = $_POST['hardware'].'_'.$_POST['software'].'_'.$_POST['test'];
// 录入时已输入,UUID更新需要更新
$model = $_POST['model'];
// 录入时已输入,UUID更新需要更新
$customer = $_POST['customer'];
$lb_date_smt = $_POST['lb_date_smt'];
$lb_date_asm = $_POST['lb_date_asm'];
$lb_date_pack = $_POST['lb_date_pack'];
$lb_date_out = $_POST['lb_date_out'];
$express_send = $_POST['express_send'];
$step = $_POST['step'];
$date = $_POST['date'];
//T5系统时间,暂时无用
$uuiddate = $_POST['uuiddate'];
$sql = "UPDATE $table SET
`product` = '$product',
`uuid` = '$UUID',
`cfg` = '$cfg',
`company` = '$company',
`CHANNEL` = '$CHANNEL',
`hardware` = '$hardware',
`model` = '$model',
`customer` = '$customer',
`lb_date_smt` = '$lb_date_smt',
`lb_date_asm` = '$lb_date_asm',
`lb_date_pack` = '$lb_date_pack',
`lb_date_out` = '$lb_date_out',
`express_send` = '$express_send'
WHERE ((`sn` = '$sn'))";
$sql_lb_date_smt = "UPDATE $table SET
`lb_date_smt` = '$date'
WHERE ((`sn` = '$sn'))";
$sql_lb_date_asm = "UPDATE $table SET
`lb_date_asm` = '$date'
WHERE ((`sn` = '$sn'))";
$sql_lb_date_pack = "UPDATE $table SET
`lb_date_pack` = '$date'
WHERE ((`sn` = '$sn'))";
$sql_lb_date_out = "UPDATE $table SET
`lb_date_out` = '$date'
WHERE ((`sn` = '$sn'))";
$sql_uuid = "UPDATE $table SET
`uuid` = '$UUID',
`cfg` = '$hardware',
`model` = '$model'
WHERE ((`sn` = '$sn'))";
if($who == 'cmm') {
	echo "who:" . $who;
	if($step == 'S') {
		echo "step:" . $step;
		$sql = $sql_lb_date_smt;
	} elseif($step == 'A') {
		echo "step:" . $step;
		$sql = $sql_lb_date_asm;
	} elseif($step == 'P') {
		echo "step:" . $step;
		$sql = $sql_lb_date_pack;
	} elseif($step == 'O') {
		echo "step:" . $step;
		$sql = $sql_lb_date_out;
	} elseif($step == 'UUID') {
		echo "step:" . $step;
		$sql = $sql_uuid;
	}
} elseif($who == 'bosszz') {
	echo "who:" . $who;
}
if ($conn->query($sql) === TRUE) {
	if($who == 'cmm') {
		echo "更新成功:" . $sql;
	} elseif($who == 'bosszz') {
		echo "更新成功:" . "bosszz";
	}
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>