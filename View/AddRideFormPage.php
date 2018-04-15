<?php

class AddRideFormPage extends Page
{
    private $cars = null;
    public function __construct($carsObjet, $title="", $author="", $desc=""){
        parent::__construct($title, $author, $desc);
        $this->cars = $carsObjet;
        $this->appendJs(<<<JS
        var nbSteps = document.getElementById("nb_step").value;
        function addStep() {
            var step = document.createElement("input");
            step.classList.add("form-control");
            step.type = "text";
            step.name = "step"+nbSteps;
            step.placeholder = "Adresse étape "+(parseInt(nbSteps)+1);
            
            document.getElementById("step_contener").append(step);

            document.getElementById("nb_step").value++;
            nbSteps = document.getElementById("nb_step").value;
        }
JS
);
    }

    public function generateContent(){
        $this->content = <<<HTML
        <form method="POST">
          <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" rows="5" name="description"></textarea>
          </div>
          <div class="form-group">
            <label for="nb_free_seats">Nombre de sièges</label>
            <input type="number" class="form-control" name="nb_seats" min="1" max="5">
          </div>
          <div class="form-group">
            <label for="value_luggage">Bagages</label>
            <select class="form-control" name="value_luggage">
                <option value="0">Aucun</option>
                <option value="1">Petits</option>
                <option value="2">Moyens</option>
                <option value="3">Gros</option>
            </select>
          </div>
          <div class="form-group">
            <label for="departure_time">Heure de départ</label>
            <input type="datetime" class="form-control" name="departure_time">            
          </div>
          <div class="form-group">
            <label for="departure">Lieu de départ</label>
            <input type="text" class="form-control" name="departure">
          </div>
          <div class="form-group">
            <button class="btn btn-success" type="button" onclick="addStep();">Ajouter une étape</button>
          </div>
          <div class="form-group" id="step_contener">
          </div>
          <div class="form-group">
            <label for="arrival">Lieu d'arrivée :</label>
            <input type="text" class="form-control" name="arrival">
          </div>
          <div class="form-group">
            <label for="car">Voiture</label>
            <select class="form-control" name="car">
HTML
;
            foreach ($this->cars as $c){
                $this->content .= '<option value="'.$c['idCar'].'">'.$c['model'].' '.$c['color'].'</option>';
            }
        $this->content .= <<<HTML
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Envoyer</button>
          <div class="form-group">
            <input type="hidden" id="nb_step" class="form-control" name="nb_step" value="0">
          </div>
        </form>
HTML
;
    }
}