<?php
    session_start();
    include '../config/conn.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT * FROM user WHERE userNAME ='$username' AND userPASS ='$password'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $user['userID'];
            $_SESSION['user_username'] = $user['username'];
            header("location: dashboard.php");
        } else {
            $error = "Username atau password salah!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WM Admin Login</title>
</head>
<body>
    <main>
        <h1>Silahkan Login</h1>
        <form method="POST">
            <input type="text" name="username" id="" placeholder="Username">
            <input type="password" name="password" id="" placeholder="Password">
            <button type="submit">Login</button>
        </form>
        <a href="../public/index.php">atau kembali ke halaman pengguna</a>
    </main>
</body>
</html>
