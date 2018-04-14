<?php

class EditCarFormPage
{
    function __construct($CarObject)
    {

        ?>
        <form action="editCar" method="POST">
            color
            <input type="text" name="color" value="<?php echo $CarObject['color']?>" />
            model
            <input type="text" name="model" value="<?php echo $CarObject['model']?>" />
            nb_seats
            <input type="number" name="nb_seats" value="<?php echo $CarObject['nb_seats']?>" />
            <input type="hidden" name="idCar" value="<?php echo $CarObject['idCar']?>" />
            <input type="submit" />
        </form>
        <?php
    }
}
