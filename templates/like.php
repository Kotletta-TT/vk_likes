<div class="like-card">
    <div class="like-content">
        <?php if ($item['type'] == 'photo'):?>
        <img src="<?=$item['content']?>" alt="test">
        <?php endif; ?>
        <?php if ($item['type'] == 'video'):?>
        <iframe src="<?=$item['content'];?>" width="200" height="133" frameborder="0" allowfullscreen></iframe>
        <?php endif; ?>
        <?php if ($item['type'] == 'post'):?>
        <p><?=$item['text']?></p>
        <?php endif; ?>
        <?php if ($item['type'] == 'podcast'):?>
            <p><?=$item['text']?></p>
        <?php endif; ?>
        <!-- содержимое будет менятся в зависимости от типа контента фото, видео, подкаст -->
    </div>
    <div class="like-ovner">
        <p><?=$item['owner_id']?></p>
        <!-- Owner лайкнутого контента -->
    </div>
    <div class="like-control">
        <a class="button-like-del" href="#">Удалить лайк</a>
        <!-- Управление лайком (галочка + кнопка убрать лайк) -->
    </div>
</div>