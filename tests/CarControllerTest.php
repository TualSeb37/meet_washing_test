<?php

namespace App\Tests;

use App\Entity\Car;
use DateTimeImmutable;
use App\Entity\Picture;
use Symfony\Component\Serializer\Serializer;
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\CustomNormalizer;

class CarControllerTest extends ApiTestCase
{
    private JsonEncoder $encoder;
    private Serializer $serializer;

    protected function setUp(): void
    {
        $this->encoder = new JsonEncoder();
        $this->serializer = new Serializer([new CustomNormalizer()], ['json' => new JsonEncoder()]);
    }
    
    public function testGetAllCars(): void
    {
        $response = static::createClient()->request('GET', '/cars', ['base_uri' => 'https://127.0.0.1:8000', 'headers' => ['content-type' => 'application/json']]);

        $this->assertResponseIsSuccessful();
        //$this->assertJsonContains(['@id' => '5']);
    }

    public function testGetCarById()
    {
        $id = $this->findIriBy(Car::class, ['id' => 1]);
        $param =  '/cars/'.$id;
        $response = static::createClient()->request('GET', $param, ['base_uri' => 'https://127.0.0.1:8000', 'headers' => ['content-type' => 'application/json']]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/json');
        //$this->assertJsonContains(['car' => $response]);
    }

    public function testAddCar()
    {
        $car = new Car();
        $picture = new Picture();
        $picture->setId(5);
        $picture->setThumbnail('image5');
        $car->setId(1);
        $car->setCarId(uniqid());
        $car->setCarType('4X4');
        $car->setNumberPlate('AR-928-JK');
        $dateRelease = new DateTimeImmutable('2015-02-01');
        $car->setReleaseDate($dateRelease);
        $car->addPicture($picture);
        $jsonCar = $this->encoder->encode($car, 'json');
        $response = static::createClient()->request('POST', '/cars', ['base_uri' => 'https://127.0.0.1:8000', 'headers' => ['content-type' => 'application/json'], 'body' => $jsonCar]);
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/json');
    }
}
