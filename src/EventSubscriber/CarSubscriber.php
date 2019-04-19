<?php


namespace App\EventSubscriber;


use App\Concept\CheckerService;
use App\Entity\Car;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class CarSubscriber implements EventSubscriber
{
    private $checker;

    public function __construct(CheckerService $checker)
    {
        $this->checker = $checker;
    }
    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return string[]
     */
    public function getSubscribedEvents()
    {
        return [
            Events::prePersist,
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {

        $entity = $args->getObject();

        if ($entity instanceof Car) {
            $this->checker->check($entity);
        }

    }
}
