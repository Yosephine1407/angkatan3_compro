<?php
include '../admin/koneksi.php';

if (isset($_POST['send-bro'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $select = mysqli_query($koneksi, "SELECT email FROM contact WHERE email = '$email'");



    // kita handle error email yang unique
    if (mysqli_num_rows($select) > 0) {
        header("Location:../contact.php?status=email-available");
        exit();
    } else {
        $insert = mysqli_query($koneksi, "INSERT INTO contact (nama, email, subject, message) VALUES ('$name', '$email','$subject', '$message')");
        header("Location: ../contact.php?status=sukses");
        exit();
    }
}
