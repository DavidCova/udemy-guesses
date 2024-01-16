<?php

namespace App\MessageHandler\Event;

use App\Message\Event\GameEndedEvent;
use App\Repository\GuessesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsMessageHandler]
class GameEndedHandler
{
    private GuessesRepository $guessesRepository;
    private MessageBusInterface $eventBus;
    private EntityManagerInterface $entityManager;

    public function __construct(GuessesRepository $guessesRepository, MessageBusInterface $eventBus, EntityManagerInterface $entityManager)
    {
        $this->guessesRepository = $guessesRepository;
        $this->eventBus          = $eventBus;
        $this->entityManager     = $entityManager;
    }

    public function __invoke(GameEndedEvent $gameEndedEvent): void
    {
        $guesses = $this->guessesRepository->findBy([
            'homeTeam' => $gameEndedEvent->getHomeTeam(),
            'awayTeam' => $gameEndedEvent->getAwayTeam(),
        ]);

        if (!$guesses)
        {
            return;
        }

        foreach ($guesses as $guess)
        {
            $guess->setResult($gameEndedEvent->getResult());
        }

        $this->entityManager->flush();
    }

}
