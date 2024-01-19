<?php
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php';

?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="create_post.css">
    <link rel="stylesheet" href="/global.css">
    <title>Kreirajte post</title>
</head>

<body>
    <div class="header-wrapper">
        <?php echo getHeader(); ?>
    </div>
    <div class="page-wrapper--narrow">
        <h1>Dodaj novi post</h1>
        <form class="form" action="/actions/createPost.php" method="post" enctype="multipart/form-data">
            <label>
                Naslov:
                <input type="text" name="title" id="title" required />
            </label>
            <label class="image-input">
                <img id="imagePreview" alt="image preview" src="/images/placeholder.jpg" />
                <input type="file" name="featuredImg" id="featuredImg" accept="image/*" onchange="document.getElementById('imagePreview').src = window.URL.createObjectURL(this.files[0])">
            </label>
            <label>
                Kratak opis:
                <textarea required style=" white-space: pre-wrap;" name="shortDesc" id="shortDesc"></textarea>
            </label>

            <label>
                Sadržaj (u MD formatu):
                <textarea required style="white-space: pre-wrap;" name="content" id="content"></textarea>
                </lavel>
                <button>Spremi</button>
        </form>
    </div>
</body>

</html>