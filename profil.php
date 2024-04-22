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
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profile</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
  <link rel="stylesheet" href="style.css" />
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</head>

<body>

  <section class="body">
    <div class="container">
      <div class="card">

      </div>

      <div class="intro">
        <div class="upper"></div>
        <div class="image">
          <img src="./doc_images/image-victor.jpg" id="img">
        </div>
        <div class="intro-one">

          <span id="victor">Kelompok - 11</span>
          <p class="color">Universitas Brawijaya</p>

          <div class="activities">
            <div><span>128</span> <br> <span class="lower-name">Pengikut</span></div>
            <div><span>376K</span> <br> <span class="lower-name">Suka</span></div>
            <div><span>432</span> <br> <span class="lower-name">Foto</span></div>
          </div>
        </div>
        <div>
          <button type="button" class="btn btn-primary-custom" onclick="window.location.href='login.php'">LOG OUT</button>
        </div>

      </div>
  </section>

  <!-- Kotak dialog untuk menampilkan pesan ! -->
  <div id="dialog" title="Message" style="display: none">
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