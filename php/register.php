<?php
include "../php/conn.php";

if (isset($_POST["btn"])) {
    $fullname = $_POST["fullname"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $bloodtype = $_POST["bloodtype"];
    $allergies = $_POST["allergies"];
    $address = $_POST["address"];
    $phoneNo = $_POST["phoneNo"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $usertype = "Admin";

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Your email is already registered')</script>";
    } else {
        $sql = "INSERT INTO users(fullname,age,gender,bloodtype,allergies,address,phoneNo,email,password,usertype) VALUES ('$fullname','$age','$gender','$bloodtype','$allergies','$address','$phoneNo','$email','$hashed_password','$usertype')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Registration Successful')</script>";
            header("Location: ../register-admin.php");
        }
    }
}
