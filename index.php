<?php
require_once 'rss.php';

function get_rss_list($items) {
    $num = 0;
    echo '<ul>';
    foreach ($items as $item) {
        echo '<li><a href="' . $item->link . '" class="draggable" id="item_' . $num . '">' . $item->title . '</a></li>';
        $num++;
    }
    echo '</ul>';
}

$rss = new Rss();
$feed_url = "http://rss.dw.de/xml/DKpodcast_topthemamitvokabeln_de";
$rss->load($feed_url);
?>
<?php require_once('header.php'); ?>
<div class="container">
    <div id="about" class="hero-unit">
        <h2>About this site...</h2>
        <p>
            Are you interested in learning German? 
            Do you want to improve your vocabulary?
        </p>
        <p>
            For example, <a href="http://ankisrs.net/">Anki</a> 
            is a great flash card service that helps to remember things easily. 
            And <a href="http://www.dw.de/">Deutsche Welle</a> 
            is a German news service that offers significant German language learning resources. 
        </p>
        <p>
            Here is a combination of them!!
            You can <b>create & download</b> vocabulary file in CSV format separated with TAB!
            You can choose an article from recently updated <b>Top-Thema mit Vokabeln</b>.
        </p>

    </div>

    <h3 id="rss-title"><?php echo $rss->get_title(); ?></h3>
    <div class="row">
        <div id ="rss-list" class="span6"><?php get_rss_list($rss->get_items()); ?></div>
            <div id ="drop-area" class="span6">
                <p id="drop-here-msg">Drag a link <br/>&<br/> Drop to here!</p>
            </div>
    </div>                    
</div>                
<script>
    $(function() {
        $('.draggable').draggable({
            helper: 'clone'
            
        });
        $('#drop-area').droppable({
            hoverClass: 'hover',
            accept: '.draggable',
            drop: function(event, ui) {
                var url = ui.draggable.attr('href');
                location.replace('article.php' + '?url=' + url);
            }
        });
    });
</script>
<?php require_once('footer.php') ?>
