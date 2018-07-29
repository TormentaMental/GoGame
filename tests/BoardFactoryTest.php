<?php

use GoGame\Board;
use GoGame\BoardFactory;
use PHPUnit\Framework\TestCase;

class BoardFactoryTest extends TestCase
{
    
    public function testCreateReturnsBoardInstance()
    {
        $this->assertInstanceOf(Board::class, BoardFactory::createSmallBoard());
    }

    public function testNumberRowsIsCorrect()
    {
        $smallBoard = BoardFactory::createSmallBoard();
        $this->assertEquals(9, count($smallBoard->getIntersections()));

        $mediumBoard = BoardFactory::createMediumBoard();
        $this->assertEquals(30, count($mediumBoard->getIntersections()));

        $bigBoard = BoardFactory::createBigBoard();
        $this->assertEquals(90, count($bigBoard->getIntersections()));
    }

}
