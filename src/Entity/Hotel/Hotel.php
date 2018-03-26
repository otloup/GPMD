<?php
/**
 * Created by IntelliJ IDEA.
 * User: loup
 * Date: 22.01.18
 * Time: 01:18
 */

namespace GPMD\Entity\Hotel;

use GPMD\Collection\FloorCollection;

class Hotel
{

    /**
     * @var string
     */
    private $name = null;

    /**
     * @var FloorCollection
     */
    private $floors;

    /**
     * Hotel constructor.
     * @param $floors
     */
    public function __construct($floors)
    {
        $this->floors = $floors;
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return FloorCollection
     */
    public function getFloors(): FloorCollection
    {
        return $this->floors;
    }

    /**
     * @param FloorCollection $floors
     */
    public function setFloors(FloorCollection $floors): void
    {
        $this->floors = $floors;
    }
}