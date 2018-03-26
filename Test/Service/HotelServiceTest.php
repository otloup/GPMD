<?php
/**
 * Created by IntelliJ IDEA.
 * User: loup
 * Date: 22.01.18
 * Time: 04:25
 */

namespace Test\Service;

use GPMD\Entity\Hotel\Floor;
use GPMD\Entity\Hotel\Hotel;
use GPMD\Exception\FloorException;
use GPMD\Exception\HotelException;
use GPMD\Factory\HotelFactory;
use PHPUnit\Framework\TestCase;
use GPMD\Service\HotelService;

class HotelServiceTest extends TestCase
{

    /**
     * @var Hotel
     */
    private $hotel;

    /**
     * @var HotelService
     */
    private $service;

    /**
     * @throws HotelException
     */
    public function setUp()
    {
        $this->hotel = HotelFactory::createHotel(1, 1);
        $this->service = new HotelService($this->hotel);
    }

    /**
     * @test
     * @throws HotelException
     */
    public function testGetFloorsList()
    {
        $expectedList = "Floor: 1 <br />\n";
        $this->assertEquals($expectedList, $this->service->getFloorsList());
    }

    /**
     * @test
     * @throws HotelException
     */
    public function testGetZeroFloorsList()
    {
        $hotel = HotelFactory::createHotel(0, 0);
        $service = new HotelService($hotel);

        $this->expectException(HotelException::class);
        $service->getFloorsList();
    }

    /**
     * @test
     * @throws FloorException
     */
    public function testGetRoomsList()
    {
        $expectedList = "Floor: 1 Room: 1 <br />\n";

        /** @var Floor $floor */
        $floor = $this->hotel->getFloors()->first();

        $this->assertEquals($expectedList, $this->service->getRoomsList($floor));
    }

    /**
     * @test
     * @throws FloorException
     * @throws HotelException
     */
    public function testGetZeroRoomsList()
    {
        $hotel = HotelFactory::createHotel(0, 1);
        $service = new HotelService($hotel);

        /** @var Floor $firstFloor */
        $firstFloor = $hotel->getFloors()->first();

        $this->expectException(FloorException::class);
        $service->getRoomsList($firstFloor);
    }

    /**
     * @test
     * @throws HotelException
     */
    public function testGetFloorsAndRoomsList()
    {
        $hotel = HotelFactory::createHotel(1, 2);
        $service = new HotelService($hotel);

        $expectedList = "Floor: 1 Room: 1 <br />\nFloor: 2 Room: 1 <br />\n";

        $this->assertEquals($expectedList, $service->getFloorsAndRoomsList());
    }

    /**
     * @test
     * @throws HotelException
     */
    public function testGetZeroFloorsAndRoomsList()
    {
        $hotel = HotelFactory::createHotel(1, 0);
        $service = new HotelService($hotel);

        $this->expectException(HotelException::class);
        $service->getFloorsAndRoomsList();
    }

    /**
     * @test
     * @throws HotelException
     */
    public function testGetFloorsAndZeroRoomsList()
    {
        $hotel = HotelFactory::createHotel(0, 1);
        $service = new HotelService($hotel);

        $this->expectException(FloorException::class);
        $service->getFloorsAndRoomsList();
    }

    /**
     * @test
     */
    public function testChangeHotelName()
    {
        $hotelName = 'test hotel';
        $this->service->changeHotelName($hotelName);

        $this->assertEquals($hotelName, $this->hotel->getName());
    }

    /**
     * @test
     */
    public function testChangeHotelNameToMotel()
    {
        $hotelName = 'test motel';
        $this->service->changeHotelName($hotelName);

        $this->assertNull($this->hotel->getName());
    }
}
