<?php

namespace Model;

/**
 *
 */
class Place
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
    public $idPlace;

    /**
     * @var string
     */
    public $text_address;

    /**
     * @var string
     */
    public $description;

    /**
     * @var float
     */
    public $lat;

    /**
     * @var float
     */
    public $lng;
}
