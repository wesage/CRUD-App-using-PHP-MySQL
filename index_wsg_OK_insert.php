<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "wesage";
$database = "wsg_pcs_wstron";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check if the database connection is successful
if (!$conn) {
  die("Connection Error". mysqli_error($conn));
}

// Check if the form is submitted using the POST method
if (isset($_POST["submit"])) {

  // Retrieve user inputs from the form
  // $name = $_POST['name'];
  // $email = $_POST['email'];
  // $mobile = $_POST['mobile'];
  // $password = $_POST['password'];
  $sn = $_POST['sn'];

  // Validate if all fields are filled
  // if (empty($name) || empty($email) || empty($mobile) || empty($password)) {
  if (empty($sn)) {
    //echo "All fields are required";
    echo "sn fields are required,wesage";
  } else {
    // Construct SQL query to insert data into the 'userdetails' table
    //$sql = "INSERT INTO `userdetails` (`name`, `email`, `mobile`, `password`) VALUES ('$name', '$email', '$mobile', '$password')";
    $sql = "INSERT INTO `WSTRON` (`sn`) VALUES ('$sn')";

    // Execute the SQL query
    $result = mysqli_query($conn, $sql);

    // Check if the query execution was successful
    if ($result) {
      //echo "New record created successfully";
      echo "New record created successfully,sn,wesage";
    } else {
      die(mysqli_error($conn));
    }
  }
}

// Close the database connection
$conn->close();
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CRUD App using PHP MySQL</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

  <style>
    html,
    body {
      background-color: gainsboro;
    }
  </style>

  <div class="container py-5 px-5">

    <div class="container text-center py-3">
      <h2>CRUD OPERATIONS</h2>
    </div>

    <!-- Form with POST method to submit data to PHP -->
    <form method="post">
    
      <div class="mb-3">
        <label for="name" class="form-label">Sn</label>
        <input type="name" class="form-control" name="sn" id="sn" placeholder="Enter Your Sn">
      </div>

      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
