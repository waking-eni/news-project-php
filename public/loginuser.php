<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" 
    crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" 
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" 
    crossorigin="anonymous"></script>
    <title>Nowena Log In User</title>
    <link rel="stylesheet" href="../design/style.css">
</head>
<body>

    <!--Navigation bar-->
    <?php
        include 'header.php';
    ?>
    <!--end of navigation-->

    <!--wrapper-->
    <div class="container-fluid">
        <div class="row row-wrapper">

            <!--sidebar-->
            <?php
                include 'sidebar.php';
            ?>
            <!--end of sidebar-->

            <!--main-->
            <main class="col-9 main">

            <h1 class="text-center mt-5">Log In User</h1>
            <!-- Action points to a spesific page where we'll have only php code
            things will be checked there and, if everythings ok, user will be logged in-->
            <form class="center-div" action="../includes/loginuser.inc.php" method="post">
		        <input type="text" name="mailuid" placeholder="E-mail/Username">
                <input class="d-block my-3" type="password" name="pwd" placeholder="Password">
                <button class="d-block my-3 btn btn-dark float-right" type="submit" name="login-submit">Log In</button>
            </form>

            </main>
            <!--end of main-->
        </div>
    </div>
    <!--end f wrapper-->
    
</body>
</html>