<?php
/**
 * Created by IntelliJ IDEA.
 * User: loup
 * Date: 22.01.18
 * Time: 01:21
 */

namespace GPMD\Exception;


final class HotelException extends \Exception
{
    private const INVALID_ARCHITECTURE_MESSAGE = 'Something went wrong while building your hotel (%s)';
    private const INVALID_ARCHITECTURE_CODE = 100;

    private const NO_FLOORS_MESSAGE = 'Selected hotel has no floors';
    private const NO_FLOORS_CODE = 101;

    /**
     * @param null $message
     * @param null $previousException
     * @return HotelException
     */
    public static function createWithInvalidArchitecture($message, $previousException = null): HotelException
    {
        $message = sprintf(self::INVALID_ARCHITECTURE_MESSAGE, $message);
        return new self($message,  self::INVALID_ARCHITECTURE_CODE, $previousException);
    }

    /**
     * @param null $previousException
     * @return HotelException
     */
    public static function createWithNoFloors($previousException = null): HotelException
    {
        return new self(self::NO_FLOORS_MESSAGE, self::NO_FLOORS_CODE, $previousException);
    }
}