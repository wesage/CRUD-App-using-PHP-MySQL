<?php
$servername = "localhost";
$username = "root";
$password = "wesage";
$dbname = "wsg_pcs_wstron";
$conn = new mysqli($servername, $username, $password, $dbname);
//创建WSTRON_Customer表,wesage
/* //MySQL
DROP TABLE `WSTRON_Customer`;
CREATE TABLE IF NOT EXISTS WSTRON_Customer (
    keyid INTEGER PRIMARY KEY AUTO_INCREMENT,
    id TEXT,
    customer TEXT
);
// 创建表的 SQL 语句
$createTableSql = "CREATE TABLE IF NOT EXISTS WSTRON_Customer (
    keyid INTEGER PRIMARY KEY AUTO_INCREMENT,
    id TEXT,
    customer TEXT
)"; */
//创建WSTRON_Model表,wesage
/* //MySQL
DROP TABLE `WSTRON_Model`;
CREATE TABLE IF NOT EXISTS WSTRON_Model (
    keyid INTEGER PRIMARY KEY AUTO_INCREMENT,
    id TEXT,
    model TEXT
); */
// 检测连接是否成功
if ($conn->connect_error) {
	die("连接失败: " . $conn->connect_error);
}
// 从数据库中获取客户数据
function getCustomers($conn) {
	$sql = "SELECT DISTINCT customer FROM WSTRON_Customer";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();
	$customers = [];
	while ($row = $result->fetch_assoc()) {
		$customers[] = $row['customer'];
	}
	return $customers;
}
$customers = getCustomers($conn);
// 从数据库中获取客户数据
function getModels($conn) {
	$sql = "SELECT DISTINCT model FROM WSTRON_Model";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();
	$models = [];
	while ($row = $result->fetch_assoc()) {
		$models[] = $row['model'];
	}
	return $models;
}
$models = getModels($conn);
// 在insert.php中处理请求
// $name = $_POST['name'];
// $age = $_POST['age'];
// $sql = "INSERT INTO users (name, age) VALUES ('$name', '$age')";
/* $sn = $_GET['sn'];
// 在select.php中处理请求
$sql = "SELECT * FROM $table
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
} */
$who = $_POST['who'];
$table = $_POST['table'];
//$table = 'IVT';
// Check if the form is submitted using the POST method
if (isset($_POST["submit"])) {
	$table = $_POST['brand'];
	$model = $_POST['model'];
	$customer = $_POST['customer'];
	$express_send = $_POST['express_send'];
	$sn = $_POST['sn'];
	echo "Brand:".$table;
	echo "<br>Model:".$model;
	echo "<br>Customer:".$customer;
	echo "<br>Express_send:".$express_send;
	echo "<br>SN:".$sn;
	if (empty($express_send)) {
		//echo "All fields are required";
		echo "<br>请输入物流单号!";
	} elseif(empty($sn)) {
		echo "<br>请输入序列号!";
	} else {
		$sql_update = "UPDATE $table SET
`model` = '$model',
`customer` = '$customer',
`express_send` = '$express_send'
WHERE ((`sn` = '$sn'))";
		if ($conn->query($sql_update) === TRUE) {
			//echo "更新成功:" . $sql_update;
			$affectedRows = $conn->affected_rows;
			if ($affectedRows > 0) {
				echo "<br>更新成功!";
			} else {
				echo "<br>未找到匹配的序列号，更新未执行。";
			}
		} else {
			echo "<br>Error: " . $sql_update . "<br>" . $conn->error;
		}
		// Construct SQL query to insert data into the 'userdetails' table
		$sql_select = "SELECT * FROM $table WHERE ((`sn` = '$sn'))";
		$result = $conn->query($sql_select);
		// 显示数据
		// $product = $_POST['product'];
		// $UUID = $_POST['UUID'];
		// $cfg = $_POST['cfg'];
		// $sn = $_POST['sn'];
		// $company = $_POST['company'];
		// $CHANNEL = $_POST['CHANNEL'];
		// $hardware = $_POST['hardware'];
		// $model = $_POST['model'];
		// $customer = $_POST['customer'];
		// $lb_date_smt = $_POST['lb_date_smt'];
		// $lb_date_asm = $_POST['lb_date_asm'];
		// $lb_date_pack = $_POST['lb_date_pack'];
		// $lb_date_out = $_POST['lb_date_out'];
		// $express_send = $_POST['express_send']; 
		if ($result->num_rows > 0) {
			$rows = array();
			while ($row = $result->fetch_assoc()) {
				$rows[] = $row;
				echo "<br>";
				echo "<table border='1' align='left'>";
				echo "<tr> <td>Information</td></tr>";
				echo "<tr> <td>------------------</td></tr>";
				echo "<tr> <td>Product: " . $row["product"]. "</td></tr>";
				echo "<tr> <td>UUID: " . $row["uuid"]. "</td></tr>";
				echo "<tr> <td>Cfg: " . $row["cfg"]. "</td></tr>";
				echo "<tr> <td>SN: " . $row["sn"]. "</td></tr>";
				echo "<tr> <td>Company: " . $row["company"]. "</td></tr>";
				echo "<tr> <td>Channel: " . $row["CHANNEL"]. "</td></tr>";
				echo "<tr> <td>Hardware: " . $row["hardware"]. "</td></tr>";
				echo "<tr> <td>Model: " . $row["model"]. "</td></tr>";
				echo "<tr> <td>Customer: " . $row["customer"]. "</td></tr>";
				echo "<tr> <td>Date_SMT: " . $row["lb_date_smt"]. "</td></tr>";
				echo "<tr> <td>Date_ASM: " . $row["lb_date_asm"]. "</td></tr>";
				echo "<tr> <td>Date_PACK: " . $row["lb_date_pack"]. "</td></tr>";
				echo "<tr> <td>Date_OUT: " . $row["lb_date_out"]. "</td></tr>";
				echo "<tr> <td>Express_send: " . $row["express_send"]. "</td></tr>";
				echo "<tr> <td>------------------</td></tr>";
				echo "</table>";
				echo "<br>For more information, Please contact the dealer.";
				echo "<br>Thank you for your support.";
			}
			//echo json_encode($rows);
		} else {
			echo "<br>Sorry,we can't find the SN.";
			echo "<br>Please confirm the SN then try again.";
			echo "<br>For more information, Please contact the dealer.";
			echo "<br>Thank you for your support.";
		}
	}
}
$conn->close();
?>

