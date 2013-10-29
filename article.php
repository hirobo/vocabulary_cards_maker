<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once 'deutsche_welle.php';
$url = isset($_GET['url']) ? $_GET['url'] : '';

$dw = new DeutscheWelle();
$dw->parse($url);
$_SESSION['title'] = $dw->get_title();
$_SESSION['data'] = $dw->get_vocabulary_csv();
?>
<?php require_once('header.php') ?>
<div class="container">
    <div id ="article-intro">
        <h2><?php echo $dw->get_title(); ?></h2>
        <div class="lead"><?php echo $dw->get_intro(); ?></div>
    </div>
    <form class="text-center" method="post" action="download.php">
        <button class="btn btn-primary" type="submit" name="download">Download Vocabulary List!!</button>
    </form>        
    <div class="row">
        <div class="span6">
            <h3>Article</h3>
            <div><?php echo $dw->show_longtext(); ?></div>
        </div>
        <div class="span6">
            <h3>Vocabulary</h3>
            <?php echo $dw->show_vocabulary(); ?>
        </div>
    </div>
</div>
<?php require_once('footer.php') ?>
