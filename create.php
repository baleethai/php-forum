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

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body class="bg-light">

<main class="container">

    <?php include 'partials/header.php'; ?>

    <?php
    if ($_COOKIE['logged'] != 1) {
         header( "location: ./login.php" );
         exit(0);
    }

    require 'partials/connect.php';
    $result = $conn->query("SELECT * FROM categories ORDER BY id DESC");
    if ($_POST) {
        $createdAt = Date('Y-m-d H:i:s');
        $memberId = $_COOKIE['member_id'];
        $content = $conn->real_escape_string($_POST['content']);
        $title = $conn->real_escape_string($_POST['title']);
        $sql = "INSERT INTO `posts` (`category_id`, `member_id`, `title`, `content`, `created_at`) VALUES ('{$_POST['category_id']}', '{$memberId}', '{$title}', '{$content}', '{$createdAt}')";
        if ($conn->query($sql) === TRUE) {
             header( "location: ./index.php" );
             exit(0);
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }

    ?>

    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="row">
            <h3>เพิ่มโพสต์ใหม่</h3>
            <div class="col-12">
                <form class="row g-3" action="./create.php" method="POST">
                    <div class="col-md-12">
                        <label for="username" class="form-label">หมวดหมู่</label>
                        <select name="category_id" class="form-control">
                            <?php
                            if ($result->num_rows > 0) {
                                  while($row = $result->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                            <?php
                                  }
                            }

                            ?>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="username" class="form-label">หัวข้อ</label>
                        <input type="text" name="title" class="form-control" id="username" required>
                    </div>
                    <div class="col-md-12">
                        <label for="username" class="form-label">รายละเอียด</label>
                        <textarea name="content" class="form-control" rows="5" id="content" required></textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary-watboard">เพิ่มโพสต์</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

  </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
</body>
</html>
