<?php
/**
 * Created by IntelliJ IDEA.
 * User: loup
 * Date: 22.01.18
 * Time: 01:50
 */

namespace GPMD\Collection;


use GPMD\Entity\Hotel\Floor;
use GPMD\Util\TypedCollection\TypedCollection;

class FloorCollection extends TypedCollection
{
    /**
     * FloorCollection constructor.
     */
    public function __construct()
    {
        $type = Floor::class;
        $this->setType($type);
    }
}