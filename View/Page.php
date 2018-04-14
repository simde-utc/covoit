<?php

class Page
{
    private $content = null;
    private $header = null;
    private $footer = null;
    
    private $head  = null;
    private $title = null;
    private $description = null;
    private $author  = null;

    public function __construct($title="", $author="", $desc="") {
        $this->setTitle($title);
        $this->setDescription($desc);
        $this->setAuthor($author);
        $this->content = "";
        $this->header = "";
        $this->footer = "";
    }
    
    /*
     * Functions static
     */
    
    public static function encode($txt){
        //return htmlentities($txt, ENT_QUOTES|ENT_HTML5, "utf-8");
        return $txt;
    }
    
    /*
     * Setters
     */
    
    public function setHead($txt) {
        $this->title = self::encode($txt);
    }   
    
    public function setTitle($txt) {
        $this->title = self::encode($txt);
    }

    public function setDescription($txt) {
        $this->description = self::encode($txt);
    }
    
    public function setAuthor($txt) {
        $this->author = self::encode($txt);
    }

    /*
     * Appenders
     */    
    
    public function appendToHead($txt) {
        $this->head .= self::encode($txt)."\n";
    }

    public function appendCss($txt){
        $this->appendToHead("<style type='text/css'>".self::encode($txt)."</style>");
    }

    public function appendCssUrl($txt) {
        $this->appendToHead("<link rel='stylesheet' type='text/css' href='".self::encode($txt)."'>");
    }

    public function appendJs($txt) {
        $this->appendToHead("<script type='text/javascript'>".self::encode($txt)."</script>");
    }

    public function appendJsUrl($txt) {
        $this->appendToHead("<script type='text/javascript' src='".self::encode($txt)."'></script>");
    }

    public function appendContent($txt){
        $this->content .= self::encode($txt);
    }
    
    public function appendHeader($txt) {
        $this->header .= self::encode($txt);
    }
    
    public function appendFooter($txt) {
        $this->footer .= self::encode($txt);
    }
    
    /*
     * Others
     */
    
    public function toHTML() {
        if(is_null($this->title) || is_null($this->description) || is_null($this->author)) {
            throw new Exception(__CLASS__ . ": informations not set") ;
        }
        return <<<HTML
<!doctype html>
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="description" content="{$this->description}">
        <meta name="author" content="{$this->author}">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
        <title>{$this->title}</title>
        {$this->head}
    </head>
    <body>
        <div id='header'>
            {$this->header}
        </div>
        <div id='content'>
            {$this->content}                
        </div>
        <div id='footer'>
            {$this->footer}
        </div>
    </body>
</html>
HTML;
    }
    
    public function display() {
        echo $this->toHTML();
    }

}