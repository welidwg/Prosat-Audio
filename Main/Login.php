<?php
$current = "login";
include_once("./mainNav.php");
if (!isset($_SESSION["login"])) {


?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Prosat audio | Login</title>
    </head>

    <body>
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Log In</h2>
                    <p>
                        Private Space
                    </p>
                </div>
                <form method="post" id="login">
                    <div class="mb-3"><label class="form-label" for="email">Email/Username</label><input class="form-control item" type="text" name="auth" id="auth"></div>
                    <div class="mb-3"><label class="form-label" for="password">Password</label><input class="form-control" type="password" name="password" id="password"></div>
                    <div class="mb-3">
                    </div><button class="btn btn-primary " type="submit">Login </button>
                </form>
            </div>
        </section>
        <script>
            $(function() {
                let spinner = $('#spinn');
                $("#login").on("submit", (e) => {
                    e.preventDefault();
                    $.ajax({
                        type: "post",
                        url: "../Scripts/auth.php",
                        data: {
                            query: "login",
                            auth: $('#auth').val(),
                            password: $('#password').val()
                        },
                        beforeSend: function() {
                            spinner.css("display", "block");
                        },
                        success: function(res) {
                            res == 1 ? window.location.href = "./index.php" : alertify.error("Invalid Data")
                            spinner.css("display", "none");

                        },
                        error: (r) => {
                            alertify.error("Something went wrong !")
                            console.error(r.responseText);
                            spinner.css("display", "none");

                        }
                    });
                })
            });
        </script>
        <?php require_once("./footer.php"); ?>

    </body>

    </html>
<?php } else {
?>
    <script>
        window.location.href = "./index.php"
    </script>
<?php
} ?>