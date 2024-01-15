<?php

namespace App\Message\Command;

class CreateGuess
{
    private string $homeTeam;
    private string $awayTeam;
    private string $username;
    private string $guess;

    public function __construct(string $homeTeam, string $awayTeam, string $username, string $guess)
    {
        $this->homeTeam = $homeTeam;
        $this->awayTeam = $awayTeam;
        $this->username = $username;
        $this->guess    = $guess;
    }

    public function getHomeTeam(): string
    {
        return $this->homeTeam;
    }

    public function getAwayTeam(): string
    {
        return $this->awayTeam;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getGuess(): string
    {
        return $this->guess;
    }

}
