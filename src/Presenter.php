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
      'board_intersections' => $this->game->getBoardIntersections(),
      'white_score' => $this->game->getWhiteScore(),
      'black_score' => $this->game->getBlackScore(),
      'who_plays_next' => $this->game->getNextColor()
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
