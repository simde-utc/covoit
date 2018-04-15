<?php

require_once("App/Route.php");
use App\Route;

class Page
{
    protected $content = null;
    protected $header = null;
    protected $footer = null;
    protected $modals = null;

    protected $head  = null;
    protected $title = null;
    protected $description = null;
    protected $author = null;
    protected $script = null;

    public function __construct($title="", $author="", $desc="") {
        $this->setTitle($title);
        $this->setDescription($desc);
        $this->setAuthor($author);
        $this->content = "";
        $this->header = "";
        $this->footer = "";
        $this->script = "";
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

    public function appendToScript($txt) {
        $this->script .= self::encode($txt)."\n";
    }

    public function appendCss($txt){
        $this->appendToHead("<style type='text/css'>".self::encode($txt)."</style>");
    }

    public function appendCssUrl($txt) {
        $this->appendToHead("<link rel='stylesheet' type='text/css' href='".Route::getUrl(self::encode($txt))."'>");
    }

    public function appendJs($txt) {
        $this->appendToScript("<script type='text/javascript'>".self::encode($txt)."</script>");
    }

    public function appendJsUrl($txt) {
        $this->appendToHead("<script type='text/javascript' src='".self::encode($txt)."'></script>");
    }

    public function generateContent(){
        $this->content = <<<HTML
        <p>mon_content</p>
HTML
;
    }

    public function generateHeader(){
        $this->header = <<<HTML
        <!-- Static navbar -->
          <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">TutUT</a>
              </div>
              <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                  <li id='buttonInfoModal' data-toggle="modal" data-target="#infoModal" ><div class="navbar-brand navbar-brand-centered"><span class="glyphicon glyphicon-info-sign" id="logIcon"></span></div></li>
                </ul>
              </div><!--/.nav-collapse -->
            </div><!--/.container-fluid -->
          </nav>
HTML
;
    }

    public function generateFooter(){
        $this->footer = <<<HTML
        <footer class="container-fluid text-center">
            <p>mon_footer</p>
        </footer>
HTML
;
    }

    public function generateModals(){
        $this->modals = <<<HTML
        <div id="infoModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Informations</h4>
              </div>
              <div class="modal-body">
                <p>Lorem ipsum...</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
              </div>
            </div>
          </div>
        </div>
HTML
;
    }

    /*
     * Others
     */
    
    public function toJSON(){
        header('Content-Type: application/json');
        echo json_encode($this, TRUE);
    }
    
    public function toHTML() {
        if(is_null($this->title) || is_null($this->description) || is_null($this->author)) {
            throw new Exception(__CLASS__ . ": informations not set") ;
        }
        $this->generateContent();
        $this->generateHeader();
        $this->generateFooter();
        $this->generateModals();
        return <<<HTML
<!doctype html>
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="description" content="{$this->description}">
        <meta name="author" content="{$this->author}">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
        <title>{$this->title}</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <script src="http://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E=" crossorigin="anonymous"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <title>{$this->title}</title>
        {$this->head}
    </head>
    <body>
        <div id='header'>
            {$this->header}
        </div>
        <div style="padding-top:50px;" id='content'>
            {$this->content}
        </div>
        <div id='footer'>
            {$this->footer}
        </div>
        <div id='modals'>
            {$this->modals}
        </div>
    </body>
    {$this->script}
</html>
HTML;
    }

    public function display() {
        echo $this->toHTML();
    }

}
