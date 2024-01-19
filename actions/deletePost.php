<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo "Method not supported.";
    http_response_code(405);
    die();
}

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utils/postsUtils.php';

// Checks if ww have the required data to make the new post
if (!empty($_POST["postId"])) {
    $postId = $_POST["postId"];
} else {
    echo "Missing required data to delete a post.";
    http_response_code(400);
    die();
}

$deletedId = deletePost($postId);
?>


<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/global.css">
    <title>Obrisali ste post</title>
</head>

<body>
    <div class="header-wrapper">
        <?php echo getHeader(); ?>
    </div>
    <div class="page-wrapper">
        <h1>
            <?php if ($deletedId !== "") {
                echo "Uspješno ste obrisali post.";
            } else {
                echo "Neuspješno ste obrisali post.";
            } ?>
        </h1>
        <a href="/posts">
            Pogledajte sve postove.
        </a>
    </div>

</body>

</html>