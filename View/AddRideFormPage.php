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
            <label for="day">Jour de départ</label>
            <select class="form-control" name="day">
                <option value="1">01</option>      
                <option value="2">02</option>      
                <option value="3">03</option>      
                <option value="4">04</option>      
                <option value="5">05</option>      
                <option value="6">06</option>      
                <option value="7">07</option>      
                <option value="8">08</option>      
                <option value="9">09</option>      
                <option value="10">10</option>      
                <option value="11">11</option>      
                <option value="12">12</option>      
                <option value="13">13</option>      
                <option value="14">14</option>      
                <option value="15">15</option>      
                <option value="16">16</option>      
                <option value="17">17</option>      
                <option value="18">18</option>      
                <option value="19">19</option>      
                <option value="20">20</option>      
                <option value="21">21</option>      
                <option value="22">22</option>      
                <option value="23">23</option>      
                <option value="24">24</option>      
                <option value="25">25</option>      
                <option value="26">26</option>      
                <option value="27">27</option>      
                <option value="28">28</option>      
                <option value="29">29</option>      
                <option value="30">30</option>      
                <option value="31">31</option> 
            </select>           
          </div>
          <div class="form-group">
            <label for="month">Mois de départ</label>
            <select class="form-control" name="month">
                <option value="1">Janvier</option>      
                <option value="2">Février</option>      
                <option value="3">Mars</option>      
                <option value="4">Avril</option>      
                <option value="5">Mai</option>      
                <option value="6">Juin</option>      
                <option value="7">Juillet</option>      
                <option value="8">Août</option>      
                <option value="9">Septembre</option>      
                <option value="10">Octobre</option>      
                <option value="11">Novembre</option>      
                <option value="12">Décembre</option> 
            </select>           
          </div>
          <div class="form-group">
            <label for="year">Année de départ</label>
            <select class="form-control" name="year">
                <option value="2018">2018</option>      
                <option value="2019">2019</option>      
                <option value="2020">2020</option>
            </select>           
          </div>
          <div class="form-group">
            <label for="hour">Heure de départ</label>
            <select class="form-control" name="hour">
                <option value="00">00</option>      
                <option value="01">01</option>      
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                <option value="05">05</option>
                <option value="06">06</option>
                <option value="07">07</option>
                <option value="08">08</option>
                <option value="09">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
            </select>           
          </div>
          <div class="form-group">
            <label for="min">Minute de départ</label>
            <select class="form-control" name="min">
                <option value="00">00</option>      
                <option value="05">05</option>      
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
                <option value="30">30</option>
                <option value="35">35</option>
                <option value="40">40</option>
                <option value="45">45</option>
                <option value="50">50</option>
                <option value="55">55</option>
            </select>           
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