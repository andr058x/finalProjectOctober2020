<?php
session_start();

if (!isset($_SESSION['auth_login']) && $_SESSION['auth_login'] !== true) {
    header("Location: /");
    exit;
}

require __DIR__ . '/Database.php';
$database = new Database;

$payload = json_decode($_SESSION['payload'], true);
$name = $payload['name'];
$email = $payload['email'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Social Auth</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="section-wrapper mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12 my-5">
                    <div class="text-center">
                        <h3 class="my-2">Account Type: <?= ucfirst($database->fetchRole($payload['Role_IDrole'])) ?></h3>
                        <h3 class="my-2">Organization: <?= $database->fetchOrgnization($payload['Organization']) ?></h3>
                    </div>

                    <div class="card mt-5">
                        <div class="card-header">
                            <h4 class="m-0">Hi, <?= $name ?>!</h4>
                            <br/>
                            <h6 class>Login Email: <?= $email ?></h6>
                            <a href="/logout.php" class="btn btn-logout">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if ((int) $payload['Role_IDrole'] === 1) {
                include_once __DIR__ . '/dir/patient.php';
            } else {
                include_once __DIR__ . '/dir/physician.php';
            } ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <?php
    if ( (int) $payload['Role_IDrole'] === 3 || (int) $payload['Role_IDrole'] === 4 ) {
    ?>
    <script src="/js/map.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTuMC3S9RFYgNb8QCFf3gekHqOaDPfKBY&callback=initMap&libraries=&v=weekly" defer></script>
    <?php
    } ?>
</body>
</html>