<?php
session_start();
include "Ayos_db_connect.php";

if(isset($_POST['userName']) && isset($_POST['password'])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return data;
    }
}

$uname = validate($_POST['userName']);
$pass = validate($_POST['password']);

if (empty($uname)) {
    header("Location: Ayos_Login.php?erro=User Name is required");
    exit;
}
else if(empty($pass)) {
    header("Location: Ayos_Login.php?erro=Password is required");
    exit;
}

$sql = "SELECT * FROM admins WHERE user_name='$uname' AND password='$password'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if($row['user_name'] === $uname && $row['password'] === $pass) {
        echo "Logged In!";
        $_SESSION['user_name'] = $row['user_name'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['id'] = $row['id'];
        header("Location: home.php");
        exit();
    }
    else{
        header("Location: Ayos_Login.php?erro=Incorrect User Name or Password");
        exit();
    }
}
else {
    header("Location:  Ayos_Login.php");
    exit();
}