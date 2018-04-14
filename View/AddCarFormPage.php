<?php

class AddCarFormPage
{
    function __construct()
    {
        ?>
        <form action="submitCar" method="POST">
            color
            <input type="text" name="color"/>
            model
            <input type="text" name="model"/>
            nb_seats
            <input type="number" name="nb_seats"/>
            <input type="submit" />
        </form>
        <?php
    }
}
