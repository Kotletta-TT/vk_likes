<script type="text/javascript" language="Javascript">window.open('<?=$browser_url?>');</script>
<p><a href="<?=$browser_url?>">Войти через ВК</a></p>
<form action="auth.php">
    <p><input type="text" name="access_token"></p>
    <p><input type="submit"></p>
</form>
<p><?=print_r($_GET);?></p>