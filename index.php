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

    $sql = "SELECT * FROM categories ORDER BY id DESC";
    $result = $conn->query($sql);
    ?>

    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h6 class="border-bottom pb-2 mb-0">
            หมวดหมู่
            <a href="./create.php" class="nounderline" style="float: right;"><i class="bi bi-file-earmark-plus"></i> โพสต์ใหม่</a>
        </h6>

        <?php
        if ($result->num_rows > 0) {
                $no = 1;
              while($row = $result->fetch_assoc()) {
        ?>

            <div class="d-flex text-muted pt-3">
                <img src="./uploads/<?php echo $row['icon']; ?>" class="rounded m-1" alt="" width="32" height="32">
                <div class="pb-3 mb-0 small lh-md border-bottom-dashed w-100">
                    <div class="d-flex justify-content-between">
                        <strong class="text-gray-dark">
                            <a href="post.php?category_id=<?php echo $row['id'];?>" class="nounderline">
                                <?php echo $row['name']; ?>
                            </a>
                        </strong>
                        <i class="icon icon-home"></i>
                        <?php
                            $queryCountPosts = $conn->query("SELECT id FROM posts where category_id ='" . $row['id']. "' ");
                            echo $queryCountPosts->num_rows;
                            $queryCountPosts->free_result();
                        ?>
                        โพสต์
                    </div>
                    <span class="d-block small">
                        <a href="post.php?category_id=<?php echo $row['id'];?>" class="nounderline">
                            <?php echo $row['description']; ?>
                        </a>
                    </span>
                </div>
            </div>
        <?php
                  $no++;
              }
        }

        ?>

  </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
</body>
</html>
