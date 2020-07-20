<?php

function checkAuth() {

};

function renderTemplate ($src_layout, $data) {
    ob_start();
    extract($data);
    require($src_layout);
    return ob_get_clean();
};