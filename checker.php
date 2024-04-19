<?php
// Mockup valid credentials
$valid_email = "user@example.com";
$valid_password = "P@ssw0rd";

// Ambil data dari form
$email = $_POST['email'];
$password = $_POST['password'];

// Validasi email dan password
if ($email === $valid_email && $password === $valid_password) {
    // Simpan email ke cookie jika Remember Me di-check
    if (isset($_POST['remember']) && $_POST['remember'] == "on") {
        setcookie("remember_email", $email, time() + (86400 * 30), "/"); // Cookie berlaku selama 30 hari
    }
    echo "success";
} else {
    echo "failed";
}
