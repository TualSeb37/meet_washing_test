<?php

namespace App\DataFixtures;

use App\Entity\Car;
use App\Entity\Picture;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CarFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $car = new Car();
        $picture = new Picture();
        $picture->setId(1);
        $picture->setThumbnail('image1');
        //$picture->setThumbNailFile('/images/image1.jpg');
        $car->setId(1);
        $car->setCarId(uniqid());
        $car->setCarType('citadine');
        $car->setNumberPlate('FR-123-AA');
        $dateRelease = new DateTimeImmutable('2020-06-01');
        $car->setReleaseDate($dateRelease);
        $car->addPicture($picture);
        $manager->persist($picture);
        $manager->persist($car);
        $manager->flush();

        $car = new Car();
        $picture = new Picture();
        $picture->setId(1);
        $picture->setThumbnail('image2');
        //$picture->setThumbNailFile('/images/image1.jpg');
        $car->setId(2);
        $car->setCarId(uniqid());
        $car->setCarType('SUV');
        $car->setNumberPlate('AC-234-AB');
        $dateRelease = new DateTimeImmutable('2020-09-01');
        $car->setReleaseDate($dateRelease);
        $car->addPicture($picture);
        $manager->persist($picture);
        $manager->persist($car);
        $manager->flush();

        $car = new Car();
        $picture = new Picture();
        $picture->setId(3);
        $picture->setThumbnail('image31');
        //$picture->setThumbNailFile('/images/image1.jpg');
        $car->setId(3);
        $car->setCarId(uniqid());
        $car->setCarType('cabriolet');
        $car->setNumberPlate('AZ-345-BA');
        $dateRelease = new DateTimeImmutable('2019-07-01');
        $car->setReleaseDate($dateRelease);
        $car->addPicture($picture);
        $manager->persist($picture);
        $manager->persist($car);
        $manager->flush();

        $car = new Car();
        $picture = new Picture();
        $picture->setId(4);
        $picture->setThumbnail('image4');
        //$picture->setThumbNailFile('/images/image1.jpg');
        $car->setId(4);
        $car->setCarId(uniqid());
        $car->setCarType('citadine');
        $car->setNumberPlate('YU-987-NH');
        $dateRelease = new DateTimeImmutable('2018-02-01');
        $car->setReleaseDate($dateRelease);
        $car->addPicture($picture);
        $manager->persist($picture);
        $manager->persist($car);
        $manager->flush();

        $car = new Car();
        $picture = new Picture();
        $picture->setId(5);
        $picture->setThumbnail('image5');
        //$picture->setThumbNailFile('/images/image1.jpg');
        $car->setId(1);
        $car->setCarId(uniqid());
        $car->setCarType('4X4');
        $car->setNumberPlate('JK-098-ML');
        $dateRelease = new DateTimeImmutable('2015-02-01');
        $car->setReleaseDate($dateRelease);
        $car->addPicture($picture);
        $manager->persist($picture);
        $manager->persist($car);
        $manager->flush();
    }
}
