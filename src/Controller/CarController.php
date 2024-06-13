<?php

namespace App\Controller;

use App\Entity\Car;
use DateTimeImmutable;
use App\Entity\Picture;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints\Json;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Requirement\Requirement;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * class CarController
 * Classe qui permet d'eefectuer des API sur les voitures et les images qui leurs sont associés
 *
 * Les méthodes disponibles sont :
 *  - le constructeur pour initialiser des données
 *  - Une méthode pour récupérer au format Json toutes les voitures : getAllCars()
 *  - Une méthode pour récupérer au format Json  une voiture en fonction de son Id : getCar()
 *  - une méthode pour ajouter une nouvelle voiture : addCar()
 *  - une méthode pour supprimer une voiture en foction de son id : deleteCar()
 *
 */
class CarController extends AbstractController
{
    /**
     * Controller
     * Permet d'initialiser des données
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        /*
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
        $em->persist($picture);
        $em->persist($car);
        $em->flush();

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
        $em->persist($picture);
        $em->persist($car);
        $em->flush();

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
        $em->persist($picture);
        $em->persist($car);
        $em->flush();

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
        $em->persist($picture);
        $em->persist($car);
        $em->flush();

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
        $em->persist($picture);
        $em->persist($car);
        $em->flush();
        */
    }


    /**
     * @ApiDoc(
     *    description="Récupère la liste des voitures de l'application"
     * )
     *
     * @Rest\View(serializerGroups={"read"})
     * @Rest\Get("/cars")
     *
     * @Route("/cars/", methods={"GET"})
     *
     * @Param CarRepository $carRepository
     *
     * @Return Json
     */
    #[Route('/cars/', name: 'cars', methods:['GET'])]
    public function getAllCars(CarRepository $carRepository): JsonResponse
    {
        // On récupère toutes les voitures
        $cars = $carRepository->findAll();
        // On transforme le résultat en tableau puis on le retourne en Json
        return $this->json($cars, 200, [], [
            'groups' => ['read']
        ]);
    }

    /**
     * @ApiDoc(
     *    description="Récupère une voiture en fonction de son id dans l'application"
     * )
     *
     * @Rest\View(serializerGroups={"read"})
     * @Rest\Get("/cars/{id}")
     *
     * @Route("/cars/{id}", methods={"GET"})
     *
     * @param Car $car
     *
     * @return Json
     */
    #[Route('/cars/{id}', name: 'show_car', methods:['GET'])]
    public function getCar(Car $car ): JsonResponse
    {
        if (is_null($car)){
            // il n'y apas de données avec l'id passé en paramètre, on retourne un message d'erreur
            return $this->json('Non trouvée', 404, []);
        }

        // On transforme le résultat en tableau puis on le retourne en Json
        return $this->json($car, 200, [], [
            'groups' => ['read', 'write']
        ]);
    }

    /**
     * @ApiDoc(
     *    description="Ajoute une voiture dans l'application"
     * )
     *
     * @Rest\View(serializerGroups={"read"})
     * @Rest\Post("/api/cars/")
     *
     * @Route("/cars/{id}", methods={"POST"})
     *
     * @Param Request $request
     * @Param SerializerInterface $serializer
     * @Param EntityManagerInterface $em
     *
     * @Return Json
     */
    #[Route('/cars', name: 'add_car', methods:['POST'])]
    public function addCar(Request $request, SerializerInterface $serializer, EntityManagerInterface $em ): JsonResponse
    {
        // On créé une nouvelle voiture
        $car = new Car();
        $serializer->deserialize($request->getContent(), Car::class, 'json', [ AbstractNormalizer::OBJECT_TO_POPULATE => $car ]);
        $car->setCarId(uniqid());
        // On enregistre la nouvelle voiture
        $em->persist($car);
        $em->flush();
        // On transforme le résultat en tableau puis on le retourne en Json
        return $this->json($car, 200, [], [
            'groups' => ['read', 'write']
        ]);
    }

    /**
     * @ApiDoc(
     *    description="Modifie une voiture dans l'application en fonction de son id"
     * )
     *
     * @Rest\View(serializerGroups={"read"})
     * @Rest\Put("/cars/{id}")
     *
     * @Route("/cars/{id}", methods={"PUT"})
     *
     * @Param Request $request
     * @Param Car $car
     * @Param SerializerInterface $serializer
     * @Param EntityManagerInterface $em
     *
     * @Return Json
     */
    #[Route('/cars/{id}', name: 'edit_car', methods:['PUT'])]
    public function editCar(Request $request, Car $car, SerializerInterface $serializer, EntityManagerInterface $em): JsonResponse
    {
        // On met à jour la base de données avec la voiture à modifier en fonction de son id
        $serializer->deserialize($request->getContent(), Car::class, 'json', [ AbstractNormalizer::OBJECT_TO_POPULATE => $car ]);
        $em->persist($car);
        $em->flush();
        // On transforme le résultat en tableau puis on le retourne en Json
        return $this->json($car, 200, [], [
            'groups' => ['read', 'edit']
        ]);
    }

    /**
     * @ApiDoc(
     *    description="Permet de supprimer une voiture de l'application"
     * )
     *
     * @Rest\View(serializerGroups={"read"})
     * @Rest\Delete("/cars/{id}")
     *
     * @Route("/cars/{id}", methods={"DELETE"})
     *
     * @Param Car $car
     * @Param EntityManagerInterface $em
     *
     * @Return Json
     */
    #[Route('/cars/{id}', name: 'delete', requirements:['id' => Requirement::DIGITS], methods:['DELETE'])]
    public function delete(Car $car, int $id, EntityManagerInterface $em): JsonResponse
    {
        // Permet de supprimer la voiture
        $em->remove($car);
        // Mise à jour de la table car et en cascade la table picture
        $em->flush();
        $cars = $em->getRepository(Car::class)->findAll();
        // On transforme le résultat en tableau puis on le retourne en Json mis à jour
        return $this->json($cars, 200, [], [
            'groups' => ['read']
        ]);

    }
}
