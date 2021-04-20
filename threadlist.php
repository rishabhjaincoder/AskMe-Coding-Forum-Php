<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@400;500&display=swap" rel="stylesheet">

    <!-- these are for swal alerts  -->
    <script src="js/sweetalert2.all.min.js"></script>

    <!-- adding custom css -->
    <link rel="stylesheet" href="css/style.css">
    <title>About - Coding Forum</title>
</head>

<body>
    <?php include 'partials/_header.php'; ?>
    <?php include 'partials/_dbconnect.php'; ?>

    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
    }
    ?>

    <?php
    $showAlert = false;
    $showErr = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {

        // will add code here to check if the user is logged in or not

        $post_sno = $_POST["sno"];  // hidden userid coming from submitting thread form
        // insert thread into database
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];
        if ($th_title!="" and $th_desc!=""){
            
            // this will replce < and > with &ltl and &gt; in order to prevent sql injection or other attacks
            $th_title = str_replace("<", "&lt;", $th_title);
            $th_title = str_replace(">", "&gt;", $th_title);
            $th_desc = str_replace("<", "&lt;", $th_desc);
            $th_desc = str_replace(">", "&gt;", $th_desc);
            
            $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$post_sno', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            $showAlert = true;
            if ($showAlert) {
                echo '<script type="text/javascript">
                Swal.fire(
                    "Your thread has been added!",
                    "Please wait for community to respond.",
                    "success"
                    )
                    </script>';
            }   
        }
        else{
            $showErr = true;
            if ($showErr) {
                echo '<script type="text/javascript">
                Swal.fire(
                    "Cannot submit empty form!",
                    "Try Again",
                    "error"
                    )
                    </script>';
            }  
        }

    }
    ?>

    <!-- ------------------- Jumbotron ------------------- -->
    <div class="container-fluid bg-dark text-light my-0 py-3 px-5">
        <div class="jumbotron-fluid">
            <h1 class="display-4">Welcome to <?php echo $catname ?> Forums!</h1>
            <p class="lead"><?php echo $catdesc ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do not
                post copyright-infringing material. Do not post “offensive” posts, links or images. Remain respectful of
                other members at all times</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
    </div>

    <!-- ------------------- BreadCrumb ------------------- -->
    <div class="container my-3" style="font-size: 20px;">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/forum/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $catname ?></li>
            </ol>
        </nav>
    </div>

    <!-- ------------------- Form for adding a thread ------------------- -->

    <!-- $_SERVER['REQUEST_URI'] gives the current url along with parameters -->
    <!-- $_SERVER['PHP_SELF'] gives the current url without parameters -->
    <?php
    if(isset($_SESSION['loggedin']) and $_SESSION['loggedin']==true){
        echo '
        <div class="container">
            <div class="text-center pb-0">
                <h2 class="mt-4 mb-3">AskMe - Start a Discussion</h2>
            </div>
            <form class="mx-2" action="';
            echo $_SERVER['REQUEST_URI'];
            echo  '" method="POST">
                <div class="form-group">
                    <label for="title"><b>Problem Title</b></label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp"
                        placeholder="Enter Problem Title Here">
                    <small id="emailHelp" class="form-text text-muted">Keep your title as short and crisp as
                        possible</small>
                </div>
                <input type="hidden" name="sno" value="'. $_SESSION["sno"] .'">
                <div class="form-group my-1">
                    <label for="desc"><b>Elaborate Your Concern</b></label>
                    <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </form>
        </div>';
    }
    else{
        echo '<div class="container text-center">
                <h2 class="mt-4 mb-3">AskMe - Start a Discussion</h2>
                <div class="alert alert-primary hover-underline" role="alert">
                <a style="cursor: pointer; font-size: 18px;" data-bs-toggle="modal" data-bs-target="#loginModal">You are not logged in! Please login to start a discussion.</a>
                </div>
              </div>';
    }
?>

    <!-- ------------------- Browse Questions ------------------- -->
    <div class="container text-center my-4">
        <h2 class="my-4">Browse Questions</h2>
        <hr>
    </div>
    <div class="container my-4 px-5 min-height">
        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_user_id = $row['thread_user_id'];
            $thread_time = $row['timestamp'];
            $new_time = date(' jS \of F Y - h:i A',strtotime($thread_time));

            // getting user email from users table
            $sql2 = "SELECT user_email FROM `users` WHERE sno=$thread_user_id";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2); 
            $user_email = $row2['user_email'];

            echo '<div class="media row my-3">
            <div class="col-12 col-md-1 d-flex justify-content-center">
                <img class="mr-3" width="60px" height="60px" src="img/user-default/user.png"
                alt="Generic placeholder image">
            </div>
            <div class="col-12 col-md-11">
                <div class="media-body">
                <h5 class="mt-3 mt-md-0 hover-underline"><a style="text-decoration: none; color: black;" href="thread.php?threadid=' . $id . '">' . $title . '</a></h5>
                   ' . $desc . '
                   <h6 class="mt-0 mt-md-0">Asked by <i style="color: #428bca;">'. $user_email .'</i> at '. $new_time .'</h6>
                </div>
            </div>
        </div>';
        }
        if ($noResult) {
            echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4 text-center">No Threads Found</h1>
          <p class="lead text-center">Be the first person to ask a question.</p>
        </div>
      </div>';
        }
        ?>

    </div>

    <!-- ------------------- Footer ------------------- -->
    <?php include 'partials/_footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"
        integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous">
    </script>

    <!-- this will prevent form resubmission when page is reloaded -->
    <script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script> -->
</body>

</html>