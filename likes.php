<?php
require_once 'data.php';
require_once 'function.php';
session_start();

if (!empty($_SESSION['access_token'])) {

    $video_collect = getVideos($vk);
    $posts_collect = getPosts($vk);
    $photo_collect = getPhotos($vk);
    // порядок передачи в merge важен!
    $all_in_heap = array_merge($video_collect, $photo_collect , $posts_collect);
    $test = unique_multidim_array($all_in_heap, 'id');
}



$page_content = renderTemplate('templates/likes.php', ['items' => $test]);

print($page_content);
?>
