<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Jumbotron example · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/jumbotron/">



    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


</head>

<body>

    <main>
        <div class="container py-4">
            <div style="float:right">
                <a class="btn btn-danger " style="margin-right:10px" href="editprofile.php?username=<?php echo $_GET['username'] ?>">Edit Profile</a><a class="btn btn-primary" href="index.html">Logout</a>
            </div>
            <header class="pb-3 mb-4 border-bottom">
                <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                    <span class="fs-4">Welcome <?php echo strtoupper($_GET['username']) ?>!</span>
                </a>

            </header>

            <div class="p-1 mb-4 bg-light rounded-3">
                <div class="container-fluid py-1">
                    <table class="table">
                        <tr>
                            <th>First Name</th>
                            <td class="fname"></td>
                        </tr>
                        <tr>
                            <th>Last Name</th>
                            <td class="lname"></td>
                        </tr>
                        <tr>
                            <th>Age</th>
                            <td class="age"></td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td class="gender"></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td class="email"></td>
                        </tr>
                    </table>
                </div>

            </div>

        </div>
    </main>

</body>

</html>

<script type="text/javascript">
    $(document).ready(function(e) {


        user = $.parseJSON(window.localStorage.getItem('userDetails'));

        if (user == null) {
            window.location.href = 'index.html'
        }
        formData = new FormData();
        formData.append("username", "<?php echo $_GET['username'] ?>");
        formData.append("authToken", user['authToken']);


        $.ajax({
            url: 'validate_user.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                res = $.parseJSON(response);
                if (res.success == false) {
                    window.location.href = 'index.html'

                }
            },
            error: function(xhr, status, error) {
                alert('Your form was not sent successfully.');
                console.error(error);
            }
        });


        formData = new FormData();
        formData.append("username", "<?php echo $_GET['username'] ?>");


        $.ajax({
            url: 'fetch_profile.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                res = $.parseJSON(response);
                if (res.success) {
                    $('.fname').text(res.message['FirstName']);
                    $('.lname').text(res.message['LastName']);
                    $('.age').text(res.message['Age']);
                    $('.gender').text(res.message['Gender']);
                    $('.email').text(res.message['Email']);
                } else {
                    alert(res.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Your form was not sent successfully.');
                console.error(error);
            }
        });


    });
</script>