<?php


namespace App\Concept;


use App\Entity\Car;
use Doctrine\ORM\EntityManagerInterface;

class CheckerService
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        echo "CheckerService::__construct() - EntityManager ID: " .  spl_object_id($entityManager) . "<br />";
        $this->entityManager = $entityManager;
    }

    /**
     * @param Car $car
     */
    public function check($car)
    {
        if ($car->getConcept()) {
            return;
        }

        $concept = clone $car;

        $car->setModel($car->getModel() . ' - Current');
        $concept->setModel($concept->getModel() . ' - Concept');
        $concept->setConcept(true);

        $this->entityManager->persist($concept);
        $this->entityManager->flush();

    }

}
