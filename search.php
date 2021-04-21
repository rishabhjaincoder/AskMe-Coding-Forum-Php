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
    <title>Search Results - AskMe</title>
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>

    <!-- ------------------- search results ------------------- -->
    <div class="container" style="min-height: 95vh;">
        <div class="text-center pb-1">
            <h2 class="mt-4 mb-3 display-5">Search Results for "<em><?php echo $_GET['query'] ?></em>&nbsp;"</h2>
            <hr>
        </div>
        <?php 
        $query = $_GET['query'];
        $noresult =true;
        $sql = "SELECT * FROM `threads` WHERE MATCH (thread_title, thread_desc) against ('".$query."')";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $noresult = false;
            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];

            // highlighting text
            $updatedQuery = '<span style="background-color: yellow;">'. $query .'</span>';
            $updatedTitle = str_ireplace($query, $updatedQuery, $title);
            $updatedDesc = str_ireplace($query, $updatedQuery, $desc);
            
            $thread_user_id = $row['thread_user_id'];
            $thread_time = $row['timestamp'];
            $new_time = date(' jS \of F Y - h:i A',strtotime($thread_time));

            // getting user email from users table
            $sql2 = "SELECT user_email FROM `users` WHERE sno=$thread_user_id";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2); 
            $user_email = $row2['user_email'];
            
            echo '<div class="result my-5">
                    <h3 class="hover-underline">
                        <a style="text-decoration: none;" href="/forum/thread.php?threadid='.$id.'" class="text-dark">
                        '. $updatedTitle .'
                        </a></h3>
                    <p class="lead">'. $updatedDesc .'</p>
                   <h6 class="mt-0 mt-md-0">Asked by <i style="color: #428bca;">'. $user_email .'</i> at '. $new_time .'</h6>
                    <hr>
                </div>';
            }
            if($noresult){
                echo '<div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-4 text-center">No Results Found</h1>
                            <p class="lead mb-1">
                            Suggestions: 
                                <ul>
                                    <li>Make sure that all the words are spelled correctly.</li>
                                    <li>Try different keywords.</li>
                                    <li>Try more general keywords.</li>
                                </ul>
                            </p>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script> -->
</body>

</html>