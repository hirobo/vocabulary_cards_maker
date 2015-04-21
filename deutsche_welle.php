<?php
// parse a html file
require_once 'lib/simple_html_dom.php';

define("LONGTEXT", 0);
define("VOCABULARY", 1);
define("QUESTION", 2);

class DeutscheWelle {
    private $url;
    private $title;
    private $intro;
    private $longtext = array();
    private $vocabulary = array();

    public function get_title(){
        return $this->title;
    }
    public function get_intro(){
        return $this->intro;
    }
    public function show_longtext(){
        $ret = "";
        foreach ($this->longtext as $val) {
            $ret .= $val.'<br /><br />';
        }
        return $ret;
    }
    public function show_vocabulary(){
        $ret = "";
        foreach ($this->vocabulary as $key => $value) {
            $ret .= '<b>'.$key.'</b>'.': '.$value.'<br /><br />';
        }
        return $ret;
    }
    public function get_vocabulary_csv(){
        $ret = "";
        foreach ($this->vocabulary as $key => $value) {
            $ret .= $key."\t".$value."\n";
        }
        return $ret;
    }
    function parse($url){
        $html = file_get_html($url);
        $this->title = $html->find('h1', 0)->plaintext;

        // get intro
        $this->intro = $html->find('p[class=intro]', 0)->innertext;
        // get Vokabeln
        $temp = explode('<br />',$html->find('div[class=longText]', 0)->innertext);
        $text = array_diff($temp, array(" ") ); // remove space
        $text = str_replace("\t", " ", $text); // replace Tab with space
        $type = LONGTEXT;
        foreach($text as $row){
            if(strstr($row,'<b>Glossar')||strstr($row,'<strong>Glossar')){
                $type = VOCABULARY;
                continue;
            }
            if(strstr($row,'<b>Fragen zum Text') || strstr($row,'<strong>Fragen zum Text') || strstr($row,'<b>Fragen') || strstr($row,'<strong>Fragen')){
                $type = QUESTION;
                break;
            }
            if($type == LONGTEXT){
                array_push($this->longtext, $row);
            }
            if($type == VOCABULARY){
                $pair = explode('–', $row);
                for($n = 0; $n < count($pair); $n++) {
                    $pair[$n] = str_replace('<b>', "", $pair[$n]);
                    $pair[$n] = str_replace('</b>', "", $pair[$n]);
                    $pair[$n] = str_replace('<strong>', "", $pair[$n]);
                    $pair[$n] = str_replace('</strong>', "", $pair[$n]);
                    $pair[$n] = trim($pair[$n]);
                    $pair[$n] = ltrim($pair[$n]);
                }
                $this->vocabulary += array($pair[0] => $pair[1]);
            }
        }
    }
}

?>
