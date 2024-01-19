<?php
header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");

require $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php';


?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/global.css">
    <title>404 - Post not found</title>
</head>

<body>
    <div class="header-wrapper">
        <?php echo getHeader(); ?>
    </div>
    <div class="page-wrapper">
        <h1>Nismo mogli pronaći traženi post.</h1>
        <a href="/posts">
            Pogledajte sve postove.
        </a>
    </div>
</body>

</html>