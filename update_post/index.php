<?php

if (empty($_GET["id"])) {
    header('Location: /create_post');
}

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utils/postsUtils.php';



$postId = $_GET["id"];
$post = getPostById($postId);

if (empty($post)) {
    header('Location: /create_post');
}





?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="update_post.css">
    <link rel="stylesheet" href="/global.css">

    <title>Uredi post</title>
</head>

<body>
    <div class="header-wrapper">
        <?php echo getHeader(); ?>
    </div>
    <div class="page-wrapper--narrow">
        <h1>Uredi post</h1>
        <form class="form" action="/actions/updatePost.php" method="post" enctype="multipart/form-data">
            <input name="postId" type="hidden" value="<?php echo $post["id"]; ?>" />
            <label>
                Naslov:
                <input value="<?php echo $post["title"]; ?>" type="text" name="title" id="title" required />
            </label>
            <label class="image-input">
                <img id="imagePreview" alt="image preview" src="<?php echo $post["featuredImg"]; ?>" />
                <input type="file" name="featuredImg" id="featuredImg" accept="image/*" onchange="document.getElementById('imagePreview').src = window.URL.createObjectURL(this.files[0])">
            </label>
            <label>
                Kratak opis:
                <textarea required style=" white-space: pre-wrap;" name="shortDesc" id="shortDesc"><?php echo $post["shortDesc"]; ?></textarea>
            </label>

            <label>
                Sadržaj (u MD formatu):
                <textarea required style="white-space: pre-wrap;" name="content" id="content"><?php echo $post["content"]; ?></textarea>
                </lavel>
                <button>Spremi</button>
        </form>
    </div>
</body>

</html>