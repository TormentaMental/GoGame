<?php

namespace GoGame;

interface GameStore
{
  public function save(Game $game): void;
  public function load(): Game;
  public function reset(): void;
  public function isEmpty(): bool;
}