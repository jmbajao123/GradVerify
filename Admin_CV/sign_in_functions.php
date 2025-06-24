<?php
session_start();
include "conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['email']) && !empty($_POST['password'])) {
    function validate($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    // Using prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email'];
        $_SESSION['a_id'] = $row['a_id'];
        $_SESSION['password'] = $row['password'];

        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Sign in Success!',
                    text: 'Welcome to Credentials Verification Sibugay Technical Institute Inc, Admin.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location = 'dashboard.php';
                });
            });
        </script>";
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Login Failed!',
                    text: 'Incorrect Username or Password!',
                    icon: 'error',
                    confirmButtonText: 'Try Again'
                }).then(() => {
                    window.location = 'index.php';
                });
            });
        </script>";
    }
    $stmt->close();
    $conn->close();
} else {
    header("Location: index.php");
    exit();
}
?>