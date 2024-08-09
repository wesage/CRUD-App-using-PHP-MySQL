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
	$sn = $_POST['sn'];
	echo "Brand:".$table;
	echo "<br>SN:".$sn;
	if (empty($sn)) {
		//echo "All fields are required";
		echo "Sn fields are required!";
	} else {
		// Construct SQL query to insert data into the 'userdetails' table
		$sql = "SELECT * FROM $table WHERE ((`sn` = '$sn'))";
		$result = $conn->query($sql);
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
				echo "<tr> <td>Custome: " . $row["customer"]. "</td></tr>";
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
            WSTRON SN verify and track system
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
                    SN verify and track system
                </h2>
            </div>
            <!-- Form with POST method to submit data to PHP -->
            <form method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">
                        Brand:
                    </label>
                    <select id="brand" name="brand">
                        <option value="IVT">
                            IVT
                        </option>
                        <option value="WSTRON">
                            WSTRON
                        </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">
                        SN:
                    </label>
                    <input type="name" class="form-control" name="sn" id="sn" placeholder="Enter Your SN">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">
                    Submit
                </button>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous">
        </script>
    </body>

</html>
