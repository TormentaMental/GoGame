<?php

namespace GoGame;

interface Store
{
    public function save(Game $game): void;
    public function load(): Game;
    public function reset(): void;
    public function isEmpty(): bool;
}
