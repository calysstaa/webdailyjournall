<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $username = $_POST['user'];
    $password = md5($_POST['pass']); 

    $query = "SELECT * FROM user WHERE username=? AND password=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("location:admin.php");
    } else {
        echo "<script>alert('Username atau Password Salah!');</script>";
    }
}
?>
<form method="POST">
    <input type="text" name="user" placeholder="Username" required>
    <input type="password" name="pass" placeholder="Password" required>
    <button type="submit" name="login">Login</button>
</form>
