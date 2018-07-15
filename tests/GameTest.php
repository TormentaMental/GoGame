<?php

use GoGame\Board;
use GoGame\Game;
use GoGame\IntersectionNotEmptyException;
use GoGame\IntersectionNotFoundException;
use GoGame\OutOfBoardException;
use GoGame\WrongColorException;
use PHPUnit\Framework\TestCase;

final class GameTest extends TestCase
{
    private $game;

    public function setUp(): void
    {
        $board = new Board($this->buildIntersections(9));
        $this->game = new Game($board);
    }

    public function testAddTwoStones(): void
    {
        $this->game->addBlackStone(2, 0);
        $this->assertEquals('black', $this->game->getStone(2, 0));

        $this->game->addWhiteStone(1, 0);
        $this->assertEquals('white', $this->game->getStone(1, 0));
        
        $this->assertEquals('', $this->game->getStone(1, 1));
    }

    public function testStartPlayingWhiteColorShouldThrowException(): void
    {
        $this->expectException(WrongColorException::class);
        $this->game->addWhiteStone(2, 0);
    }

    public function testSameColorPlayTwiceInARowShouldThrowException(): void
    {
        $this->game->addBlackStone(2, 0);
        $this->expectException(WrongColorException::class);
        $this->game->addBlackStone(1, 0);
    }

    public function testGetScoreAfterPlacingOneStone(): void
    {
        $this->game->addBlackStone(0, 0);
        $this->assertEquals(1, $this->game->getBlackScore());
    }

    public function testGetScoreAfterPlacingStonesForBothColors(): void
    {
        $this->game->addBlackStone(0, 0);
        $this->game->addWhiteStone(0, 2);
        $this->game->addBlackStone(0, 1);
        $this->assertEquals(2, $this->game->getBlackScore());
        $this->assertEquals(1, $this->game->getWhiteScore());
    }

    private function buildIntersections($size): array
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
