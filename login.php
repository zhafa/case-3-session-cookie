<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#login-form").submit(function(e) {
                e.preventDefault();
                var email = $("#email").val();
                var password = $("#password").val();

                // Validasi email di sisi client
                if (!validateEmail(email)) {
                    showDialog("Email tidak valid");
                    return;
                }

                // Validasi password di sisi client
                if (!validatePassword(password)) {
                    showDialog("Password tidak valid");
                    return;
                }

                // Kirim data ke server menggunakan AJAX
                $.ajax({
                    type: "POST",
                    url: "login_check.php",
                    data: {
                        email: email,
                        password: password
                    },
                    success: function(response) {
                        if (response === "success") {
                            window.location.href = "profile.php";
                        } else {
                            showDialog("Email atau password salah");
                        }
                    }
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
                $("#dialog").text(message);
                $("#dialog-modal").dialog();
            }
        });
    </script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <h2>Login</h2>
    <form id="login-form">
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br>
        <input type="submit" value="Login">
    </form>
    <div id="dialog-modal" title="Error" style="display:none;">
        <p id="dialog"></p>
    </div>
</body>

</html>