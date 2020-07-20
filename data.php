<?php
require __DIR__ . '/vendor/autoload.php';

//секретные ключи приложения
require 'init.php';

use \VK\OAuth\VKOAuth;
use \VK\OAuth\VKOAuthDisplay;
use \VK\OAuth\Scopes\VKOAuthUserScope;
use \VK\OAuth\VKOAuthResponseType;

//переменные и объекты для аутентификации в ВК

$oauth = new VKOAuth();
$display = VKOAuthDisplay::PAGE;
$scope = array(VKOAuthUserScope::WALL, VKOAuthUserScope::GROUPS,
    VKOAuthUserScope::AUDIO, VKOAuthUserScope::VIDEO,
    VKOAuthUserScope::PHOTOS, VKOAuthUserScope::FRIENDS);
$state = 'secret_state_code';


$request_params = [
    'client_id' => $service_keys['client_id'],
    'client_secret' => $service_keys['client_secret'],
    'redirect_uri' => 'http://testproject/auth.php',
    'display' => $display,
    'scope' => $scope,
    'response_type' => 'token',
];


$browser_url = $oauth->getAuthorizeUrl(VKOAuthResponseType::CODE, $request_params['client_id'],
    $request_params['redirect_uri'], $display, $scope, $state);

