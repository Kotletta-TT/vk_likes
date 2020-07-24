<?php
require_once 'data.php';
require_once 'function.php';

session_start();
if (!empty($_GET['access_token'])) {
    $_SESSION['access_token'] = $_GET['access_token'];
    if (!empty($_SESSION['access_token'])) {
        header('Location:/likes.php');
        exit;
    }
    else {
        $page_content = renderTemplate('templates/auth.php', ['browser_url' => $browser_url]);
        $layout_content = renderTemplate('templates/layout.php', ['title' => 'Авторизация',
            'content' => $page_content]);
        print $layout_content;
    }
}

else {
    $page_content = renderTemplate('templates/auth.php', ['browser_url' => $browser_url]);
    $layout_content = renderTemplate('templates/layout.php', ['title' => 'Авторизация',
        'content' => $page_content]);
    print $layout_content;
}
