<?php
session_start();

// Mockup valid credentials
$valid_email = "Kelompok-11@gmail.com";
$valid_password = "K3p@mp@ng";

// Ambil data dari form
$email = $_POST['email'];
$password = $_POST['password'];

// Validasi email dan password
if ($email === $valid_email && $password === $valid_password) {
    // Simpan email ke cookie jika Remember Me di-check
    if (isset($_POST['remember']) && $_POST['remember'] == "on") {
        setcookie("remembered_email", $email, time() + (86400 * 1), "/"); // Cookie berlaku selama 24 jam
    }
    // Set session sebagai penanda bahwa user sudah login
    $_SESSION['loggedin'] = true;

    echo "success";
} else {
    echo "failed";
}
