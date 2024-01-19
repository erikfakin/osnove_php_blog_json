<?php
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utils/postsUtils.php';

$query = "";
if (!empty($_GET["search"])) {
    $query = $_GET["search"];
}

$posts = getAllPosts($query);
?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/global.css">
    <link rel="stylesheet" href="posts.css">
    <title>Postovi</title>
</head>

<body>
    <div class="header-wrapper">
        <?php echo getHeader(); ?>
    </div>
    <div class="page-wrapper">
        <h1><?php
            if (!empty($query)) {
                echo "Svi rezultati za upit: " . $query;
            } else {
                echo "Svi postovi";
            }
            ?></h1>
        <p>Poredani po datumu kreiranja.</p>
        <div class="posts-wrapper">
            <?php
            if (!empty($posts) || $query != "") {
                foreach ($posts as $post) {
                    echo getPostCardHtml($post);
                }
            } else {
                echo "<a class='cta' href='/create_post'>Trenutno nemate postova za prikaz. Kreiraj svoj prvi post -></a>";
            }
            ?>

        </div>
    </div>
</body>

</html>