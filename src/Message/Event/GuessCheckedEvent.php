<?php

namespace App\Message\Event;

class GuessCheckedEvent
{
    private string $homeTeam;
    private string $awayTeam;
    private bool $correct;
    private string $username;

    public function __construct(string $homeTeam, string $awayTeam, bool $correct, string $username)
    {
        $this->homeTeam = $homeTeam;
        $this->awayTeam = $awayTeam;
        $this->correct  = $correct;
        $this->username = $username;
    }

    public function getHomeTeam(): string
    {
        return $this->homeTeam;
    }

    public function getAwayTeam(): string
    {
        return $this->awayTeam;
    }

    public function getCorrect(): bool
    {
        return $this->correct;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

}
