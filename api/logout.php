<?php
ob_start();

// Hapus cookie auth_token
setcookie('auth_token', '', time() - 3600, '/');

header("Location: ../index.html");
exit();
?>