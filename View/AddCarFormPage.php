class AddCarFormPage
{
    function __construct()
    {
        ?>
        <form action="/car/add/" method="post">
            <input type="text" name="model"/>
            <input type="number" name="nb_seats"/>
            <input type="text" name="color"/>
        </form>
        <?php
    }
}
