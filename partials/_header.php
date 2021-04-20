<?php
include 'partials/_dbconnect.php';

session_start();
echo ' <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
    <a class="navbar-brand" href="/forum/">AskMe</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
    aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="/forum/">Home</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="about.php">About</a>
    </li>
    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
    data-bs-toggle="dropdown" aria-expanded="false">
    Top Categories
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
    
    // fetching categories name for navigation category option
    $sql = "SELECT * FROM `categories`";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $cat_id = $row['category_id'];
        $cat_name = $row['category_name'];
        echo '<li><a class="dropdown-item" href="threadlist.php?catid='. $cat_id .'"> '. $cat_name .' </a></li>';
    }

    echo ' 
        </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="contact.php" >Contact</a>
            </li>
        </ul>';

        // handling Welcome Email option after login
        if(isset($_SESSION['loggedin']) and $_SESSION['loggedin']==true){
            echo '<form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-primary" type="submit">Search</button>
                    <p class="text-light mx-4 my-0 text-center"> Welcome '. $_SESSION['useremail'] .'</p>
                <a href="partials/_logout.php" class="btn btn-outline-primary ml-2 py-2">Logout</a>
                </form>';
        }
        else{
            echo '
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-primary" type="submit">Search</button>
            </form>
            <div class="mx-2">
                <button class="btn btn-outline-primary ml-2 mt-2 mt-lg-0" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                <button class="btn btn-outline-primary mx-2 mt-2 mt-lg-0" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>
            </div>';
        }

        echo '
            </div>
            </div>
            </nav>';

include "partials/_loginModal.php";
include "partials/_signupModal.php";

// handling signup alerts
if(isset($_GET['signupsuccess']) and $_GET['signupsuccess']=="true"){
    echo '<script type="text/javascript">
            Swal.fire(
            "Successfully Signed up!",
            "You can now login",
            "success"
            )
            </script>';
        }
elseif(isset($_GET['signupsuccess']) and $_GET['signupsuccess']!="true" and isset($_GET['error'])){
    $error = $_GET['error'];
    echo '<script type="text/javascript">
    Swal.fire(
            "'. $error .'!",
            "Try Again",
            "error"
            )
            </script>';
        }

// handling login alerts
    if(isset($_GET['loginsuccess']) and $_GET['loginsuccess']!="true" and isset($_GET['error'])){
    $error = $_GET['error'];
    echo '<script type="text/javascript">
    Swal.fire(
            "'. $error .'!",
            "Try Again",
            "error"
            )
            </script>';
        }
?>