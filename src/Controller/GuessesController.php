<?php

namespace App\Controller;

use App\Message\Command\CreateGuess;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GuessesController extends AbstractController
{

    public function create(Request $request, MessageBusInterface $messageBus): Response
    {
        $request = $request->toArray();

        $message = new CreateGuess($request['homeTeam'], $request['awayTeam'], $request['username'], $request['guess']);

        $messageBus->dispatch($message);

        return new Response('Done');
    }

}
