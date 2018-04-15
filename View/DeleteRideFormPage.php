<?php

require_once("Page.php");

class DeleteRideFormPage extends Page
{
    private $rides = null;
    public function __construct($RidesObject, $title="", $author="", $desc=""){
        parent::__construct($title, $author, $desc);
        $this->rides = $RidesObject;
    }

    public function generateContent(){
        $this->content = <<<HTML
        <form action="rides/delete" method="POST">
          <div class="form-group">
            <label for="color">Ride</label>
            <select class="form-control" name="id">
HTML
;
        foreach($this->rides as $c){
            $this->content .= "<option value='{$c['id']}'> car_id : {$c['car_id']} description : {$c['description']} free_seats : {$c['nb_free_seats']}</option>";
            //:car_id, :description, :nb_free_seats, :value_luggage, :date, :creation_date);",
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
