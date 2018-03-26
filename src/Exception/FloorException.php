<?php
/**
 * Created by IntelliJ IDEA.
 * User: loup
 * Date: 22.01.18
 * Time: 01:21
 */

namespace GPMD\Exception;


final class FloorException extends \Exception
{
    private const NO_ROOMS_MESSAGE = 'Selected floor has no rooms';
    private const NO_ROOMS_CODE = 100;

    /**
     * @param null $previousException
     * @return FloorException
     */
    public static function createWithNoRooms($previousException = null): FloorException
    {
        return new self(self::NO_ROOMS_MESSAGE, self::NO_ROOMS_CODE, $previousException);
    }
}