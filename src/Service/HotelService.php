<?php
/**
 * Created by IntelliJ IDEA.
 * User: loup
 * Date: 22.01.18
 * Time: 01:37
 */

namespace GPMD\Service;


use GPMD\Collection\FloorCollection;
use GPMD\Collection\RoomCollection;
use GPMD\Entity\Hotel\Floor;
use GPMD\Entity\Hotel\Hotel;
use GPMD\Entity\Hotel\Room;
use GPMD\Exception\FloorException;
use GPMD\Exception\HotelException;

class HotelService
{

    private const VALID_NAME_PATTERN = '/(hotel)/i';
    private const SHOW_ROOMS_OPTION = 'show_rooms';
    private const SHOW_FLOOR_OPTION = 'show_floor';

    /**
     * @var Hotel
     */
    private $hotel;

    /**
     * HotelService constructor.
     * @param Hotel $hotel
     */
    public function __construct(Hotel $hotel)
    {
        $this->hotel = $hotel;
    }

    /**
     * retrieve list of floors converting collection to strings
     * @return string
     * @throws HotelException
     */
    public function getFloorsList(): string
    {
        /** @var FloorCollection $floors */
        $floors = $this->hotel->getFloors();

        return $this->lookOverFloors($floors, self::SHOW_FLOOR_OPTION);
    }

    /**
     * retrieve list of rooms, on selected floor, in form of string
     * @param Floor $floor
     * @return string
     * @throws FloorException
     */
    public function getRoomsList(Floor $floor): string
    {
        $return = '';

        /** @var RoomCollection $rooms */
        $rooms = $floor->getRooms();

        if (0 === $rooms->count()) {
            throw FloorException::createWithNoRooms();
        }

        while ($rooms->valid()) {
            /** @var Room $room */
            $room = $rooms->current();

            $return .= "$floor $room <br />\n";

            $rooms->next();
        }

        return $return;
    }

    /**
     * retrieve list of rooms in each of floors, as a string
     * @return string
     * @throws HotelException
     */
    public function getFloorsAndRoomsList(): string
    {
        /** @var FloorCollection $floors */
        $floors = $this->hotel->getFloors();

        return $this->lookOverFloors($floors, self::SHOW_ROOMS_OPTION, [$this, 'getRoomsList']);
    }

    /**
     * change name of the hotel after verifying the name validity
     * @param string $newHotelName
     */
    public function changeHotelName(string $newHotelName): void
    {
        if ($this->validateHotelName($newHotelName)) {
            $this->hotel->setName($newHotelName);
        }
    }

    /**
     * check if the new hotel name is valid according to defined pattern
     * @param string $hotelName
     * @return bool
     */
    private function validateHotelName(string $hotelName): bool
    {
        return !!preg_match(self::VALID_NAME_PATTERN, $hotelName);
    }

    /**
     * scroll over all available hotel floors and apply one of specified actions to each floor
     * @param FloorCollection $floors
     * @param string $action
     * @param callable $callback
     * @return string
     * @throws HotelException
     */
    private function lookOverFloors(FloorCollection $floors, string $action, callable $callback = null): string
    {
        if (0 === $floors->count()) {
            throw HotelException::createWithNoFloors();
        }

        $return = '';

        while ($floors->valid()) {
            /** @var Floor $floor */
            $floor = $floors->current();

            switch ($action) {
                case self::SHOW_ROOMS_OPTION:
                    $return .= call_user_func($callback, $floors->current());
                    break;
                default:
                case self::SHOW_FLOOR_OPTION:
                    $return .= "$floor <br />\n";
                    break;
            }

            $floors->next();
        }

        return $return;
    }
}