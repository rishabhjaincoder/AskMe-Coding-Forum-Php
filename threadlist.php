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
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
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

    <!-- ------------------- Browse Questions ------------------- -->
    <div class="container text-center my-4">
        <h2 class="my-4">AskMe - Browse Questions</h2>
        <hr>
    </div>
    <div class="container my-4 px-5 min-height">
        <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
    $result = mysqli_query($conn,$sql);

    while($row = mysqli_fetch_assoc($result)){
        $id = $row['thread_id'];
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        global $catname;
        echo '<div class="media row my-3">
            <div class="col-12 col-md-1 d-flex justify-content-center">
                <img class="mr-3" width="60px" height="60px" src="img/user-default/user.png"
                alt="Generic placeholder image">
            </div>
            <div class="col-12 col-md-11">
                <div class="media-body">
                    <h5 class="mt-3 mt-md-0 hover-underline"><a style="text-decoration: none; color: black;" href="thread.php?threadid='. $id .'">'. $title .'</a></h5>
                   '. $desc .'
                </div>
            </div>
        </div>';
    }
    ?>
        <!-- will remove this dummy data later 
        <div class="media row my-3">
            <div class="col-12 col-md-1 d-flex justify-content-center">
                <img class="mr-3" width="60px" height="60px" src="img/user-default/user.png"
                    alt="Generic placeholder image">
            </div>
            <div class="col-12 col-md-11">
                <div class="media-body">
                    <h5 class="mt-3 mt-md-0">Pandas replace function not working on datafram with floats</h5>
                    I am using Pandas' replace function and it works on one DataFrame but not on another and I don't
                    understand why. I have tried many different solutions but nothing seems to work
                </div>
            </div>
        </div>
    -->

    </div>

    <!-- ------------------- Footer ------------------- -->
    <?php include 'partials/_footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"
        integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous">
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script> -->
</body>

</html>