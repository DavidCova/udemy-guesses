<?php

namespace App\MessageHandler\Command;

use App\Entity\Guesses;
use App\Message\Command\CreateGuess;
use App\Repository\GuessesRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CreateGuessHandler
{

    private GuessesRepository $guessRepository;

    public function __construct(GuessesRepository $guessRepository)
    {
        $this->guessRepository = $guessRepository;
    }

    public function __invoke(CreateGuess $createGuess): void
    {
        $guess = (new Guesses())
                ->setHomeTeam($createGuess->getHomeTeam())
                ->setAwayTeam($createGuess->getAwayTeam())
                ->setUsername($createGuess->getUsername())
                ->setGuess($createGuess->getGuess());

                $this->guessRepository->save($guess, TRUE);
    }

}
