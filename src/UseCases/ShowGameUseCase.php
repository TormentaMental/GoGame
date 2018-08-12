<?php

namespace GoGame\UseCases;

use GoGame\Storage;
use GoGame\Game;

class ShowGameUseCase
{

  private $storage;

  public function __construct(Storage $storage)
  {
      $this->storage = $storage;
  }

  public function execute(Game $newGame)
  {
    if( $this->storage->isEmpty() )
      $this->storage->save($newGame);
    
    return $this->storage->load();
  }
}