<?php

namespace Model;

/**
 *
 */
class Step
{
    /**
     *
     */
    public function __construct()
    {
    }

    /**
     * @var int
     */
    public $idStep;

    /**
     * @var string
     */
    public $distance;

    /**
     * @var string
     */
    public $departure_time;

    /**
     * @var float
     */
    public $eco_result;

    /**
     * @var void
     */
    public $duration;

    /**
     * @var string
     */
    public $description;

    /**
     * @var int
     */
    public $departure_place;

    /**
     * @var int
     */
    public $arrival_place;

    /**
     * @var int
     */
    public $ride;

    /**
     * @var int
     */
    public $price;
}
