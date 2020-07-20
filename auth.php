<?php
require_once 'data.php';
require_once 'function.php';

session_start();
if (!empty($_GET['code'])) {
    $code = $_GET['code'];
    $response = $oauth->getAccessToken($request_params['client_id'],$request_params['client_secret'],
        $request_params['redirect_uri'], $code);
    $access_token = $response['access_token'];
    $_SESSION['access_token'] = $access_token;
    if (!empty($response['access_token'])) {
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
