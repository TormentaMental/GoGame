<?php

namespace GoGame\UseCases;

use GoGame\Storage;
use GoGame\Game;

class PlaceWhiteStoneUseCase
{

  private $storage;

  public function __construct(Storage $storage)
  {
   $this->storage = $storage;
  }

  public function execute($row, $col)
  {
    $game = $this->storage->load();
    $game->addWhiteStone($row, $col);
    $this->storage->save($game);
  }

}