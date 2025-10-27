<?php
session_start();

$_SESSION = [];

session_unset();
session_destroy();
header("index.php?controller=loginp&action=index");
exit();
?>
