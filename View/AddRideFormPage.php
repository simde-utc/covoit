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
        <form action="submitRide" method="POST">
            <textarea name="description"></textarea>
            <input type="number" name="nb_free_seats"/>
            <select name="value_luggage">
                <option value="3">Gros bagages</option>
                <option value="2">Bagages moyens</option>
                <option value="1">Petits bagages</option>
                <option value="0">Pas de bagages</option>
            </select>
            Depart :
            <input type="datetime-local" name="departure_time"/>
            <input type="text" name="departure" placeholder="departure adress">
            Arrivée :
            <input type="text" name="arrival" placeholder="departure adress">
            <select name="car">
                <?php foreach ($carsObjet as $car){
                    echo '<option value="'.$car['idCar'].'">'.$car['model'].' '.$car['color'].'</option>';
                }?>
            </select>
            <input type="submit" />
        </form>
        <?php
    }
}