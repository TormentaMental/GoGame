<?php

namespace GoGame\UseCases;

use GoGame\Storage;
use GoGame\Game;

class PlaceBlackStoneUseCase
{

  private $storage;

  public function __construct(Storage $storage)
  {
   $this->storage = $storage;
  }

  public function execute($row, $col)
  {
    $game = $this->storage->load();
    $game->addBlackStone($row, $col);
    $this->storage->save($game);
  }

}