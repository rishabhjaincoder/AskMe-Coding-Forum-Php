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
    <title>Welcome to AskMe - Coding Forum</title>
</head>

<body>
    <?php include 'partials/_header.php'; ?>
    <?php include 'partials/_dbconnect.php'; ?>

    <!-- ------------------- carousel ------------------- -->
    <div id="carouselExampleFade" class="carousel slide carousel-bg" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="carousel-img" src="img/slider/1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img class="carousel-img" src="img/slider/2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img class="carousel-img" src="img/slider/3.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- ------------------- Category Cards ------------------- -->
    <div class="container text-center my-3">
        <h2>AskMe - Browse Categories</h2>
        <hr>
        <div class="row my-3">
            <!-- fetching categories from categories table -->
            <?php
        $sql = "SELECT * FROM `categories`";
        $result = mysqli_query($conn,$sql);
        $count_img =1; // just for incrementing image count
        while($row = mysqli_fetch_assoc($result)){
            $id = $row['category_id'];
            $cat = $row['category_name'];
            $desc = $row['category_description'];
            // https://source.unsplash.com/500x400/?coding,'. $cat .'
            echo '<div class="col-12 col-sm-12 col-md-6 col-lg-4 my-2">
                    <div class="card" style="width: 18rem; margin: 0 auto;">
                        <a href="threadlist.php?catid='. $id .'">
                        <img src="img/card/'. $count_img .'.jpg" class="card-img-top cat-img" alt="..."></a>
                        <div class="card-body">
                            <h5 class="card-title"><a style="text-decoration: none; color: black;" href="threadlist.php?catid='. $id .'">'. $cat .'</a></h5>
                            <p class="card-text">'. substr($desc, 0 ,90) .'...</p>
                            <a href="threadlist.php?catid='. $id .'" class="btn btn-primary view-thread-button">View Threads</a>
                        </div>
                    </div>
                </div>';
            $count_img++;
        }
        ?>
        </div>
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