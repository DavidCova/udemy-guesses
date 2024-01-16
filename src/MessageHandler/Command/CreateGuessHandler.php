<?php

namespace App\MessageHandler\Command;

use App\Entity\Guesses;
use App\Message\Command\CreateGuess;
use App\Message\Event\GameGuessedEvent;
use App\Repository\GuessesRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsMessageHandler]
class CreateGuessHandler
{

    private GuessesRepository $guessRepository;

    private MessageBusInterface $eventBus;

    public function __construct(GuessesRepository $guessRepository, MessageBusInterface $eventBus)
    {
        $this->guessRepository = $guessRepository;
        $this->eventBus = $eventBus;
    }

    public function __invoke(CreateGuess $createGuess): void
    {
        $guess = (new Guesses())
                ->setHomeTeam($createGuess->getHomeTeam())
                ->setAwayTeam($createGuess->getAwayTeam())
                ->setUsername($createGuess->getUsername())
                ->setGuess($createGuess->getGuess());

        $this->guessRepository->save($guess, TRUE);

        $this->eventBus->dispatch(new GameGuessedEvent(
            $createGuess->getHomeTeam(),
            $createGuess->getAwayTeam(),
            $createGuess->getUsername(),
            $createGuess->getGuess()
        ));
    }

}
