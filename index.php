<?php
session_start();
$errors = [
    'login' => $_SESSION['login_error'] ?? '',
    'register' => $_SESSION['register_error'] ?? '',
];
$actionForm = $_SESSION['action_form'] ?? 'login';
unset($_SESSION['login_error'], $_SESSION['register_error'], $_SESSION['action_form']);

function showError($error) {
    return !empty($error) ? "<p class='error-message'>" . htmlspecialchars($error) . "</p>" : '';
}
function inActiveForm($formName, $actionForm) {
    return $formName === $actionForm ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login & Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
   
    <div class="form-box <?= inActiveForm('login', $actionForm) ?>" id="login-form">
        <form action="login_register.php" method="post">
            <h2>Login</h2>
            <?= showError($errors['login']) ?>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
            <p>Don't have an account? <a onclick="showForm('register-form')">Register</a></p>
        </form>
    </div>

   
    <div class="form-box <?= inActiveForm('register', $actionForm) ?>" id="register-form">
        <form action="login_register.php" method="post">
            <h2>Register</h2>
            <?= showError($errors['register']) ?>
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="role" required>
                <option value="">Select Role</option>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <button type="submit" name="register">Register</button>
            <p>Already have an account? <a onclick="showForm('login-form')">Login</a></p>
        </form>
    </div>
</div>

<script>
    function showForm(id) {
        document.getElementById('login-form').classList.remove('active');
        document.getElementById('register-form').classList.remove('active');
        document.getElementById(id).classList.add('active');
    }
    window.onload = () => showForm('<?= $actionForm ?>-form');
</script>
</body>
</html>
