<?php
/**
 * Created by IntelliJ IDEA.
 * User: loup
 * Date: 22.01.18
 * Time: 01:52
 */

namespace GPMD\Collection;


use GPMD\Entity\Hotel\Room;
use GPMD\Util\TypedCollection\TypedCollection;

class RoomCollection extends TypedCollection
{
    /**
     * RoomCollection constructor.
     */
    public function __construct()
    {
        $type = Room::class;
        $this->setType($type);
    }
}