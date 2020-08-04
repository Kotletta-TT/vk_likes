<?php

function checkAuth() {

};

function renderTemplate ($src_layout, $data) {
    ob_start();
    extract($data);
    require($src_layout);
    return ob_get_clean();
};

function getPhotos($vk) {
    //БЛОК ЗАПРОСА ЛАЙКНУТЫХ ФОТО
    $response_photos = $vk->fave()->getPhotos($_SESSION['access_token'], []);

    // Забираю сразу целый объект фото т.к. он полностью совпадает с attachments-фото к постам, необходимо для сравнения,
    // И отсеивания дубликатов.
    $parse_photos = array();
    foreach ($response_photos['items'] as $photo) {
        $parse_photos[] = [
            'id' => $photo['id'],
            'type' => 'photo',
            'date' => $photo['date'],
            'owner_id' => $photo['owner_id'],
            // 'photo_id' => $photo['id'],
            'text' => '',
            'content' => $photo['sizes']['1']['url']
        ];
    }
    return $parse_photos;
};

function getVideos ($vk) {
    // БЛОК ЗАПРОСА ЛАЙКНУТЫХ ВИДЕО
    // Принцип: получить все посты с лайками на видео, вторым запросом получить полную инфу по каждому видео.
    // Сначала получаем список лайкнутых видео.
    $response_videos = $vk->fave()->getVideos($_SESSION['access_token'], []);

    // забираем владельца видео и id - склеиваем их в строку
    $videos_api = array();
    foreach ($response_videos['items'] as $video) {
        $videos_api[] = $video['owner_id'] . '_' . $video['id'];
    }
    $videos_glue_str = implode(',', $videos_api);

    // склеенную строку передаем в запрос - так мы получим полную инфу, по всем лайкнутым видео.
    $video_collect = $vk->video()->get($_SESSION['access_token'], ['videos' => $videos_glue_str]);

    $parse_videos = array();
    foreach ($video_collect['items'] as $video) {
        $parse_videos[] = [
            'id' => $video['id'],
            'type' => $video['type'],
            'date' => $video['date'],
            'owner_id' => $video['owner_id'],
            'text' => $video['title'],
            'content' => $video['player']
        ];
    }

    return $parse_videos;
};

function getPosts ($vk) {
    //БЛОК ЗАПРОСА ЛАЙКНУТЫХ ПОСТОВ
    $response_posts = $vk->fave()->getPosts($_SESSION['access_token'], []);

    $parse_posts = array();
    //$parse_posts[] = ['count' => $response_posts['count']];
    foreach ($response_posts['items'] as $item) {
        if (!isset($item['attachments']['0']['type'])) {
            $post = [
                'id' => $item['id'],
                'type' => $item['post_type'],
                'date' => $item['date'],
                'owner_id' => $item['owner_id'],
                'text' => $item['text'],
                'content' => ''];
        };
        if ($item['attachments']['0']['type'] == 'photo') {
            //может быть больше прикрепленных элементов, пока расчет на 1
            $post = [
                'id' => $item['attachments']['0']['photo']['id'],
                'type' => $item['attachments']['0']['type'],
                'date' => $item['date'],
                'owner_id' => $item['attachments']['0']['photo']['owner_id'],
                'text' => $item['text'],
                // 'photo_id' => $item['attachments']['0']['photo']['id'],
                'content' => $item['attachments']['0']['photo']['sizes']['1']['url']];
        };
        if ($item['attachments']['0']['type'] == 'video') {
            $post = [
                'id' => $item['attachments']['0']['video']['id'],
                'type' => $item['attachments']['0']['type'],
                'date' => $item['date'],
                'owner_id' => $item['attachments']['0']['video']['owner_id'],
                'text' => $item['text'],
                'content' => ''
                ];
        };
        if($item['attachments']['0']['type'] == 'podcast') {
            $post = [
                'id' => $item['id'],
                'type' => $item['attachments']['0']['type'],
                'date' => $item['date'],
                'owner_id' => $item['attachments']['0']['podcast']['owner_id'],
                'text' => $item['attachments']['0']['podcast']['title'],
                'content' => 'podcast_content',
                ];
        };
        $parse_posts[] = $post;
    }
    return $parse_posts;
}

function unique_multidim_array($array, $key) {
    $temp_array = array();
    $i = 0;
    $key_array = array();

    foreach($array as $val) {
        if (!in_array($val[$key], $key_array)) {
            $key_array[$i] = $val[$key];
            $temp_array[$i] = $val;
        }
        $i++;
    }
    return $temp_array;
}