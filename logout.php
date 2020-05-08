<?php
session_start();
if (isset($_SESSION['id'])) {
    unset($_SESSION['id']);
    unset($_SESSION['pseudo']);
    unset($_SESSION['mail']);
    session_destroy();
}
header("Location: .");
?>