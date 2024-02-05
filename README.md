# CRUD-App-using-PHP-MySQL

### [Live Preview - Click to Open](https://php-mysql-crud-app.000webhostapp.com/index.php)

![Preview Image](https://github.com/AmanKumarSinhaGitHub/CRUD-App-using-PHP-MySQL/assets/65329366/fdd01fae-afc0-4543-a542-9db27913dea2)

This repository contains a simple CRUD (Create, Read, Update, Delete) application using PHP and MySQL. The application allows users to manage user details in a MySQL database.

### In this branch we will learn crud operation with images

Add one more column to store images in Database named **"photo"** type **"mediumtext"**

```html
<!-- Add this line to work with images in "add-user.php form"  -->
<!-- enctype="multipart/form-data" -->
<!-- action="" This is often used when you want the form data to be processed by the same page or script that contains the form. -->

<form action="" method="post" enctype="multipart/form-data">
  <!-- Input field for user's photo -->
  <div class="mb-3">
    <label for="photo" class="form-label">Photo</label>
    <!-- Input type set to "file" for handling file uploads -->
    <!-- Accept attribute set to "image/*" to restrict file types to images -->
    <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
  </div>
</form>
```

Edit php code of add-user.php

```php
// File upload handling
$photo = $_FILES['photo']['name'];          // Get the original name of the uploaded file
$temp_name = $_FILES['photo']['tmp_name'];  // Get the temporary name assigned to the file by the server
$folder = "uploads/";                       // Set the folder where uploaded files will be stored

// Move the uploaded file from the temporary location to the specified folder
move_uploaded_file($temp_name, $folder . $photo);

// Edit the sql query and add photo and also create a "uploads" folder in your project
$sql = "INSERT INTO `userdetails` (`name`, `email`, `mobile`, `password`, `photo`) VALUES ('$name', '$email', '$mobile', '$password', '$photo')";
```

All set. Now you can insert photo in your db

## Now lets learn how to display or fetch img from db

Open "display-user.php" file and make some changes.


```php
<!-- Loop through each user record -->
while ($row = mysqli_fetch_assoc($result)) {
  $id = $row["id"];
  $name = $row["name"];

  // Store photo in variable
  $photo = $row["photo"];

  echo
    '<tr>
      <th scope="row">' . $id . '</th>
      <td>' . $name . '</td>
     
      <!-- Display user photo -->

      <td><img src="uploads/' . $photo . '" alt="User Photo" style="width: 75px; height: 75px;"></td>
    </tr>';
}
```

All set Your photo will be displayed.


Our More Branches

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

## Crud Operations with Images

```bash
git checkout crud-with-images
```
