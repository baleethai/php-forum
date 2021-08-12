<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Webboard">

    <title>Trimitwebboard | หน้าหลัก</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/offcanvas-navbar/">
    
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:ital,wght@0,100;0,300;0,500;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body class="bg-light">

<main class="container">

    <?php include 'partials/header.php'; ?>

    <?php
    include 'partials/connect.php';
    $query = $conn->query("SELECT * FROM posts where id ='" . $_GET['post_id']. "' ");
    $post = $query->fetch_assoc();

    $comments = $conn->query("SELECT comments.message, comments.created_at, member.username AS member_username FROM comments INNER JOIN member ON member.id = comments.member_id where comments.post_id ='" . $_GET['post_id']. "' ORDER BY comments.id DESC ");

    ?>

    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h6 class="border-bottom pb-2 mb-0"><?php echo $post['title']; ?></h6>
        <div class="d-flex text-muted pt-3">
            <div class="pb-3 mb-0 small lh-md w-100">
                <div class="d-flex justify-content-between">
                    <?php echo $post['content']; ?>
                </div>
            </div>
        </div>
        <div>
            <a href="./post.php?category_id=<?php echo $post['category_id']; ?>">กลับ</a>
        </div>
    </div>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <?php
        if ($comments->num_rows > 0) {
                $no = 1;
              while($row = $comments->fetch_assoc()) {
        ?>
        <div class="bg-body d-flex text-muted pt-3">
            <img src="./images/male-1.jpg" class="rounded m-1" alt="" width="40" height="40">
            <div class="pb-3 mb-0 small lh-md w-100">
                <div class="d-flex justify-content-between">
                    <strong class="text-gray-dark ml-5">
                        <a href="show.php?post_id=" class="nounderline">
                            @<?php echo $row['member_username']; ?>
                        </a>
                    </strong>
                    <?php echo $row['created_at']; ?>
                </div>
                <span class="d-block small">
                    <a href="show.php?post_id=" class="nounderline">
                        <?php echo $row['message']; ?>
                    </a>
                </span>
            </div>
        </div>
        <?php
              }
        }
        ?>
    </div>

    <?php
        include 'comment.php';
    ?>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
</body>
</html>
