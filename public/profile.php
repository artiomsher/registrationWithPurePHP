<?php
require_once '../src/Service/User.php';
session_start();
if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'])) {
	header("Location: login.php");
}

?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Profile</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                    <div class="container">
                        <h6>Email: <?php echo $_SESSION['user']->getEmail(); ?> </h6>
                        <h6>Name: <?php echo $_SESSION['user']->getName(); ?> </h6>
                        <h6>Last name: <?php echo $_SESSION['user']->getLastName(); ?> </h6>
                        <h6>Phone: <?php echo $_SESSION['user']->getPhone(); ?> </h6>
                        <h6>Registration date: <?php echo $_SESSION['user']->getRegisteredAt(); ?> </h6>
                    </div>
                    <form id="logout-form" action="LogoutScript.php" method="POST">
                        <button type="submit" class="btn btn-danger" name="logout-user" value="Logout">Logout</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>