<?php

class AddCarFormPage
{
    function __construct()
    {
        ?>
        <form action="submitCar" method="POST">
            <input type="text" name="color"/>
            <input type="text" name="model"/>
            <input type="number" name="nb_seats"/>
            <input type="submit" />
        </form>
        <?php
    }
}
