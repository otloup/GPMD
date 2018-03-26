<?php
/**
 * Created by IntelliJ IDEA.
 * User: loup
 * Date: 22.01.18
 * Time: 01:19
 */

namespace GPMD\Entity\Hotel;


use GPMD\Collection\RoomCollection;

class Floor
{
    /**
     * @var int
     */
    private $number;

    /**
     * @var RoomCollection
     */
    private $rooms;

    public function __construct(int $number)
    {

        $this->number = $number;
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @param int $number
     */
    public function setNumber(int $number): void
    {
        $this->number = $number;
    }

    /**
     * @return RoomCollection
     */
    public function getRooms(): RoomCollection
    {
        return $this->rooms;
    }

    /**
     * @param RoomCollection $rooms
     */
    public function setRooms(RoomCollection $rooms): void
    {
        $this->rooms = $rooms;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return 'Floor: ' . $this->getNumber();
    }

}