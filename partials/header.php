<div class="row">

    <div class="col-12 text-center">
        <?php if (isset($_COOKIE["logged"]) && $_COOKIE["logged"] == 1) { ?>
            <a href="./profile.php" class="nounderline">สวัสดี, <?php echo $_COOKIE['username']; ?></a> |
            <a href="./logout.php" class="nounderline">ออกจากระบบ</a>
        <?php } else { ?>
                <a href="./login.php" class="nounderline">เข้าสู่ระบบ</a> |
                <a href="./register.php" class="nounderline">สมัครสมาชิก</a>
        <?php } ?>
    </div>
</div>

<div class="d-flex align-items-center p-3 my-3 text-white bg-purple rounded shadow-sm">
    <a href="./index.php">
        <img class="me-3 rounded" src="./images/conversation.png" alt="" width="48" height="38">
    </a>
    <div class="lh-1">
        <h1 class="h6 mb-0 text-white lh-1">PHP Forum</h1>
        <small>Since 2021</small>
    </div>
</div>