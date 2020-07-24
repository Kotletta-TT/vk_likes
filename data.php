<?php
require __DIR__ . '/vendor/autoload.php';

//секретные ключи приложения
require 'init.php';

use \VK\OAuth\VKOAuth;
use \VK\OAuth\VKOAuthDisplay;
use \VK\OAuth\Scopes\VKOAuthUserScope;
use \VK\OAuth\VKOAuthResponseType;
use \VK\Client\VKApiClient;

//переменные и объекты для аутентификации в ВК

$oauth = new VKOAuth();
$display = VKOAuthDisplay::PAGE;
$scope = array(VKOAuthUserScope::WALL, VKOAuthUserScope::GROUPS,
    VKOAuthUserScope::AUDIO, VKOAuthUserScope::VIDEO,
    VKOAuthUserScope::PHOTOS, VKOAuthUserScope::FRIENDS, VKOAuthUserScope::NOTES);
$state = 'secret_state_code';
$revoke_auth = true;

$request_params = [
    'client_id' => $service_keys['client_id'],
    'client_secret' => $service_keys['client_secret'],
    'redirect_uri' => 'https://api.vk.com/blank.html',
    'display' => $display,
    'scope' => $scope,
    'response_type' => 'token',
    'revoke_auth' => $revoke_auth

];

//Объект для запросов к API
$vk = new VKApiClient();

$browser_url = $oauth->getAuthorizeUrl(VKOAuthResponseType::TOKEN, $request_params['client_id'],
    $request_params['redirect_uri'], $display, $scope, $state);

