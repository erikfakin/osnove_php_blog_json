<?php

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utils/postsUtils.php';

?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="homepage.css">
    <title>PHP osnove - Blog JSON</title>
</head>

<body>
    <div class="header-wrapper">
        <?php echo getHeader(); ?>
    </div>
    <div class="page-wrapper">
        <h1>Blog JSON</h1>
        <p>Blog koji koristi JSON datoteku kao database.</p>
        <div class="latest-posts">
            <h2>Najnoviji postovi</h2>
            <div class="latest-posts__posts">
                <?php
                $posts = getLatestPosts(4);

                if (!empty($posts)) {
                    foreach ($posts as $post) {
                        echo getPostCardHtml($post);
                    }
                } else {
                    echo "<a class='cta' href='/create_post'>Trenutno nemate postova za prikaz. Kreiraj svoj prvi post -></a>";
                }
                ?>
            </div>

        </div>
    </div>
</body>

</html>