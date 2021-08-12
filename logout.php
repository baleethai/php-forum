<?php
setcookie("username", "");
setcookie("logged", 0);
setcookie("member_id", "");
header( "location: ./index.php" );
exit(0);
?>