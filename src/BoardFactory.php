<?php

namespace GoGame;

use GoGame\Board;

class BoardFactory
{
  const SMALL_BOARD_SIZE = 9;
  const MEDIUM_BOARD_SIZE = 30;
  const BIG_BOARD_SIZE = 90;
  
  public static function createSmallBoard(): Board
  {
    return self::create('small');
  }
  
  public static function createMediumBoard(): Board
  {
    return self::create('medium');
  }
  
  public static function createBigBoard(): Board
  {
    return self::create('big');
  }
  
  public static function create($size): Board
  {
    switch ($size) {
      case 'small':
        return new Board(self::buildIntersections(self::SMALL_BOARD_SIZE));
      break;
      case 'medium':
        return new Board(self::buildIntersections(self::MEDIUM_BOARD_SIZE));
      break;
      case 'big':
        return new Board(self::buildIntersections(self::BIG_BOARD_SIZE));
      break;
      
      default:
        return self::create(self::MEDIUM_BOARD_SIZE);
      break;
    }    
  }
  
  private static function buildIntersections($size): array
  {
    $intersections = [];
    for ($i=0; $i<$size; $i++) {
      for ($g=0; $g<$size; $g++) {
        $intersections[$i][$g] = '';
      }
    }    
    return $intersections;
  }
}


