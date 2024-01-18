<?php

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/utils/postsUtils.php';

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
    <div class="headerWrapper">
        <?php echo getHeader(); ?>
    </div>
    <div class="pageWrapper">
        <h1>Blog JSON</h1>
        <p>Blog koji koristi JSON datoteku kao database.</p>
        <div class="latestPosts">
            <h2>Najnoviji postovi</h2>
            <div class="latestPosts_posts">
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