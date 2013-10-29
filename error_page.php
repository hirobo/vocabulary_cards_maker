<?php require_once('header.php') ?>
<div class="container">
    <p>Error: Failed to download.</p>
    <div>This page will be redirected to the<a href=<?php echo INDEX_PHP; ?>> Top page</a> in 10 seconds...</div>
    <meta http-equiv="Refresh" content= "10; <?php echo INDEX_PHP; ?>">            
</div>
<?php require_once('footer.php') ?>