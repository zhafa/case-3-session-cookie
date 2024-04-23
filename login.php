<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link
      rel="stylesheet"
      href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"
    />
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <style>
  /* Menambahkan gambar background pada body */
  body {
    background-image: url(https://mediaim.expedia.com/destination/1/61ed87d37428de62f4bb2afc7bf42e01.jpg); /* Ubah dengan path yang benar dari gambar background */
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
  }

  /* Mengatur style untuk form login */
  .col-md-12 {
    background-color: rgba(255, 255, 255, 0.5); /* Membuat background form sedikit transparan */
    text-align: center;
    position: relative;
    padding: 5% 25%;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    border-radius: 10px; /* Membuat tepi form membulat */
    color: #353839; /* Mengatur warna teks menjadi putih */
    margin-top: 10%; /* Menambah jarak dari atas */
  }

  h2 {
    color: #000000 ; /* Mengatur warna judul form menjadi putih */
    margin-bottom: 30px;
  }

  /* Mengatur style untuk input dan label */
  input[type="text"],
  input[type="password"],
  input[type="submit"] {
    width: 80%;
    padding: 10px;
    margin: 10px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px; /* Membuat tepi input membulat */
  }

  label {
    color: #353839; /* Mengatur warna label menjadi putih */
  }

  /* Mengatur style untuk tombol Login */
  input[type="submit"] {
    background-color: #4CAF50; /* Warna background tombol */
    color: white;
    border: none;
    cursor: pointer;
  }

  input[type="submit"]:hover {
    background-color: #45a049; /* Warna tombol saat di-hover */
  }

  /* Mengatur style untuk tautan "Remember Me" dan "Forgot Password" */
  a, input[type="checkbox"] + label {
    color: #000000; /* Warna teks tautan */
    font-size: 0.9em;
  }

  a:hover {
    text-decoration: underline;
  }
</style>

  </head>

  <body>
    <div class="col-md-12">
      <div class="col-md-12">
        <h2>Login</h2>
        <form id="login-form">
          <label for="email">Email:</label><br />
          <input type="text" id="email" name="email" /><br />
          <label for="password">Password:</label><br />
          <input type="password" id="password" name="password" /><br />
          <input type="checkbox" id="remember" name="remember" />
          <label for="remember">Remember Me</label><br />
          <input type="submit" value="Login" />
        </form>

        <!-- Dialog box for displaying error message -->
        <div id="dialog" title="Error" style="display: none">
          <p id="dialog-message"></p>
        </div>
      </div>
    </div>
    <script>
      $(document).ready(function () {
        // Load remembered email from cookie
        var rememberedEmail = getCookie("remembered_email");
        if (rememberedEmail !== "") {
          $("#email").val(rememberedEmail);
        }

        $("#login-form").submit(function (e) {
          e.preventDefault();
          var email = $("#email").val();
          var password = $("#password").val();
          var remember = $("#remember").is(":checked");

          // Validate email and password on client side
          if (!validateEmail(email)) {
            showDialog("Email tidak valid");
            return;
          }

          if (!validatePassword(password)) {
            showDialog("Password tidak valid");
            return;
          }

          // Send data to server using AJAX
          $.ajax({
            type: "POST",
            url: "checker.php",
            data: {
              email: email,
              password: password,
              remember: remember,
            },
            success: function (response) {
              if (response === "success") {
                if (remember) {
                  setCookie("remembered_email", email, 24); // Cookie berlaku selama 24 jam
                }
                // Redirect ke halaman profil jika login berhasil
                window.location.href = "profil.php";
              } else {
                // Tampilkan pesan kesalahan jika login gagal
                showDialog("Email atau password salah");
              }
            },
          });
        });

        function validateEmail(email) {
          var re = /\S+@\S+\.\S+/;
          return re.test(email);
        }

        function validatePassword(password) {
          var re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{8,}$/;
          return re.test(password);
        }

        function showDialog(message) {
          $("#dialog-message").text(message);
          $("#dialog").dialog();
        }

        // Function to set cookie
        function setCookie(cname, cvalue, exhours) {
          var d = new Date();
          d.setTime(d.getTime() + exhours * 60 * 60 * 1000); // Mengubah ke jam
          var expires = "expires=" + d.toUTCString();
          document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }

        // Function to get cookie
        function getCookie(cname) {
          var name = cname + "=";
          var decodedCookie = decodeURIComponent(document.cookie);
          var ca = decodedCookie.split(";");
          for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) === " ") {
              c = c.substring(1);
            }
            if (c.indexOf(name) === 0) {
              return c.substring(name.length, c.length);
            }
          }
          return "";
        }
      });
    </script>
  </body>
</html>
