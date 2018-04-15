<?php

/**
 * Created by PhpStorm.
 * User: yanis
 * Date: 14/04/2018
 * Time: 20:53
 */
class AddRideFormPage
{
    function __construct($carsObjet)
    {
        ?>
        <form action="rides/add" method="POST">
            <textarea name="description"></textarea>
            <input type="number" name="nb_free_seats"/>
            <select name="value_luggage">
                <option value="3">Gros bagages</option>
                <option value="2">Bagages moyens</option>
                <option value="1">Petits bagages</option>
                <option value="0">Pas de bagages</option>
            </select></br>

            Depart :</br>
            <input type="datetime-local" name="departure_time"/>
            <input type="text" name="departure" placeholder="departure adress"> </br>
            <button type="button" onclick="addStep();">Ajouter une étape</button>
            <div id="step_contener">

            </div></br>
            Arrivée :</br>
            <input type="text" name="arrival" placeholder="departure adress">
            <select name="car">
                <?php foreach ($carsObjet as $car){
                    echo '<option value="'.$car['idCar'].'">'.$car['model'].' '.$car['color'].'</option>';
                }?>
            </select></br>
            <input type="submit" />
            <input type="hidden" id="nb_step" name="nb_step" value="0"/>
            <script type="application/javascript">
                var nbSteps = document.getElementById("nb_step").value;
                function addStep() {
                    var step = document.createElement("input");
                    step.type = "text";
                    step.name = "step"+nbSteps;
                    step.placeholder = "Adresse étape "+(parseInt(nbSteps)+1);

                    document.getElementById("step_contener").append(step);

                    document.getElementById("nb_step").value++;
                    nbSteps = document.getElementById("nb_step").value;
                }
            </script>
        </form>
        <?php
    }
}