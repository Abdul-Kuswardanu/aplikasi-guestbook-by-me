<?php
include 'function.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $message = $_POST['message'];
    if (updateGuest($id, $name, $message)) {
        header('Location: index.php');
        exit();
    }
}
?>