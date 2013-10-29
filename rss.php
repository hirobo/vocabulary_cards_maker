<?php
/*******************************
 * Load Rss feed and parse
 *******************************/
class Rss{
    protected $site_title;
    protected $items = array();
    public function load($rss){
        $xml = simplexml_load_file($rss);
        $this->site_title = $xml->channel->title;
        $this->items = $xml->channel->item;
    }
    public function get_title(){
        return $this->site_title;
    }
    public function get_items(){
        return $this->items;
    }    
}