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
    if ( $_COOKIE['logged'] != 1) {
         header( "location: ./error.php?error=กรุณาเข้าสู่ระบบ" );
         exit(0);
    }

    require 'partials/connect.php';
    if ($_POST) {
        if ($_FILES["icon"]) {

            $target_dir = "./uploads/";
            $target_file = $target_dir . basename($_FILES["icon"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["icon"]["tmp_name"]);
            if ($uploadOk == 0) {
                // echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["icon"]["tmp_name"], $target_file)) {
                    $filename = htmlspecialchars(basename($_FILES["icon"]["name"]));
                    $conn->query("UPDATE member SET icon = '{$filename}' WHERE username = '{$_COOKIE['username']}' ");
                }
            }
        }
    }


    $sql = $conn->query("SELECT * FROM member WHERE username = '{$_COOKIE['username']}' ");
    if ($sql->num_rows < 0) {
         header( "location: ./error.php?error=ไม่สามารถเรียกข้อมูลได้" );
         exit(0);
    }

    $profile = $sql->fetch_array();
    ?>

    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="row">
            <h3>แก้ไขโปรไฟล์</h3>
            <div class="col-12">
                <form class="row g-3" action="./profile.php" method="POST" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <label for="icon" class="form-label">ภาพประจำตัว</label>
                        <?php if ( !empty($profile['icon'])) { ?>
                            <p><img src="./uploads/<?php echo $profile['icon']; ?>" alt="" width="250"></p>
                        <?php } ?>
                        <input type="file" name="icon" class="form-control" id="icon">
                    </div>
                    <div class="col-md-12">
                        <label for="username" class="form-label">ชื่อผู้ใช้งาน</label>
                        <input type="text" name="username" class="form-control" id="username" value="<?php echo $profile['username']; ?>" disabled>
                    </div>
<!--                    <div class="col-md-12">-->
<!--                        <label for="password" class="form-label">รหัสผ่าน</label>-->
<!--                        <input type="password" name="password" class="form-control" id="username" required>-->
<!--                    </div>-->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary-watboard">แก้ไขข้อมูล</button>
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
