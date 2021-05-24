<?php
$showError = "false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $user_name = $_POST['signupUsername'];
    $pass = $_POST['signupPassword'];
    $cpass = $_POST['signupcPassword'];

    // checking if the username already exists or not
    $existSql = "SELECT * FROM `users` WHERE user_name = '$user_name'";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);
    if($numRows > 0){
        $showError = "Username Already Exists";
        header("Location: /forum/index.php?signupsuccess=false&error=$showError");
    }
    else{
        if ($pass == $cpass && $user_name!="" && $pass!="" && $cpass!="") {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_name`, `user_pass`, `timestamp`) VALUES ('$user_name', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result){
                $showAlert = true;
                header("Location: /forum/index.php?signupsuccess=true");
                exit();
            }
        }
        else{
            if($user_name==""){
                $showError = "Cannot submit empty form";
            }
            else{
                $showError = "Passwords do not match";
            }
        }
    }
    header("Location: /forum/index.php?signupsuccess=false&error=$showError");
}
?>