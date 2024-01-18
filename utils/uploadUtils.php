<?php

function uploadImage(array $imageData): string
{
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/images/";

    $fileName = md5_file($imageData["tmp_name"]);
    $imageFileType = strtolower(pathinfo($imageData["name"], PATHINFO_EXTENSION));

    $targetFile = $uploadDir . $fileName . "." . $imageFileType;

    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/images/')) {
        mkdir($_SERVER['DOCUMENT_ROOT'] . '/images/');
    }
    // If upload was successfull or image already exists, return the path of the uploaded image
    if (move_uploaded_file($imageData["tmp_name"], $targetFile) || file_exists($targetFile)) {
        return "/images/" . $fileName . "." . $imageFileType;
    }
    // If the upload was not successfull, return an empty string
    return "";
}
