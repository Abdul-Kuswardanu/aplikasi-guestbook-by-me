<?php
include 'function.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $message = $_POST['message'];
    if (addGuest($name, $message)) {
        header('Location: index.php');
        exit();
    }
}
?>