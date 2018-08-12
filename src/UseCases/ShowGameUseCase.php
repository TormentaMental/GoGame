<?php

namespace GoGame\UseCases;

use GoGame\Storage;
use GoGame\Game;

class ShowGameUseCase
{

  private $game;
  private $storage;
    
  public function __construct(Game $game, Storage $storage)
  {
      $this->game = $game;
      $this->storage = $storage;
  }

  public function execute()
  {
    if( $this->storage->isEmpty() )
      $this->storage->save($this->game);
    else
      $this->game = $this->storage->load();
    
    return $this->game;
  }
}