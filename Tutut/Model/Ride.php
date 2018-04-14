<?php

namespace Model;

/**
 *
 */
class Ride
{
    /**
     *
     */
    public function __construct()
    {
    }

    /**
     * @var void
     */
    public $idRide;

    /**
     * @var void
     */
    public $description;

    /**
     * @var int
     */
    public $nb_free_seats;

    /**
     * @var int
     */
    public $value_luggage;

    /**
     * @var int
     */
    public $car;

    /**
     * @var array
     */
    public $passengers;
}
