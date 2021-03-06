<?php

require_once("Page.php");

class DeleteCarFormPage extends Page
{
    private $cars = null;
    public function __construct($CarsObject, $title="", $author="", $desc=""){
        parent::__construct($title, $author, $desc);
        $this->cars = $CarsObject;
    }

    public function generateContent(){
        $this->content = <<<HTML
        <form action="cars/delete" method="POST">
          <div class="form-group">
            <label for="color">Voiture</label>
            <select class="form-control" name="id">
HTML
;
        foreach($this->cars as $c){
            $this->content .= "<option value='{$c['id']}'>{$c['model']} {$c['color']}</option>";
        }

        $this->content .= <<<HTML
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
HTML
;
    }

}
