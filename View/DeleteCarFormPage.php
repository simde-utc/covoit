<?php

class DeleteCarFormPage
{
    function __construct($CarsObject)
    {

        ?>
        <form method="POST">
            <select name="idCar">
                <?php foreach ($CarsObject as $car){
                    echo '<option value="'.$car['idCar'].'">'.$car['model'].' '.$car['color'].'</option>';
                }?>
            </select>
            <input type="submit" />
        </form>
        <?php
    }
}
