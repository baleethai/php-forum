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
    if ($_POST) {
        require 'partials/connect.php';

        $sql = $conn->query("SELECT * FROM member WHERE username = '{$_POST['username']}' AND password = '{$_POST['password']}' ");
        if ($sql->num_rows == 0) {
             header( "location: ./error.php?error=ไม่สามารถเข้าสู่ระบบได้" );
             exit(0);
        }

        $member = $sql->fetch_array();

        setcookie("username", "{$_POST['username']}", time()+2*24*60*60);
        setcookie("member_id", $member['id'], time()+2*24*60*60);
        setcookie("logged", 1, time()+2*24*60*60);
        $conn->close();
        header( "location: ./index.php" );
        exit(0);
    }

    ?>

    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="row">
            <h3>เข้าสู่ระบบ</h3>
            <div class="col-4">
                <form class="row g-3" action="./login.php" method="POST">
                    <div class="col-md-12">
                        <label for="username" class="form-label">ชื่อผู้ใช้งาน</label>
                        <input type="text" name="username" class="form-control" id="username" required>
                    </div>
                    <div class="col-md-12">
                        <label for="password" class="form-label">รหัสผ่าน</label>
                        <input type="password" name="password" class="form-control" id="username" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary-watboard">สมัครสมาชิก</button>
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
