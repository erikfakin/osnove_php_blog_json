<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo "Method not supported.";
    http_response_code(405);
    die();
}

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utils/postsUtils.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utils/uploadUtils.php';


// Checks if ww have the required data to make the new post
if (!empty($_POST["content"]) && !empty($_POST["title"]) && !empty($_POST["shortDesc"]) && !empty($_POST["postId"])) {
    $postTitle = $_POST["title"];
    $postContent = $_POST["content"];
    $postShortDesc = $_POST["shortDesc"];
    $postId = $_POST["postId"];
} else {
    echo "Missing required data to create a post.";
    http_response_code(400);
    die();
}

// Checks if we have the image for the new post
if (!empty($_FILES["featuredImg"]["tmp_name"])) {
    $imagePath = uploadImage($_FILES["featuredImg"]);
}

// Checks if we successfully uploaded the image
if (!empty($_FILES["featuredImg"]["tmp_name"]) && empty($imagePath)) {
    echo "We had a problem uploading the image.";
    http_response_code(500);
    die();
}
// Gets the original post and updates its values with the new ones.
$post = getPostById($postId);
$post["title"] = $postTitle;
$post["shortDesc"] = $postShortDesc;
$post["content"] = $postContent;

if (!empty($imagePath)) {
    $post["featuredImg"] = $imagePath;
}

$updatedId = updatePost($post);


?>
<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/global.css">
    <title>Novi post</title>
</head>

<body>
    <div class="header-wrapper">
        <?php echo getHeader(); ?>
    </div>
    <div class="page-wrapper">
        <h1>
            Uspješno ste uredili post.
        </h1>
        <a href="/post?id=<?php echo $post["id"]; ?>">
            Pogledajte uređeni post na ovom linku.
        </a>
    </div>

</body>

</html>