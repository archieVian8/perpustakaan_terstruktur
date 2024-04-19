<?php
session_start();

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'perpustakaan');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password' AND role='$role'";
    $result = mysqli_query($link, $sql);
    $count = mysqli_num_rows($result);

    if($count == 1){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $row['role'];
        header("location: fitur.php");
    } else {
        $error = "Username, Password, or Role is invalid";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <select name="role" required>
            <option value="">Select Role</option>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select><br>
        <input type="submit" value="Login">
    </form>
    <?php if(isset($error)) echo $error; ?>
    <p>Don't have an account? <a href="register.php">Register here</a>.</p>
</body>
</html>
