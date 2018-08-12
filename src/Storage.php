<?php

namespace GoGame;

use GoGame\Game;

interface Storage
{
    public function save(Game $game): void;
    public function load(): Game;
    public function reset(): void;
    public function isEmpty(): bool;
}
