<?php
/**
 * Created by IntelliJ IDEA.
 * User: loup
 * Date: 22.01.18
 * Time: 01:39
 */

namespace GPMD\Factory;


use GPMD\Collection\FloorCollection;
use GPMD\Collection\RoomCollection;
use GPMD\Entity\Hotel\Floor;
use GPMD\Entity\Hotel\Hotel;
use GPMD\Entity\Hotel\Room;
use GPMD\Exception\HotelException;

final class HotelFactory
{
    /**
     * create a hotel entity instance in accordance to defined presets
     * fill it with defined number of floors containing defined number of rooms
     * @param int $roomsNumber
     * @param int $floorsNumber
     * @param bool $superstitious
     * @return Hotel
     * @throws HotelException
     */
    static public function createHotel(int $roomsNumber, int $floorsNumber, bool $superstitious = false): Hotel
    {
        $floors = new FloorCollection();

        if ($floorsNumber < 0 || $roomsNumber < 0) {
            throw HotelException::createWithInvalidArchitecture('Hotel can have no fewer than 0 floors and 0 rooms on each floor');
        }

        if ($floorsNumber > PHP_INT_MAX || $roomsNumber > PHP_INT_MAX) {
            throw HotelException::createWithInvalidArchitecture('Hotel can have no more than ' . PHP_INT_MAX . ' floors and ' . PHP_INT_MAX . ' rooms on each floor');
        }


        for ($i = 1; $i <= $floorsNumber; $i++) {
            $rooms = new RoomCollection();

            /*
             * if the hotel owner is superstitious omit 13th floor and room
             */
            if (
                true === $superstitious &&
                13 === $i
            ) {
                continue;
            }

            for ($j = 1; $j <= $roomsNumber; $j++) {

                if (
                    true === $superstitious &&
                    13 === $j
                ) {
                    continue;
                }

                $room = new Room($j);
                $rooms->add($room);
            }

            $floor = new Floor($i);
            $floor->setRooms($rooms);

            $floors->add($floor);
        }

        return new Hotel($floors);
    }
}
