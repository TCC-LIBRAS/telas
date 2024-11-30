<?php
session_start();
session_destroy();
header('Location: http://localhost/tcc/index.php'); // Redireciona para o login após logout
exit();
?>
