<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Test</title>
</head>
<body>
<div id="main">
    <p>main block</p>
    <?php foreach ($items as $item): ?>
        <?=renderTemplate('templates/like.php', ['item' => $item]); ?>
    <?php endforeach; ?>
    <div class="clear"></div>
</div>
</body>
</html>