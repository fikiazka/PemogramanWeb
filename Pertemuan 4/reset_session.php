<?php

session_start();

$_SESSION = [];

session_destroy();

header('Location: debug_session.php');

exit;

?>

