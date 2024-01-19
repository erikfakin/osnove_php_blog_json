<?php

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utils/postsUtils.php';
require $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php';


use League\CommonMark\GithubFlavoredMarkdownConverter;

$converter = new GithubFlavoredMarkdownConverter();


if (isset($_GET["id"])) {
    $post = getPostById($_GET["id"]);
    if (empty($post)) {
        header('Location: /post/404.php');
        die();
    }
} else {
    header('Location: /posts');
}


?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/global.css">
    <link rel="stylesheet" href="post.css">
    <title><?php echo $post["title"]; ?> | JSON Blog</title>
</head>

<body>
    <div class="header-wrapper">
        <?php echo getHeader(); ?>
    </div>
    <div class="page-wrapper--narrow post">

        <h1>
            <?php echo $post["title"]; ?>
        </h1>
        <a class="edit-wrapper" href="/update_post?id=<?php echo $post["id"]; ?>">
            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAMVJREFUSEvVlNEVgjAMRR+buIk6ipPIKG6im+gmajgpp5bQpEn7IT8cOHAveSSZMPiYBvPxF4LrN4UZwAvAmc9rMNEK7gBOWcwbSURQwpPnwZUs117BHjxJVq5HkOAUx0HowhuAy8ZkbNccTpAj/2AxntaISjhlTRU8mf6TfWsFLri1AjfcIgjBNUEYXhN0ge8JusElQVe4JHhz/9JWNPW5NqDlqkgCuq8OkQavVZC/K06oBW4RhODaHFg/svqcZ103iYcLPq33QxnDeB8ZAAAAAElFTkSuQmCC">
            Uredi
        </a>
        <form class="delete-form" action="/actions/deletePost.php" method="post">
            <input type="hidden" name="postId" value="<?php echo $post["id"]; ?>">
            <label class="delete-wrapper">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAMVJREFUSEvVlNEVgjAMRR+buIk6ipPIKG6im+gmajgpp5bQpEn7IT8cOHAveSSZMPiYBvPxF4LrN4UZwAvAmc9rMNEK7gBOWcwbSURQwpPnwZUs117BHjxJVq5HkOAUx0HowhuAy8ZkbNccTpAj/2AxntaISjhlTRU8mf6TfWsFLri1AjfcIgjBNUEYXhN0ge8JusElQVe4JHhz/9JWNPW5NqDlqkgCuq8OkQavVZC/K06oBW4RhODaHFg/svqcZ103iYcLPq33QxnDeB8ZAAAAAElFTkSuQmCC">
                Obriši
                <input id="deleteButton" type="submit" onclick="return confirm('Želiš li stvarno obrisati ovaj post?');">
            </label>
        </form>

        <img src="<?php echo $post["featuredImg"]; ?>" class="featured-image" />
        <p class='post-date'><?php echo date('d.m.Y.', $post["createdAt"]); ?></p>
        <div class="post-content">

            <?php echo $converter->convert($post["content"]); ?>
        </div>


    </div>

</body>

</html>