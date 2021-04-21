<?php
$showError = "false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $email = $_POST['loginEmail'];
    $pass = $_POST['loginPass'];
    if($email!="" or $pass!=""){
        $Sql = "SELECT * FROM `users` WHERE user_email = '$email'";
        $result = mysqli_query($conn, $Sql);
        $numRows = mysqli_num_rows($result);
        if($numRows!=1){
            $showError = "Couldn’t find a AskMe account associated with this username";
            header("Location: /forum/index.php?loginsuccess=false&error=$showError");
        }
        else{
            $row = mysqli_fetch_assoc($result);
            if(password_verify($pass, $row['user_pass']) && $email!=""){
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['sno'] = $row['sno'];
                $_SESSION['useremail'] = $email;
                header("Location: /forum/index.php");    
                exit();
            }
            else{
                $showError = "Invalid Credentials";
                header("Location: /forum/index.php?loginsuccess=false&error=$showError");
            }
            
        }
    }
    else{
        $showError = "Cannot submit a blank form";
        header("Location: /forum/index.php?loginsuccess=false&error=$showError");
    }
}
?>