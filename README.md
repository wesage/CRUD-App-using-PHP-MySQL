# CRUD-App-using-PHP-MySQL


```php
<?php

include("connect.php");

$id = $_GET['updateID'];

if (isset($_POST["submit"])) {

  // Retrieve user inputs from the form
  $name = $_POST['name'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $password = $_POST['password'];

  // Validate if all fields are filled
  if (empty($name) || empty($email) || empty($mobile) || empty($password)) {
    echo "All fields are required";
  } else {
    // Construct SQL query to insert update data into the 'userdetails' table
    $sql = "UPDATE `userdetails` SET `id`='$id',`name`='$name',`email`='$email',`mobile`='$mobile',`password`='$password' WHERE `id`='$id'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
      header("location:display-user.php");
    } else {
      die(mysqli_error($conn));
    }
  }
}

$conn->close();
?>
```












## Insert Data
```bash
git checkout main
```

## Fetch Data
```bash
git checkout read-data
```

## Delete Data
```bash
git checkout delete-data
```

## Update Data
```bash
git checkout update-data
```