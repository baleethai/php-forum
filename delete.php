<?php

include 'partials/connect.php';

$postId = $_GET['post_id'];

$sql = "DELETE FROM `posts` WHERE ((`id` = '{$postId}'))";
if ($conn->query($sql) === TRUE) {
     header( "location: ./index.php" );
     exit(0);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header( "location: ./index.php" );
exit(0);
?>