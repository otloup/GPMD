<?php

require_once './vendor/autoload.php';

// In most hotels there is no floor 13 and room no. 13.
// Please correct this code to behave according to the comments

// we create a hotel with 20 floors and 20 rooms
try {
    $hotel = \GPMD\Factory\HotelFactory::createHotel(20, 20, true);
} catch (\GPMD\Exception\HotelException $e) {
    echo $e->getMessage();
    exit;
}

$hotelService = new \GPMD\Service\HotelService($hotel);

// we list the rooms
try {
    echo $hotelService->getFloorsAndRoomsList();
} catch (\GPMD\Exception\HotelException $e) {
    echo $e->getMessage();
    exit;
}

// we try to name the hotel to "Error Motel"
$hotelService->changeHotelName('Error Motel');

// we check the name
$name = $hotel->getName();

// it has to be empty
if (empty($name)) {
    echo "This was a motel, it's OK that we have no name<br/>\n";
}

// we set the name to "First Hotel"
$hotelService->changeHotelName('First Hotel');

// we check the name
$name = $hotel->getName();

// it has to be "First Hotel"
if ("First Hotel" === $hotel->getName()) {
    echo "Hotel is correctly named \"$name\" ! <br />\n";
} else {
    echo "We have no name!<br/>\n";
} 
