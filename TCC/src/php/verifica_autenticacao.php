<?php

if (!isset($_SESSION['id_usuario']) || !isset($_SESSION['email'])) {
    echo "<script>alert('Necessário fazer o login.'); window.location.href = 'http://localhost/tcc/index.php';</script>";
    exit();
}
?>
