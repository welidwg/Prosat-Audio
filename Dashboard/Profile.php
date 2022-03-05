<?php
$current = "profile";
require_once("./nav.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Profile</title>
</head>

<body>
    <div class="container-fluid">
        <h3 class="text-dark mb-4">Profile</h3>
        <div class="row mb-3">
            <div class="col-lg-4">
                <div class="card mb-3">
                    <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4" src="../assets/img/avatars/<?php echo $_SESSION['avatar'] ?>" width="160" height="160">
                        <form id="changeAvatar" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="file" name="avatar" class="form-control" size="2" required>
                                <input type="hidden" name="id">
                                <br>
                            </div>
                            <div class="mb-3"><button class="btn btn-primary btn-sm" type="submit">Change Photo</button></div>

                        </form>
                        <script>
                            $("#changeAvatar").on("submit", (e) => {
                                e.preventDefault();
                                let form = $("#changeAvatar")[0];
                                let formData = new FormData(form);
                                $.ajax({
                                    type: "post",
                                    url: "../Scripts/auth?ChangeAvatar",
                                    data: formData,
                                    contentType: false,
                                    processData: false,
                                    success: function(res) {
                                        if (res == 1) {
                                            window.location.reload();
                                        } else {
                                            console.log(res);

                                        }
                                    }
                                });
                            });
                        </script>

                    </div>
                </div>

            </div>
            <div class="col-lg-8">

                <div class="row">
                    <div class="col">
                        <div class="card shadow mb-3">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 fw-bold">User Settings</p>
                            </div>
                            <div class="card-body">
                                <form id="editProf">
                                    <div class="">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="username"><strong>Username</strong></label><input class="form-control" type="text" id="username" value="<?php echo $_SESSION["username"] ?>" placeholder="new username" name="username"></div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="email"><strong>Email Address</strong></label><input class="form-control" type="email" id="email" value="<?php echo $_SESSION["email"] ?>" placeholder="user@example.com" name="email"></div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="first_name"><strong>Full Name</strong></label><input class="form-control" type="text" id="name" placeholder="new Name" value="<?php echo $_SESSION["name"] ?>" name="name"></div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="last_name"><strong>New Password</strong></label><input class="form-control" type="password" id="password" placeholder="new password" name="password"></div>
                                        </div>
                                    </div>
                                    <input type="hidden" value="<?= $_SESSION["id"] ?>" name="userId">
                                    <div class="mb-3"><button class="btn btn-primary btn-sm" type="submit">Save Settings</button></div>
                                </form>
                                <script>
                                    $(function() {
                                        $('#editProf').on("submit", (e) => {
                                            e.preventDefault();
                                            $.ajax({
                                                type: "post",
                                                url: "../Scripts/auth.php?editProfile",
                                                data: $('#editProf').serialize(),
                                                beforeSend: function() {

                                                },
                                                success: function(res) {
                                                    if (res == 1) {
                                                        alertify.success("Saved ! ");
                                                        setTimeout(() => {
                                                            window.location.reload();
                                                        }, 500);
                                                    } else if (res == 0) {
                                                        alertify.error("Username or email is already used ! ");

                                                    } else {
                                                        alertify.error("Something went wrong !");

                                                    }
                                                    console.log(res);
                                                },
                                                error: (r) => {
                                                    alertify.error("Something went wrong");
                                                    console.log(r.responseText);
                                                }
                                            });
                                        })
                                    });
                                </script>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>