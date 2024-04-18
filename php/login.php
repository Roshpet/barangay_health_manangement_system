<?php
session_start();
include "../php/conn.php";

if (isset($_POST['btn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row['password'])) {
            // Set session variables
            $_SESSION['id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['usertype'] = $row['usertype'];
            $_SESSION['fullname'] = $row['fullname'];
            $_SESSION['age'] = $row['age'];
            $_SESSION['bloodtype'] = $row['bloodtype'];
            $_SESSION['gender'] = $row['gender'];
            $_SESSION['address'] = $row['address'];
            $_SESSION['allergies'] = $row['allergies'];
            $_SESSION['phoneNo'] = $row['phoneNo'];

            // Redirect based on user type
            if (strtolower($row['usertype']) == 'resident') {
                header('location: dashboard.php');
            } elseif (strtolower($row['usertype']) == 'admin') {
                header('location: admin-dashboard.php');
            }
            exit();
        } else {
            // Incorrect password
            echo "<script>alert('Invalid password');</script>";
        }
    } else {
        // User not found
        echo "<script>alert('User not found');</script>";
    }

    // Close prepared statement
    $stmt->close();
}
