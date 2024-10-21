<?php
include 'function.php';

if (isset($_GET['id'])) {
    deleteGuest($_GET['id']);
    header('Location: index.php');
    exit();
}
?>