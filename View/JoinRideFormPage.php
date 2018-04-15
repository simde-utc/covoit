<?php

require_once("Page.php");

class JoinRideFormPage extends Page
{
    private $rides = null;
    public function __construct($RidesObject, $title="", $author="", $desc=""){
        parent::__construct($title, $author, $desc);
        $this->rides = $RidesObject;
    }

    public function generateContent(){
        $this->content = <<<HTML
        <form action="join" method="POST">
          <div class="form-group">
            <label for="color">Ride</label>
            <select class="form-control" name="id">
HTML
;
        foreach($this->rides as $c){
            $this->content .= "<option value='{$c['id']}'> car_id : {$c['car_id']} description : {$c['description']} free_seats : {$c['nb_free_seats']}</option>";
        }

        $this->content .= <<<HTML
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Réserver</button>
        </form>
HTML
;
    }

}
