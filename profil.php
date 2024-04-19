<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Logout user
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</head>

<body>
    <h2>Welcome to Your Profile</h2>
    <p>This is your profile page.</p>
    <a href="profil.php?logout=true">Logout</a>

    <!-- Kotak dialog untuk menampilkan pesan ! -->
    <div id="dialog" title="Message" style="display:none;">
        <p id="dialog-message"></p>
    </div>

    <script>
        $(document).ready(function() {
            // Fungsi untuk menampilkan kotak dialog dengan pesan
            function showDialog(message) {
                $("#dialog-message").text(message);
                $("#dialog").dialog();
            }

            // Contoh Penggunaan:
            // showdialog ("Ini adalah contoh pesan.");
        });
    </script>
</body>

</html>