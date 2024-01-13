<?php

session_start();

$_SESSION = [];
session_unset();
session_destroy();

// menghapus cookie
setcookie('id', '', time() - 3600);
setcookie('key', '', time() - 3600);
// mundurkan 3600 (1jam) mengikuti dokumentasi php.net



header("Location: login.php");
exit;


?>