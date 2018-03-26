<?php
/**
 * Created by IntelliJ IDEA.
 * User: loup
 * Date: 22.01.18
 * Time: 04:25
 */

namespace Test\Factory;

use GPMD\Factory\HotelFactory;
use GPMD\Collection\FloorCollection;
use GPMD\Entity\Hotel\Floor;
use GPMD\Exception\HotelException;
use PHPUnit\Framework\TestCase;

class HotelFactoryTest extends TestCase
{
    /**
     * @test
     * @throws HotelException
     */
    public function testCreateHotel()
    {
        $hotel = HotelFactory::createHotel(1,1);

        /** @var FloorCollection $floors */
        $floors = $hotel->getFloors();

        $this->assertEquals(1, $floors->count());

        /** @var Floor $firstFloor */
        $firstFloor = $floors->first();

        $this->assertEquals(1, $firstFloor->getRooms()->count());
    }

    /**
     * @test
     * @throws HotelException
     */
    public function testCreateSuperstitiousHotel()
    {
        $hotel = HotelFactory::createHotel(13,13, true);

        /** @var FloorCollection $floors */
        $floors = $hotel->getFloors();

        $this->assertEquals(12, $floors->count());

        /** @var Floor $firstFloor */
        $firstFloor = $floors->first();

        $this->assertEquals(12, $firstFloor->getRooms()->count());
    }

    /**
     * @test
     * @throws HotelException
     */
    public function testCreateHotelWithMinusFloors()
    {
        $this->expectException(HotelException::class);
        HotelFactory::createHotel(13,-1);
    }

    /**
     * @test
     * @throws HotelException
     */
    public function testCreateHotelWithMinusRooms()
    {
        $this->expectException(HotelException::class);
        HotelFactory::createHotel(-1,1);
    }

    /**
     * @test
     * @throws HotelException
     */
    public function testCreateHotelWithMaxFloors()
    {
        $max = PHP_INT_MAX+1;

        $this->expectException(\TypeError::class);
        HotelFactory::createHotel(13,$max);
    }

    /**
     * @test
     * @throws HotelException
     */
    public function testCreateHotelWithMaxRooms()
    {
        $max = PHP_INT_MAX+1;

        $this->expectException(\TypeError::class);
        HotelFactory::createHotel($max,1);
    }
}
