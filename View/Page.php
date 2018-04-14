<?php

/**
 * Created by PhpStorm.
 * User: yanis
 * Date: 14/04/2018
 * Time: 17:19
 */
class Page
{
    private $head  = null ;
    private $title = null ;
    private $desc = null ;
    private $body  = null ;
    private $author  = null ;

    /**
     * Constructeur
     * @param string $title Titre de la page
     */
    public function __construct($title="", $author="", $desc="") {
        $this->setTitle($title) ;
        $this->setDesc($desc);
        $this->setAuthor($author);
    }

    /* Tool functions */

    /**
     * Protéger les caractères spéciaux pouvant dégrader la page Web
     * @param string $string La chaîne à protéger
     *
     * @return string La chaîne protégée
     */
    public function escapeString($string) {
        return htmlentities($string, ENT_QUOTES|ENT_HTML5, "utf-8") ;
    }

    /**
     * Affecter le titre de la page
     * @param string $title Le titre
     */
    public function setTitle($title) {
        $this->title = $title ;
    }

    /**
     * Affecter la description de la page
     * @param string $desc La description
     */
    public function setDesc($desc) {
        $this->desc = $desc ;
    }

    /**
     * Affecter l'auteur de la page
     * @param string $author L'auteur
     */
    public function setAuthor($author) {
        $this->author = $author ;
    }

    /**
     * Ajouter un contenu dans head
     * @param string $content Le contenu à ajouter
     *
     * @return void
     */
    public function appendToHead($content) {
        $this->head .= $content."\n";
    }

    /**
     * Ajouter un contenu CSS dans head
     * @param string $css Le contenu CSS à ajouter
     *
     * @return void
     */
    public function appendCss($css){
        $this->appendToHead(<<<CSS
<style type='text/css'>
    {$css}
</style>
CSS
        );
    }

    /**
     * Ajouter l'URL d'un script CSS dans head
     * @param string $url L'URL du script CSS
     *
     * @return void
     */
    public function appendCssUrl($url) {
        $this->appendToHead("<link rel='stylesheet' type='text/css' href='{$url}'>");
    }

    /**
     * Ajouter un contenu JavaScript dans head
     * @param string $js Le contenu JavaScript à ajouter
     *
     * @return void
     */
    public function appendJs($js) {
        $this->appendToHead(<<<JS
<script type='text/javascript'>
{$js}
</script>
JS
        );
    }

    /**
     * Ajouter l'URL d'un script JavaScript dans head
     * @param string $url L'URL du script JavaScript
     *
     * @return void
     */
    public function appendJsUrl($url) {
        $this->appendToHead("<script type='text/javascript' src='$url'></script>");
    }

    /**
     * Ajouter un contenu dans body
     * @param string $content Le contenu à ajouter
     *
     * @return void
     */
    public function appendContent($content) {
        $this->body .= $content ;
    }

    /**
     * Produire la page Web complète
     * @throws Exception si title n'est pas défini
     *
     * @return string
     */
    public function toHTML() {
        if (is_null($this->title)) {
            throw new Exception(__CLASS__ . ": title not set") ;
        }
        return <<<HTML
            <!doctype html>
            <html lang="fr">
            <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <meta name="description" content="{$this->desc}">
            <meta name="author" content="{$this->author}">
            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
            <title>{$this->title}</title>
            {$this->head}
            </head>
            <body>
            {$this->body}
            </body>
            </html>
HTML;
    }

}