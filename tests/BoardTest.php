<?php

use GoGame\Board;
use GoGame\BoardFactory;
use PHPUnit\Framework\TestCase;
use GoGame\IntersectionNotEmptyException;
use GoGame\IntersectionNotFoundException;

final class BoardTest extends TestCase
{
    private $board;
  
    public function setUp(): void
    {
        $this->board = BoardFactory::createSmallBoard();
    }
  
    public function testAddTwoStones(): void
    {
        $this->board->setIntersection(2, 0, 'black');
        $this->board->setIntersection(1, 0, 'white');
        $this->assertEquals('black', $this->board->getIntersection(2, 0));
        $this->assertEquals('white', $this->board->getIntersection(1, 0));
        $this->assertEquals('', $this->board->getIntersection(1, 1));
    }
  
    public function testSetNonExistentIntersectionShouldThrowException(): void
    {
        $this->expectException(IntersectionNotFoundException::class);
        $this->board->setIntersection(10, 10, 'black');
    }
  
    public function testGetNonExistentIntersectionShouldThrowException(): void
    {
        $this->expectException(IntersectionNotFoundException::class);
        $this->board->getIntersection(10, 10);
    }
  
    public function testSetNotEmptyIntersectionShouldThrowException(): void
    {
        $this->board->setIntersection(2, 0, 'black');
        $this->expectException(IntersectionNotEmptyException::class);
        $this->board->setIntersection(2, 0, 'white');
    }
}