<!doctype html>
<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            WSTRON Customer Information
        </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous">
    </head>
    
    <body>
        <style>
            html, body { background-color: gainsboro; }
        </style>
        <div class="container py-5 px-5">
            <div class="container text-center py-3">
                <h2>
                    WSTRON Customer Information System
                </h2>
            </div>
            <!-- Form with POST method to submit data to PHP -->
            <form method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">
                        Brand:
                    </label>
                    <select id="brand" name="brand">
                        <option value="WSTRON">
                            WSTRON
                        </option>
                        <option value="IVT">
                            IVT
                        </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">
                        型号:
                    </label>
                    <select id="model" name="model">
                        <?php foreach ($models as $model) { echo '<option value="'. htmlspecialchars($model)
                        . '">'. htmlspecialchars($model) . '</option>'; } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">
                        客户:
                    </label>
                    <select id="customer" name="customer">
                        <?php foreach ($customers as $customer) { echo '<option value="'. htmlspecialchars($customer)
                        . '">'. htmlspecialchars($customer) . '</option>'; } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">
                        物流单号:
                    </label>
                    <input type="name" class="form-control" name="express_send" id="express_send"
                    placeholder="输入物流单号" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">
                        产品序列号:
                    </label>
                    <input type="name" class="form-control" name="sn" id="sn" placeholder="输入产品序列号"
                    autocomplete="off">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">
                    提交
                </button>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous">
        </script>
    </body>

</html>