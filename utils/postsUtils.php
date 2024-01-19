<?php
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

define("JSON_LOCATION", $_SERVER['DOCUMENT_ROOT'] . "/db.json");


function getAllPosts(string $query = ""): array
{
    $postsJSON = file_get_contents(JSON_LOCATION);
    $posts = json_decode($postsJSON, true);

    $posts =
        JmesPath\search(
            "posts[?title.contains(@, '" . $query .
                "') || content.contains(@, '" . $query . "')] | sort_by(@, &createdAt) | reverse(@)",
            $posts
        );
    return $posts;
}

function getLatestPosts(int $limit = 3): array
{
    $postsJSON = file_get_contents(JSON_LOCATION);
    $posts = json_decode($postsJSON, true);

    $posts =
        JmesPath\search(
            "posts | sort_by(@, &createdAt) | reverse(@)[:" . $limit . "]",
            $posts
        );
    return $posts;
}

function getPostById(string $postId): array
{
    $postsJSON = file_get_contents(JSON_LOCATION);
    $posts = json_decode($postsJSON, true);

    $post =
        JmesPath\search(
            "posts[?id == '" . $postId . "']",
            $posts
        );

    if (!empty($post)) {
        return $post[0];
    }

    return [];
}

function createPost(array $newPost): string
{
    $dbJSON = file_get_contents(JSON_LOCATION);
    $db = json_decode($dbJSON, true);
    $db["posts"][] = $newPost;
    $db = json_encode($db, JSON_PRETTY_PRINT);
    $createdSuccessfully = file_put_contents(JSON_LOCATION, $db);
    if ($createdSuccessfully) {
        return $newPost["id"];
    }

    return "";
}

function deletePost(string $postid)
{
    $dbJSON = file_get_contents(JSON_LOCATION);
    $db = json_decode($dbJSON, true);

    $postKey = array_search($postid, array_column($db["posts"], 'id'));

    if ($postKey === false) {
        return "";
    }

    unset($db["posts"][$postKey]);
    $db = json_encode($db, JSON_PRETTY_PRINT);
    $deletedSuccessfully = file_put_contents(JSON_LOCATION, $db);
    if ($deletedSuccessfully) {
        return $postid;
    }

    return "";
}

function updatePost(array $postData)
{
    $dbJSON = file_get_contents(JSON_LOCATION);
    $db = json_decode($dbJSON, true);

    $postKey = array_search($postData["id"], array_column($db["posts"], 'id'));

    if ($postKey === false) {
        return "";
    }

    $db["posts"][$postKey] = $postData;
    $db = json_encode($db, JSON_PRETTY_PRINT);
    $createdSuccessfully = file_put_contents(JSON_LOCATION, $db);
    if ($createdSuccessfully) {
        return $postData["id"];
    }

    return "";
}

function getPostCardHtml(array $postData): string
{
    $html = "<a class='post-card' href='/post?id=" . $postData["id"] . "'>";
    $html .= "<img class='post-card__image' src='" . $postData["featuredImg"] . "' />";
    $html .= "<p class='post-card__date'>" . date('d.m.Y.', $postData["createdAt"]) . "</p>";
    $html .= "<h3 class='post-card__title'>" . $postData["title"] . "</h3>";
    $html .= "<p class='post-card__desc'>" . $postData["shortDesc"] . "</p>";
    $html .= "</a>";
    return $html;
}
