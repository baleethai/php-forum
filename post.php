<!doctype html>
<html lang="en">
<head>
    <?php include 'partials/head.php'; ?>
</head>
<body class="bg-light">

<main class="container">

    <?php include 'partials/header.php'; ?>

    <?php
    include 'partials/connect.php';

    $queryCategory = $conn->query("SELECT * FROM categories where id ='" . $_GET['category_id']. "' ");
    $category = $queryCategory->fetch_row();

    $posts = $conn->query("SELECT posts.id,posts.title,posts.content,member.icon FROM posts INNER JOIN member ON member.id = posts.member_id where posts.category_id ='" . $_GET['category_id']. "' ");
    // var_dump($posts->fetch_assoc());

    ?>

    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h6 class="border-bottom pb-2 mb-0">หมวดหมู่ : <?php echo $category[2]; ?></h6>
        <?php
        if ($posts->num_rows > 0) {
                $no = 1;
              while($row = $posts->fetch_assoc()) {
        ?>

            <div class="d-flex text-muted pt-3">

                <img src="./uploads/<?php echo $row['icon'];?>" class="rounded m-1" alt="" width="40" height="40">
                <div class="pb-3 mb-0 small lh-md border-bottom-dashed w-100">
                    <div class="d-flex justify-content-between">
                        <strong class="text-gray-dark mt-1">
                            <a href="show.php?post_id=<?php echo $row['id'];?>" class="nounderline">
                                <?php echo $row['title']; ?>
                            </a>
                        </strong>
                        <a href="delete.php?post_id=<?php echo $row['id'];?>" class="nounderline"><i class="bi bi-trash"></i> ลบ</a>
                    </div>
                    <span class="d-block small">
                        <a href="show.php?post_id=<?php echo $row['id'];?>" class="nounderline">
                            <?php echo mb_substr($row['content'], 0, 120) ?>
                        </a>
                    </span>
                </div>
            </div>
        <?php
                  $no++;
              }
        } else {


        ?>
            <div class="d-flex text-muted pt-3">
                <div class="pb-3 mb-0 small lh-md border-bottom-dashed w-100">
                    <div class="d-flex">
                        ไม่มีโพสต์ <a href="./index.php" class="nounderline" style="margin-left: 5px;">กลับ</a>
                    </div>
                </div>
            </div>
        <?php

        }

        ?>



  </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
</body>
</html>
