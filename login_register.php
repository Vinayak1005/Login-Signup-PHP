<?php
session_start();
require_once 'config.php';


if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['register_error'] = 'Email is already registered';
        $_SESSION['action_form'] = 'register';
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $password, $role);
        $stmt->execute();
    }

    $stmt->close();
    header("Location: index.php");
    exit();
}


if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT name, email, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($name, $db_email, $db_password, $role);
        $stmt->fetch();

        if (password_verify($password, $db_password)) {
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $db_email;
            $_SESSION['role'] = $role;

            $stmt->close();
            header("Location: " . ($role === 'admin' ? 'admin_page.php' : 'user_page.php'));
            exit();
        }
    }

    $stmt->close();
    $_SESSION['login_error'] = 'Incorrect email or password';
    $_SESSION['action_form'] = 'login';
    header("Location: index.php");
    exit();
}
?>
