<?php

namespace GoGame;

class Presenter
{
	protected $game;

  public function __construct(Game $game)
  {
    $this->game = $game;
  }

  public function toArray(): Array
  {
    return [
      'boardIntersections' => $this->game->getBoardIntersections(),
      'whiteScore' => $this->game->getWhiteScore(),
      'blackScore' => $this->game->getBlackScore(),
      'whoPlaysNext' => $this->game->getNextColor()
    ];
  }
  
  public function toObj(): \stdClass
  {
    $obj = new \stdClass();
    $obj->boardIntersections = $this->game->getBoardIntersections();
    $obj->whiteScore = $this->game->getWhiteScore();
    $obj->blackScore = $this->game->getBlackScore();
    $obj->whoPlaysNext = $this->game->getNextColor();
    return $obj;
  }

  
}
