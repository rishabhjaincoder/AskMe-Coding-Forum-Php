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
    <title>Welcome to AskMe - Coding Forum</title>
    <style>
    * {
        font-family: 'Baloo Bhai 2', cursive;
    }

    .carousel-img {
        opacity: 0.5;
        z-index: 1;
    }

    .carousel-bg {
        background-color: black;
    }
    </style>
</head>

<body>
    <?php include 'partials/_header.php'; ?>
    <?php include 'partials/_dbconnect.php'; ?>

    <!-- ------------------- carousel ------------------- -->
    <div id="carouselExampleFade" class="carousel slide carousel-bg" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="carousel-img" src="https://source.unsplash.com/2400x400/?code,developer"
                    class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img class="carousel-img" src="https://source.unsplash.com/2400x400/?programmer,linux"
                    class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img class="carousel-img" src="https://source.unsplash.com/2400x400/?coder,programmer"
                    class="d-block w-100" alt="...">
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
        while($row = mysqli_fetch_assoc($result)){
            $cat = $row['category_name'];
            $desc = $row['category_description'];
            echo '<div class="col-12 col-sm-12 col-md-6 col-lg-4 my-2">
                    <div class="card" style="width: 18rem; margin: 0 auto;">
                        <img src="https://source.unsplash.com/500x400/?coding,'. $cat .'" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">'. $cat .'</h5>
                            <p class="card-text">'. substr($desc, 0 ,90) .'...</p>
                            <a href="#" class="btn btn-primary">View Threads</a>
                        </div>
                    </div>
                </div>';
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