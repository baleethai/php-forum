<?php

if ($_POST) {

    $postId = $_POST['post_id'];

    require 'partials/connect.php';
    $createdAt = Date('Y-m-d H:i:s');
    $sql = "INSERT INTO `comments` (`member_id`, `post_id`, `message`, `created_at`) VALUES ('{$_COOKIE['member_id']}', '{$postId}', '{$_POST['message']}', '{$createdAt}')";
    if ($conn->query($sql) === TRUE) {
         header( "location: ./show.php?post_id=" . $postId);
         exit(0);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

?>

<div class="bg-body text-muted">
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="row">
            <h3>แสดงความคิดเห็น</h3>
            <?php if (isset($_COOKIE['logged']) && $_COOKIE['logged'] == 1) {?>
            <div class="col-12">
                <form class="row g-3" action="./comment.php" method="POST">
                    <div class="col-md-12">
                        <label for="message" class="form-label">ข้อความ</label>
                        <textarea name="message" id="message" class="form-control" required></textarea>
                    </div>
                    <div class="col-12">
                        <input type="hidden" name="post_id" value="<?php echo $_GET['post_id'];?>">
                        <button type="submit" class="btn btn-primary-watboard">ตอบคอมเม้น</button>
                    </div>
                </form>
            </div>
            <?php } else { ?>
            <div class="col-12">
                <p>
                    กรุณาเข้าสู่ระบบ
                    <a href="./login.php">คลิ๊ก</a>
                </p>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
